<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    protected $fillable = ['lat', 'long', 'address', 'address_2', 'city', 'state', 'country', 'zip', 'name', 'team_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getNameAttribute($value)
    {
        return $value ? $value . ' | ' . $this->full_address : $this->full_address;
    }

    public function getFullAddressAttribute()
    {
        return implode(' ', [
            $this->address,
            $this->address_2,
            $this->city,
            $this->state,
            $this->country,
            $this->zip,
        ]);
    }

    /**
     * Returns a collection of WeatherEvents that have been connected to 
     * Property in previous query.
     * @return Collection
     */
    public function events()
    {
        return $this->belongsToMany(WeatherEvent::class)->orderBy('date', 'DESC');
    }

    public function weather_events()
    {
        return WeatherEvent::getHistory($this->lat, $this->long);
    }

    public function getLinkAttribute()
    {
        return '<a href="'.url('property/single/'.$this->id).'">View Property</a>';
    }
}
