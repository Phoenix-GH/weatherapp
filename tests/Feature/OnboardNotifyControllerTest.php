<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OnboardNotifyControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function notification_preferences_are_stored_during_onboarding()
    {
        // Create a user and get the id
        $response = $this->json('POST', '/onboard/user/create', [
            'name' => 'Jon Smith',
            'email' => 'jon@aol.com',
            'company' => 'acme',
            'account_type' => 'Property Manager',
            'password' => 'password123'
        ]);
        
        $notifyResponse = $this->json('POST', '/onboard/notify_settings', [
           'user_id' => $response->getData()->user_id,
           'team_id' => $response->getData()->team_id,
           'days_before_event' => 2,
           'days_after_event' => 1,
           'method' => 'email',
        ]);

        $this->assertDatabaseHas('notification_preferences', [
            'user_id' => 1,
            'team_id' => 1,
            'days_before_event' => 2,
            'days_after_event' => 1,
            'method' => 'email',
        ]);

        $notifyResponse->assertJson([
            'message' => 'Success!'
        ]);
    }
}
