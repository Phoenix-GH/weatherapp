<?php

namespace App\Http\Controllers;

use App\Notifications\PhoneNumberVerification;
use Illuminate\Http\Request;
use App\NotificationPreference as Preference;
use Twilio\Rest\Client;

class OnboardNotifyController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return array
	 */
	public function store(Request $request)
    {
        Preference::create([
            'user_id' => $request->user_id,
            'team_id' => $request->team_id,
            'days_before_event' => $request->days_before_event,
            'days_after_event' => $request->days_after_event,
            'method' => $request->notifyOption,
            'sms' => $request->phone,
            'email' => $request->email,
        ]);
        
        return response('Preferences Saved!', 200);
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function testPhoneNumber( Request $request ) {
    	if(!$request->has('phone')){
    		return response('Phone number missing', 422);
	    }

	    $phone_number = $request->get('phone');

    	$twilio_client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH'));

    	$message = $twilio_client->messages->create(
    		$phone_number,[
    			'from' => env('TWILIO_FROM'),
			    'body' => 'WeatherCheck testing your phone number!'
		    ]
	    );

		return response('Text message incoming!', 200);
    }
}
