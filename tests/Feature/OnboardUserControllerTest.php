<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OnboardUserControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_user_is_stored_during_onboarding()
    {
        $response = $this->json('POST', '/onboard/user/create', [
            'name' => 'Jon Smith',
            'email' => 'jon@aol.com',
            'company' => 'acme',
            'account_type' => 'Property Manager',
            'password' => 'password123'
        ]);

        $response->assertJson([
            'user_id' => 1,
            'team_id' => 1,
            'message' => 'Success!'
         ]);
    }

    /** @test */
    public function user_info_is_validated_during_onboarding()
    {
        $response = $this->json('POST', '/onboard/user/create', [
            // 'name' => 'Jon Smith',
            // 'email' => 'jon@aol.com',
            // 'company' => 'acme',
            // 'account_type' => 'Property Manager',
            // 'password' => 'password123'
        ]);

        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                 'name' => [
                    'The name field is required.'
                ],
                'email' => [
                    'The email field is required.'
                ],
                'company' => [
                    'The company field is required.'
                ],
                'account_type' => [
                    'The account type field is required.'
                ],
                'password' => [
                    'The password field is required.'
                ]
            ]
        ]);
    }
}
