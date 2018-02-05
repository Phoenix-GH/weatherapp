<?php

namespace Tests\Feature;

use App\Property;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OnboardPaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testExample()
    {
        // Create a user and get the id
        $response = $this->json('POST', '/onboard/user/create', [
            'name' => 'Jon Smith',
            'email' => 'jon@aol.com',
            'company' => 'acme',
            'account_type' => 'Property Manager',
            'password' => 'password123'
        ]);
        
        Property::create([
            'name' => 'test',
            'address' => '123 Main St',
            'address_2' => '',
            'city' => 'Lexington',
            'state' => 'KY',
            'country' => 'USA',
            'zip' => '40509',
            'lat' => '',
            'long' => '',
            'team_id' => $response->getData()->team_id
        ]);
        
        $paymentTotalResponse = $this->json('GET', '/onboard/payment_order/'.$response->getData()->team_id, [
           'user_id' => $response->getData()->user_id,
           'team_id' => $response->getData()->team_id,
        ]);

        $paymentTotalResponse->assertJson([
            'message' => 'Success!',
            'payment_total' => 10
        ]);
    }
}
