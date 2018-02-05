<?php

namespace App\Http\Controllers;

use App\ZurichClaimForm;
use Illuminate\Http\Request;

class ZurichFormController extends Controller
{
	public function store( Request $request ) {
		ZurichClaimForm::create([
			'user_id' => $request->user_id,
			'team_id' => $request->team_id,
			'property_id' => $request->property_id,
			'insured_name' => $request->parent_company_name,
			'policy_number' => $request->policy_number,
			'policy_zip' => $request->policy_zip,
			'policy_city' => $request->policy_city,
			'policy_state' => $request->policy_state,
			'policy_country' => $request->policy_country,
			'reporter_name' => $request->reporter_name,
			'reporter_phone' => $request->reporter_phone,
			'reporter_email' => $request->reporter_email,
			'relationship_to_claim' => $request->relationship_to_claim,
			'contact_name' => $request->contact_name,
			'contact_phone' => $request->contact_phone,
			'contact_email' => $request->contact_email,
			'property_loss_type' => $request->property_loss_type,
			'loss_date' => $request->loss_date,
			'loss_time' => $request->loss_time,
			'loss_location_address' => $request->loss_location_address,
			'loss_location_city' => $request->loss_location_city,
			'loss_location_state' => $request->loss_location_state,
			'loss_location_zip' => $request->loss_location_zip,
			'loss_location_country' => $request->loss_location_country,
			'loss_description' => $request->loss_description,
			'has_restoration_company_contacted' => $request->has_restoration_company_contacted,
			'has_business_interrupted_due_to_loss' => $request->has_business_interrupted_due_to_loss,
			'authorities_contacted' => $request->authorities_contacted,
			'property_location' => $request->property_location,
			'property_description' => $request->property_description,
			'damage_description' => $request->damage_description,
			'damage_estimate' => $request->damage_estimate,
			'additional_information' => $request->additional_information
		]);

		return [
			'message' => 'Success!'
		];
    }
}
