<?php

namespace App\Events;

use App\ConvectiveOutlook;
use Illuminate\Queue\SerializesModels;

class ConvectiveOutlookRegistered
{
    use SerializesModels;

    public $convectiveOutlook;

    /**
     * Create a new event instance.
     *
     * @param ConvectiveOutlook $convectiveOutlook
     */
    public function __construct(ConvectiveOutlook $convectiveOutlook)
    {
        $this->convectiveOutlook = $convectiveOutlook;
    }

}
