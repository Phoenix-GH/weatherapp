<?php

namespace App\Http\Controllers;

use App\User;
use App\Team;
use Laravel\Spark\Spark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardUserController extends Controller
{
	public function show() {
		return view('onboard.register');
	}

    public function store(Request $request)
    {
    	if(!$request->has('company')){
    		$company = $request->get('name');
	    }else{
    		$company = $request->get('company');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'account_type' => 'required',
            'password' => '
                required|
                confirmed|
                regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*().;:<>[\]{}?-_]).*$/|
                min:'.Spark::minimumPasswordLength(),
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'account_type' => $request->account_type,
            'phone' => $request->phone,
        ]);

        // If team exists, user is a member of team.
        if ($team = Team::where('slug', str_slug($company))->first()) {
            $role = 'member';
        } else {
            // Team does not exist. Create it and make the user the owner.
            $team = Team::create([
                'owner_id' => $user->id,
                'slug' => str_slug($company),
                'name' => $company,
            ]);
            $role = 'owner';
        }

        $team->users()->attach($user, ['role' => $role]);

	    Auth::loginUsingId($user->id);

        return [
            'user' => $user->toArray(),
            'team' => $team->toArray(),
            'redirect' => '/onboard/2/import',
            'message' => "Success!"
        ];
    }

    public function validateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'account_type' => 'required',
            'password' => '
                required|
                confirmed|
                regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*().;:<>[\]{}?-_]).*$/|
                min:'.Spark::minimumPasswordLength(),
        ]);

        return $request;
    }
}
