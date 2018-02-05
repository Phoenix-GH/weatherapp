<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * WelcomeController constructor.
     * @param WeatherData $weatherData
     */
    
  public function __construct()
    {

    }
    /**
     * Show the application splash screen.
     *
     * @return Response
     */
    
  public function signup()
    {
        return view('signup');
    }

	
  public function single_address(  ) {
		return view('single_address');
    }

	public function store( Request $request ) {
		$this->validate($request, [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required',
		]);
		$lead = [
			'first_name' => $request->get('first_name'),
			'last_name' => $request->get('last_name'),
			'email' => $request->get('email'),
		];
//		dd($lead);
//		$newsletter = new Newsletter();
//
//		$newsletter->subscribe( $lead['email']);
		Mail::to($lead['email'])->send(new ComingSoon);
		return response()->json([
			'code' => 202,
			'message' => 'Success!  Thanks for signing up!'
		]);
	}
}
