<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherEvent extends Model
{
    protected $casts = [
        'date' => 'date'
    ];

    protected $geometries = [
        "multipolygons" => ['area'],
    ];

    protected $hidden = ['area'];

    protected $guarded = [];

    public static function getHistory($lat, $long)
    {
        return static::whereRaw("mbrcontains(area,GeomFromText('POINT($long  $lat)'))")->orderBy('date','desc')->get();
    }

    public function getListDateAttribute()
    {
        return $this->date->format('m/d/y');
    }
}
