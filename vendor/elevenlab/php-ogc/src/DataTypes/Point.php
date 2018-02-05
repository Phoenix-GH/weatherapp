<?php

namespace ElevenLab\PHPOGC\DataTypes;

use ElevenLab\PHPOGC\OGCObject;
use ElevenLab\PHPOGC\Exceptions\GeoSpatialException;

class Point extends OGCObject
{
    protected $type = "POINT";

    protected static $greatCircleproviders = [ 'haversine', 'vincenty' ];

    public $lat;
    public $lon;
    public $address = null;

    /**
     * Point constructor.
     *
     * By default, a Point object could be instantiated from two elements, string or number are allowed:
     *      $point = new Point(1.123, 2.345)
     *      $point = new Point("1.1232", "2.345")
     *
     * @param $lat
     * @param $lon
     */
    public function __construct($lat, $lon)
    {
        $this->lat = (float) $lat;
        $this->lon = (float) $lon;
    }

    /**
     * A Point could be instantiated from array containing a tuple of string|float lat, lon
     *      $point = Point::fromArray(["1.123", "2.345"])
     *      $point = Point::fromArray([1.123, 2.345])
     *
     * @param array $points
     * @return Point
     * @throws GeoSpatialException
     */
    public static function fromArray(array $points)
    {
        if(count($points) != 2)
            throw new GeoSpatialException('Error: wrong number of array elements, two needed');

        return new Point($points[0], $points[1]);
    }

    /**
     * A Point could be instantiated from a string with a delimiters, by default " " is used
     *      $point = Point::fromString("1.123 2.345")
     *      $point = Point::fromString("1.123: 2.345", ":")
     *
     * @param $points
     * @param string $separator
     * @throws GeoSpatialException
     * @return Point
     */
    public static function fromString($points, $separator = " ")
    {
        $p = explode($separator, trim($points));

        if(count($p) != 2)
            throw new GeoSpatialException('Error creating Point from string ' . $points);

        return new Point($p[0], $p[1]);
    }

    /*
    |--------------------------------------------------------------------------
    | Implement OGB Object interface and various casts utility
    |--------------------------------------------------------------------------
    */
    protected function toValueArray()
    {
        return [$this->lat, $this->lon];
    }

    public function __toString()
    {
        return "$this->lat $this->lon";
    }

    /*
    |--------------------------------------------------------------------------
    | Distance between points
    |--------------------------------------------------------------------------
    |
    | You can get the great circle distance (https://en.wikipedia.org/wiki/Great-circle_distance)
    | between two points  using one of the providers.
    |
    */
    /**
     * Calculate the distance between two points in meter.
     *
     * @param Point $p1
     * @param Point $p2
     * @param string $provider
     * @return float
     * @throws GeoSpatialException
     */
    public static function distance(Point $p1, Point $p2, $provider = "haversine")
    {
        switch ($provider){
            case "haversine":
                return self::haversineGreatCircleDistance($p1, $p2);

            case "vincenty":
                return self::vincentyGreatCircleDistance($p1, $p2);

            default:
                throw new GeoSpatialException('Great circle distance provider not found, providers available: ' . implode(", ", self::$greatCircleproviders));
        }
    }

    /**
     * @param Point $from
     * @param Point $to
     * @param int $earthRadius
     * @return float
     */
    private static function vincentyGreatCircleDistance(Point $from, Point $to, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($from->lat);
        $lonFrom = deg2rad($from->lon);
        $latTo = deg2rad($to->lat);
        $lonTo = deg2rad($to->lon);
        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    /**
     * @param Point $from
     * @param Point $to
     * @param int $earthRadius
     * @return float
     */
    private static function haversineGreatCircleDistance(Point $from, Point $to, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($from->lat);
        $lonFrom = deg2rad($from->lon);
        $latTo = deg2rad($to->lat);
        $lonTo = deg2rad($to->lon);
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}