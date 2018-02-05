<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotificationPreference;

class NotificationSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showBefore() {
        return \Auth::user()->notificationPreference->days_before_event;
    }

    public function storeBefore( Request $request ) {
        $notificationPreference = NotificationPreference::where('user_id', \Auth::user()->id )->first();
        $notificationPreference->days_before_event = $request->body;

        try {
            $notificationPreference->save();
            return \Response::json(array(
                'success' => true,
            ));
        } catch (\Exception $e) {
            return \Response::json(array(
                'success' => false,
            ));
        }

    }
}