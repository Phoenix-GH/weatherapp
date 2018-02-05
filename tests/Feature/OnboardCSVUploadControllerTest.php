<?php

namespace Tests\Feature;

use Storage;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OnboardCSVUploadControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_file_can_be_uploaded_during_onboarding()
    {
        $response = $this->json('POST', '/onboard/user/create', [
            'name' => 'Jon Smith',
            'email' => 'jon@aol.com',
            'company' => 'acme',
            'account_type' => 'Property Manager',
            'password' => 'password123'
        ]);

        $stub = __DIR__.'/stubs/testcsvimport.csv';
        $name = str_random(8).'.csv';
        $path = storage_path('app/'.$name);
        
        copy($stub, $path);

        $file = new UploadedFile($path, $name, filesize($path), 'text/csv', null, true);

        $response = $this->json('POST', '/onboard/property_csv_upload', [
            'team_id' => 1,
            'csv' => $file 
        ]);

        $this->assertDatabaseHas('properties', [
            'team_id' => 1,
            'name' => '',
            'address' => '123 Main St',
            'address_2' => 'Apt D',
            'city' => 'Lexington',
            'state' => 'KY',
            'zip' => '40509',
            'country' => 'USA',
        ]);
        
        $response->assertJson([
            'message' => 'Success!'
        ]);

        Storage::delete($name);
    }
}
