<?php

namespace App\Events;

use App\Property;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PropertyAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $property;

	/**
	 * Create a new event instance.
	 *
	 * @param Property $property
	 */
    public function __construct(Property $property)
    {
        $this->property = $property;
    }
}
