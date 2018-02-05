<?php

namespace App\Listeners;

use App\User;
use App\Property;
use App\TeamUsers;
use App\NotificationEvent;
use App\Events\ConvectiveOutlookRegistered;
use App\Notifications\ConvectiveOutlookAlert;




class SendConvectiveAlert
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ConvectiveOutlookRegistered  $event
     * @return void
     */
    public function handle(ConvectiveOutlookRegistered $event)
    {
        $properties = Property::all();
        foreach ($properties as $property){
            if($event->convectiveOutlook->inArea($event->convectiveOutlook->id,$property->lat,$property->long)){
                $NotificationEvent = NotificationEvent::where('event_id',$event->convectiveOutlook->aeris_id)
                    ->where('team_id' , $property->team_id)
                    ->get();
                if($NotificationEvent->isEmpty()){
                    $teamMembers = TeamUsers::where('team_id',$property->team_id)->select('user_id')->get();
                    foreach($teamMembers as $members){
                        $user = User::find($members->user_id);
                        $user->notify(new ConvectiveOutlookAlert($event->convectiveOutlook,$user));
                    }
                    NotificationEvent::create([
                        'event_id' => $event->convectiveOutlook->aeris_id,
                        'team_id' => $property->team_id
                    ]);
                }
            }
        }
    }
}
