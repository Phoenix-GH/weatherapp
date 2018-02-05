<?php

namespace App\Services;

use Storage;
use GuzzleHttp\Client;
use App\WeatherEvent;
use ElevenLab\PHPOGC\DataTypes\Point as Point;
use ElevenLab\PHPOGC\DataTypes\Polygon as Polygon;
use ElevenLab\PHPOGC\DataTypes\LineString as Linestring;
use ElevenLab\PHPOGC\DataTypes\MultiPolygon as MultiPolygon;

class HailMap
{
    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function hailMapsUrl($date)
    {
        return "https://maps.interactivehailmaps.com/ExternalApi/SwathToKml?MapDate=$date&PlacemarkPerGeo=false";
    }

    public function getHailXMLfiles($date)
    {
        return $this->client->get($this->hailMapsUrl($date), [
            'auth' => [
                config('hailmaps.id'),
                config('hailmaps.secret')
            ]
        ])->getBody()->getContents();
    }

    public function get($date, $end_date)
    {
        while (strtotime($date) <= strtotime($end_date)) {
            echo "Fetching: " . $date.PHP_EOL;
            Storage::put("hailmaps/$date.xml", $this->getHailXMLfiles($date));
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            sleep(31);
        }
    }

    public function import($date, $end_date)
    {
        while (strtotime($date) <= strtotime($end_date)) {
            $xmlFile = Storage::get('hailmaps/' . $date . '.xml');
            $xml = simplexml_load_string($xmlFile) or die('Error: Cannot create object');
            $xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
            \Log::info($xml_array);
            echo "Importing: " . $date . PHP_EOL;
            if (is_array($xml_array["Document"]) && array_key_exists('Placemark', $xml_array['Document'])) {
                foreach ($xml_array["Document"]["Placemark"] as $placemark) {
                    if (is_array($placemark) && array_key_exists('MultiGeometry', $placemark)) {
                        foreach ($placemark['MultiGeometry'] as $multiGeometry) {
                            foreach ($multiGeometry as $polygon) {
                                $lineString = null;
                                $finalPolygon = null;
                                $points = null;
                                $savePolygon = null;
                                if (is_array($polygon) && array_key_exists('innerBoundaryIs', $polygon)) {
                                    foreach ($polygon["innerBoundaryIs"] as $linearRing) {
                                        if (is_array($linearRing) && array_key_exists('coordinates', $linearRing)) {
                                            $coordinates = explode(PHP_EOL, $linearRing["coordinates"]);
                                            $finalPoints = null;
                                            foreach ($coordinates as $points) {
                                                $points = explode(',', $points);
                                                $finalPoints[] = new Point($points[0], $points[1]);
                                            }
                                            if (count($finalPoints) > 0) {
                                                $lineString[] = new LineString($finalPoints);
                                            }
                                        }
                                    }
                                }
                                if (is_array($polygon) && array_key_exists('outerBoundaryIs', $polygon)) {
                                    foreach ($polygon["outerBoundaryIs"] as $linearRing) {
                                        if (is_array($linearRing) && array_key_exists('coordinates', $linearRing)) {
                                            $coordinates = explode(PHP_EOL, $linearRing["coordinates"]);
                                            $finalPoints = null;
                                            foreach ($coordinates as $points) {
                                                $points = explode(',', $points);
                                                $finalPoints[] = new Point($points[0], $points[1]);
                                            }
                                            if (count($finalPoints) > 0) {
                                                $lineString[] = new LineString($finalPoints);
                                            }
                                        }
                                    }
                                }

                                if (count($lineString) > 0) {
                                    $finalPolygon[] = new Polygon($lineString);
                                }

                                if (count($finalPolygon) > 0) {
                                    $savePolygon = new MultiPolygon($finalPolygon);
                                    if (is_object($savePolygon)) {
                                        // var_dump('$lineString',count($lineString));
                                        // var_dump('$finalPolygon',count($finalPolygon));
                                        // var_dump('$points',count($points));
                                        // var_dump('$savePolygon',count($savePolygon));

                                        WeatherEvent::create([
                                            'date' => $date,
                                            'type' => 'hail',
                                            'weather_id' => $polygon['@attributes']['id'],
                                            'desc' => $placemark['name'],
                                            'area' => $savePolygon,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
        }

    }
}
