<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DecrementSubscriptionPropertyQuantity
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->team->subscription() != null) {
            $event->team->subscription()->decrementQuantity(1);
        }
    }
}
