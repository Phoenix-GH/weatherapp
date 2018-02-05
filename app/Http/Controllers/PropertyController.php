<?php

namespace App\Http\Controllers;

use Auth;
use Mapper;
use App\Property;
use Illuminate\Http\Request;
use App\Events\PropertyAdded;
use App\Events\PropertyRemoved;
use App\Http\Requests\StoreProperty;

class PropertyController extends Controller
{
    public function dashboard()
    {
        return view('property.dashboard');
    }

    public function create()
    {
        return view('property.create');
    }

    public function store(StoreProperty $request)
    {
        $request->store(request()->toArray());

        return redirect('home');
    }

    public function show($property)
    {
        $property = Property::with('events')->find($property);

        Mapper::map($property->lat, $property->long, ['zoom' => 19]);

        return view('property.show', ['property' => $property]);
    }

    public function single($property)
    {
        $property = Property::with('events')->find($property);

        Mapper::map($property->lat, $property->long, ['zoom' => 19,  'type' => 'HYBRID']);

        return view('property.single', ['property' => $property]);
    }

    public function destroy(Property $property)
    {
        $property->delete();
        
        event(new PropertyRemoved(Auth::user()->currentTeam));

        return redirect('home');
    }

}
