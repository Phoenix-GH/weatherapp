<?php

namespace App\Providers;

use Log;
use Carbon\Carbon;
use Laravel\Spark\Spark;
use Laravel\Spark\Contracts\Http\Requests\Auth\RegisterRequest;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;
use Laravel\Spark\Contracts\Interactions\Settings\Teams\CreateTeam;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'WeatherCheck',
        'product' => 'WeatherCheck',
        'street' => '201 E. Jefferson St. Suite 315B',
        'location' => 'Louisville, KY 40202',
        'phone' => '502-822-5560',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = 'info@weathercheck.co';

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'me@weseklund.com',
        'w@weathercheck.co',
        'd@weathercheck.co',
        'info@weathercheck.co',
        's.wes35@gmail.com',
        'a@weathercheck.co'
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
//	    Spark::noProrate();
        
        Spark::useStripe();

//        Spark::teamPlan('newBasic', 'newAnnuallyNoTrialSub')
//            ->price(env('WC_COST_PER_PROPERTY'))
//	        ->trialDays(0)
//            ->yearly();

        // Spark::teamPlan('Pro', 'provider-id-2')
        //      ->price(20)
        //      ->features([
        //          'Up to 100 Properties', '50 Users'
        //      ])
        //     ->yearly();

        // Spark::teamPlan('Ultimate', 'provider-id-3')
        //      ->price(50)
        //      ->features([
        //          'Up to 100000', '100 Users'
        //      ])
        //     ->yearly();

        Spark::validateUsersWith(function () {
            return [
                'name' => 'required|max:255',
                'account_type' => 'required|exists:account_types,slug',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|
                    confirmed|
                    regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*().;:<>[\]{}?-_]).*$/|
                    min:6',
                'vat_id' => 'max:50|vat_id',
                'terms' => 'required|accepted',
            ];
        });

        Spark::createUsersWith(function ($request) {
            $user = Spark::user();

            $data = $request->all();

            $user->forceFill([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'last_read_announcements_at' => Carbon::now(),
                'trial_ends_at' => Carbon::now()->addDays(Spark::trialDays()),
            ])->save();

            return $user;
        });

        Spark::swap('Register@configureTeamForNewUser', function (RegisterRequest $request, $user) {
            if ($invitation = $request->invitation()) {
                Spark::interact(AddTeamMember::class, [$invitation->team, $user]);

                self::$team = $invitation->team;

                $invitation->delete();
            } elseif (Spark::onlyTeamPlans()) {
                self::$team = Spark::interact(CreateTeam::class, [
                    $user, [
                        'name' => $request->team,
                        'slug' => $request->team_slug,
                        'account_type' => $request->account_type,
                    ]
                ]);
            }
        });
    }

    public function register() {
        Spark::referToTeamAs('Company');
    }
}
