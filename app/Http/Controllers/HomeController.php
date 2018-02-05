<?php

namespace App\Http\Controllers;

use Auth;
use Mapper;
use Illuminate\Http\Request;
use App\Notifications\PhoneNumberVerification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('teamSubscribed');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        $properties = Auth::user()->currentTeam->properties()->paginate(30);

        $properties->each(function ($property, $key) {
            if ($key == 0) {
                Mapper::map($property->lat, $property->long, ['zoom' => 11, 'marker' => false]);
            }
            Mapper::informationWindow($property->lat, $property->long, $property->link, ['autoClose' => true, ['markers' => ['icon' => config('googlmapper.markers.icon')]]]);
        });

        return view('home', [
            'properties' => $properties
        ]);
    }

    public function testsms() {
        $user = Auth::user();

        $user->notify(new PhoneNumberVerification());

        return view('home', [
            'properties' => Auth::user()->currentTeam->properties()->paginate(30)
        ]);
    }
    
}
