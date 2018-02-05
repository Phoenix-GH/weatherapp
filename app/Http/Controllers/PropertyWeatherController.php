<?php

namespace App\Http\Controllers;

use Auth;
use App\Property;
use Illuminate\Http\Request;

class PropertyWeatherController extends Controller
{
    public function index(Property $property)
    {
        $connectedEvents = $property->events;
        
        $newlyFoundEvents = $property->weather_events()->filter(function ($event) use ($connectedEvents, $property) {
            return ! $connectedEvents->contains($event);
        })->each(function ($event) use ($property) {
            return $property->events()->attach($event);
        });

        return $newlyFoundEvents->toArray();
    }
}
