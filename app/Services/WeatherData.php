<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\ConvectiveOutlook;
use ElevenLab\PHPOGC\DataTypes\Point as Point;
use ElevenLab\PHPOGC\DataTypes\LineString as Linestring;
use ElevenLab\PHPOGC\DataTypes\Polygon as Polygon;
use ElevenLab\PHPOGC\DataTypes\MultiPolygon as MultiPolygon;


class WeatherData
{
    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
        $this->clientID     = env('AERIS_ID');
        $this->clientSecret = env('AERIS_SECRET');
        $this->url = "https://api.aerisapi.com/";
    }

    public function buildUrl($endpoint, $action, $parameters=[])
    {
        $parameters = array_merge($parameters, ['client_id'=> $this->clientID , 'client_secret' => $this->clientSecret]);

        $url = $this->url;
        $url .= $endpoint ."/". $action . "?";

        foreach ($parameters as $key => $parameter){
            $url .= $key.'='.$parameter.'&';
        }

        return $url;
    }

    public function outlook()
    {
        $url = $this->buildUrl('/convective/outlook','search',[
            'from'=> 'today',
            'to'=>'+7days',
            'sort'=>'day',
            'filter'=>'geo',
        ]);

        try {
            $outlooks = json_decode($this->client->get($url )->getBody()->getContents());

            foreach($outlooks->response as $outlook){
                if($this->newOutlook($outlook)){
                    if($outlook->geoPoly->type == "Polygon"){
                        $multiPolygon = $this->newPolygon($outlook->geoPoly->coordinates);
                    }else{
                        $multiPolygon = $this->newMultiPolygon($outlook->geoPoly->coordinates);
                    }
                    $this->createConvectiveOutlook( $outlook, $multiPolygon );
                }
            }
            return true;
        } catch(GuzzleException $e) {
            \Log::error($e);
        }
    }

    private function newOutlook($outlook)
    {
        $convective = ConvectiveOutlook::where('aeris_id',$outlook->id)->first();

        if(NULL != $outlook->details->risk && NULL == $convective){
           return true;
        }

        return false;
    }

    private function newMultiPolygon($coordinates)
    {
        $multiPolygon = NULL;
        $multiArray = NULL;
        foreach($coordinates as $MultiPolygons){
            $polygonArray = NULL;

            foreach($MultiPolygons as $Polygon){
                $pointArray = NULL;

                foreach($Polygon as $lineString){
                    $point = new Point($lineString[1],$lineString[0]);
                    $pointArray[] = $point;
                }

                $polygonArray[] = new LineString($pointArray);
            }

            $multiArray[] = new Polygon($polygonArray);
        }

        if(count($multiArray) > 0){
            $multiPolygon = new MultiPolygon($multiArray);
        }

        return $multiPolygon;
    }

    private function newPolygon($coordinates)
    {
        $polygonArray = NULL;
        foreach($coordinates as $polygon){
            $pointArray = NULL;
            foreach($polygon as $lineString){
                $point = new Point($lineString[1],$lineString[0]);
                $pointArray[] = $point;
            }
            if(count($pointArray) > 0){
                $polygonArray[] = new LineString($pointArray);
            }
        }
        if(count($polygonArray) > 0){
            $multiArray[] = new Polygon($polygonArray);
        }

        $polygonArray = array_merge($multiArray,$multiArray);
        $multiPolygon = new MultiPolygon($polygonArray);
        return $multiPolygon;
    }

    private function createConvectiveOutlook($outlook,$multiPolygon)
    {
        ConvectiveOutlook::register([
            'aeris_id' => $outlook->id,
            'days_to_event' => $outlook->details->day,
            'min_date_time_iso' => $outlook->details->range->minDateTimeISO,
            'max_date_time_iso' => $outlook->details->range->maxDateTimeISO,
            'issued_date_time_iso' => $outlook->details->issuedDateTimeISO,
            'risk_type' => $outlook->details->risk->type,
            'risk_name' => $outlook->details->risk->name,
            'risk_code' => $outlook->details->risk->code,
            'geo_poly' => $multiPolygon,
        ]);
    }
}