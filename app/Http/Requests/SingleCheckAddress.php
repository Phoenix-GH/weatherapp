<?php

namespace App\Http\Requests;

use Auth;
use Validator;
use App\Geocode;
use App\Property;
use Illuminate\Http\Request;
use App\Events\PropertyAdded;
use Illuminate\Foundation\Http\FormRequest;

class SingleCheckAddress extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

	public function rules()
	{
		return [];
	}

	public function store($request)
	{
		Validator::make($request, [
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zip' => 'required',
			'country' => 'required',
		]);

		$property = Property::create([
			'team_id' => -1,
			'name' => $request['name'],
			'address' => $request['address'],
			'address_2' => $request['address_2'],
			'city' => $request['city'],
			'state' => $request['state'],
			'zip' => $request['zip'],
			'country' => $request['country'],
			'lat' => $request['lat'],
			'long' => $request['long'],
		]);

		Geocode::property($property);
	}
}
