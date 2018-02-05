<?php

namespace App\Http\Controllers;

use Auth;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function faq() {
		return view('faq');
	}

    public function dashboard() {
	    return view('dashboard.dashboard');
    }

    public function dashboardMap() {
        $properties = Auth::user()->currentTeam->properties()->paginate(30);

        $properties->each(function ($property, $key) {
            if ($key == 0) {
                    Mapper::map($property->lat, $property->long, ['zoom' => 10, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 20, 'center' => true, 'zoom' => 20]]);
            }
            if(abs($property->lat) > 0 and abs($property->long) > 0 ){
                Mapper::informationWindow($property->lat, $property->long, $property->link, ['autoClose' => true, ['markers' => ['icon' => config('googlmapper.markers.icon')]]]);
            }
         });

        return view('dashboard.map');
    }

    public function dashboardList() {
        return view('dashboard.list');
    }
    
	public function serviceProviders() {
		return view('pages.service-providers');
    }

    public function profile() {
        return view('pages.profile');
    }

    public function propertyMap() {
        return view('pages.property-map');
    }
}
