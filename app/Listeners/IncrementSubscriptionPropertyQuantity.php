<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncrementSubscriptionPropertyQuantity
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $propertyCount = $event->property->team->properties->count();
        if ($event->property->team->subscription() != null) {
            $event->property->team->subscription()->incrementQuantity(1);
        }
    }
}
