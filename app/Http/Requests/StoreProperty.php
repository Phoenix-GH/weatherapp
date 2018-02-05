<?php

namespace App\Http\Requests;

use App\PropertyMeta;
use Auth;
use Validator;
use App\Geocode;
use App\Property;
use App\Services\Address;
use App\Events\PropertyAdded;
use Illuminate\Foundation\Http\FormRequest;

class StoreProperty extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function store($request)
    {
        $lookupAddress = new Address;
        $address = $lookupAddress->extract(implode(" ",$request));

        $property = Property::create([
            'team_id' => isset($request['team_id']) ? $request['team_id'] : Auth::user()->currentTeam->id, 
            'name' => $request['name'],
            'address' => $address->delivery_line_1,
            'address_2' => $request['address_2'],
            'city' => $address->components->city_name,
            'state' => $address->components->state_abbreviation,
            'zip' => $address->components->zipcode,
            'country' => $request['country'],
            'lat' => null,
            'long' => null
        ]);

        $propertyMeta = PropertyMeta::create([
            'property_id' => $property->id,
            'meta' => json_encode($address)
        ]);

        Geocode::property($property);

        event(new PropertyAdded($property));
    }
}
