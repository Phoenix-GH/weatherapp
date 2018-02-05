<?php

namespace App\Http\Controllers;

use App\Leads;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
	public function show() {
		return view('signup');
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function store( Request $request ) {
		$this->validate($request, [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required',
		]);

		Leads::create([
			'first_name' => $request['first_name'],
			'last_name' => $request['last_name'],
			'email' => $request['email']
		]);

		return view('thankyou');
    }
}
