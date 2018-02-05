<?php

namespace App\Http\Controllers;

use App\Notifications\PhoneNumberVerification;
use Illuminate\Http\Request;
use App\NotificationPreference as Preference;
use Twilio\Rest\Client;

class OnboardImportController extends Controller
{
    public function status()
    {
        $data['importing'] = session('importing');
        return response($data , 200);
    }
}
