<?php

namespace App\Http\Controllers;

use App\Geocode;
use App\Property;
use Illuminate\Http\Request;
use App\Services\Address;

class SingleCheckAddressController extends Controller
{
    public function welcome() {
        if(auth()->user()){
            return redirect()->intended('dashboard');
        }
        return view('single_address');
    }

    public function show(Property $property)
    {
        $events = $property->weather_events()->each(function($event) use ($property){
            return $property->events()->attach($event);
        });

        return view('single_check_address', [
            'property' => $property,
            'events' => $events->toArray()
        ]);
    }

    public function store(Request $request , Address $address) {
        $this->validate($request, [
            'address' => 'required',
        ]);

        $address = $address->extract($request['address']);
        if($address === false){
            return redirect()->back()->withInput()->with('errors', ['Unable to located Address']);
        }

        $property = Property::create([
            'team_id' => 1,
            'address' => $address->delivery_line_1,
            'city' => $address->components->city_name,
            'state' =>  $address->components->state_abbreviation,
            'zip' => $address->components->zipcode,
            'country' => 'us'
        ]);

        Geocode::property($property);

        return redirect('address/'.$property->id);        
    }

}
