<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertySearchController extends Controller
{
	public function getCityState() {

		return Auth::user()->currentTeam->properties()
			->select('city','state')
			->get();
	}

	public function getPropertiesByCityState(Request $request, $city, $state) {

		return Auth::user()->currentTeam->properties()
			->where('city', $city)
			->where('state', $state)
			->get();

	}
	
	public function getProperties()
	{
        $properties = Auth::user()->currentTeam->properties()->get();
        return $properties;
	}
}
