<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Spark\Contracts\Interactions\Subscribe;
use Laravel\Spark\Events\Teams\Subscription\TeamSubscribed;
use Spark;

class OnboardPaymentController extends Controller
{
	/**
	 * @param Request $request
	 *
	 * @return array
	 * @internal param $team_id
	 *
	 */
	public function total(Request $request)
    {
        return [
            'message' => 'Success!',
            'data' => [
	            'number_of_properties' => Auth::user()->currentTeam->properties()->count(),
	            'cost_per_property' => env('WC_COST_PER_PROPERTY'),
	            'payment_total' => Auth::user()->currentTeam->properties()->count() * env('WC_COST_PER_PROPERTY'),
	            'invoice_link' => 'to be determined',
            ]
        ];
    }

    public function payment(Request $request)
    {
    	$coupon = null;

    	if($request->has('coupon')){
    		$coupon = $request->coupon;
	    }

		$team = Auth::user()->currentTeam();

		$plan = $team->newSubscription('newBasic', 'newAnnuallyNoTrialSub')
			->quantity(Auth::user()->currentTeam->properties()->count())
			->skipTrial()
			->withCoupon($coupon)
			->create(Auth::user()->stripe_id);


//        event(new TeamSubscribed(Auth::user()->currentTeam(), $plan));

        return response('Successful Plan Update', 200);
    }

	public function receipt() {
		return Auth::user()->invoicesIncludingPending();
    }
}
