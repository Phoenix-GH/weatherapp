<?php

namespace App;

use App\Events\ConvectiveOutlookRegistered;
use ElevenLab\GeoLaravel\Eloquent\Model as GeoModel;
use Illuminate\Support\Facades\DB;

class ConvectiveOutlook extends GeoModel
{
    protected $geometries = [
        "multipolygons" =>   ['geo_poly'],
    ];

    protected $guarded = [];

    public static function register($attributes)
    {
        $outlook = static::create($attributes);
        event(new ConvectiveOutlookRegistered($outlook));
        return $outlook;
    }

    public static function inArea($id, $lat, $long)
    {
        $inarea = static::whereRaw("MBRContains(geo_poly,GeomFromText('POINT($lat $long)'))")->where('id',$id)->first();
        if( $inarea != NULL ){
            return TRUE;
        }
        return FALSE;

    }

}
