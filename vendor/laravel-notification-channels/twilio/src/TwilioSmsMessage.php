<?php

namespace NotificationChannels\Twilio;

class TwilioSmsMessage extends TwilioMessage
{
    /**
     * @var null|string
     */
    public $alphaNumSender = null;

    /**
     * Get the from address of this message.
     *
     * @return null|string
     */
    public function getFrom()
    {
        if ($this->from) {
            return $this->from;
        }

        if ($this->alphaNumSender && strlen($this->alphaNumSender) > 0) {
            return $this->alphaNumSender;
        }
    }

    /**
     * Set the alphanumeric sender.
     *
     * @param $sender
     */
    public function sender($sender)
    {
        $this->alphaNumSender = $sender;
    }
}
