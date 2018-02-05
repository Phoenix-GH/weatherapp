<?php

namespace NotificationChannels\Twilio;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client as TwilioService;

class TwilioProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(TwilioChannel::class)
            ->needs(Twilio::class)
            ->give(function () {
                return new Twilio(
                    $this->app->make(TwilioService::class),
                    $this->app->make(TwilioConfig::class)
                );
            });

        $this->app->bind(TwilioService::class, function () {
            $config = $this->app['config']['services.twilio'];
            return new TwilioService($config['account_sid'], $config['auth_token']);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(TwilioConfig::class, function () {
            return new TwilioConfig($this->app['config']['services.twilio']);
        });
    }
}
