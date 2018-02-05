<?php

namespace ElevenLab\PHPOGC\DataTypes;

use ElevenLab\PHPOGC\OGCObject;
use ElevenLab\PHPOGC\Exceptions\GeoSpatialException;

class Polygon extends OGCObject implements \Countable
{
    protected $type = "POLYGON";

    public $linestrings = [];

    /**
     * Polygon constructor. A Polygon must be constructed with at least 1 closed linestring.
     *
     * @param array $linestrings
     */
    public function __construct(array $linestrings, $circular_check = true)
    {
        array_walk($linestrings, [$this, "is_linestring"]);
        // check that all array elements are LineString instances, and that all of them are closed (circular)
        if($circular_check) array_walk($linestrings, [$this, "is_circular_linestring"]);
        $this->linestrings = $linestrings;
    }

    /**
     * A Polygon could be instantiated with an array like that:
     *
     * [ [[x,y],[x,y],[x,y]], [[x,y],[x,y],[x,y]], ..., [[x,y],[x,y],[x,y]] ]
     *   ^^^^^^^^^^^^^^^^^^^  ^^^^^^^^^^^^^^^^^^^       ^^^^^^^^^^^^^^^^^^^
     *   external linestring  1st internal linest       i-th internal linest
     *
     * @param array $linestrings
     * @return Polygon
     */
    public static function fromArray(array $linestrings)
    {
        $parsed_linestrings = array_map(function($linestring){
            return LineString::fromArray($linestring);
        }, $linestrings);
        return new static($parsed_linestrings);
    }

    /**
     * A Polygon could be instantiated using a string containing linestrings.
     * es. "lat lon, lat lon; lat lon, lat lon; lat lon, lat lon"
     *
     * @param $linestrings
     * @param $linestrings_separator
     * @param $points_separator
     * @param $coords_separator
     * @return Polygon
     * @throws GeoSpatialException
     */
    public static function fromString($linestrings, $linestrings_separator = ";", $points_separator = ",", $coords_separator = " ")
    {
        $separators = [$linestrings_separator, $points_separator, $coords_separator];
        if(sizeof($separators) != sizeof(array_unique($separators)))
            throw new GeoSpatialException("Error: separators must be different");

        $parsed_linestrings = array_map(function($linestring) use ($points_separator, $coords_separator){
            return LineString::fromString($linestring, $points_separator, $coords_separator);
        }, explode($linestrings_separator, trim($linestrings)));

        return new static($parsed_linestrings);
    }

    /*
    |--------------------------------------------------------------------------
    | Implement OGB Object interface and various casts utility
    |--------------------------------------------------------------------------
    */

    protected function toValueArray()
    {
        return array_map(function($linestring){
            return $linestring->toArray();
        }, $this->linestrings);
    }

    public function __toString()
    {
        return implode(",", array_map(function($l){
            return "($l)";
        }, $this->linestrings));
    }

    private function is_circular_linestring($linestring)
    {
        if( ! $linestring->isCircular() )
            throw new GeoSpatialException("A LineString instance that compose a Polygon must be circular (min 4 points, first and last equals).");
    }

    private function is_linestring($linestring)
    {
        if( ! $linestring instanceof LineString)
            throw new GeoSpatialException("A Polygon instance must be composed by LineString only.");
    }

    public function count()
    {
        return count($this->linestrings);
    }
}