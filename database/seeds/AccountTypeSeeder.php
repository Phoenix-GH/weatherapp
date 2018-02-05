<?php

use Illuminate\Database\Seeder;

use App\AccountType;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::create([
            'name' => 'REIT',
            'slug' => 'reit',
            'tip' => 'If you manage multiple properties as part of a REIT'
        ]);

        AccountType::create([
            'name' => 'Property Manager',
            'slug' => 'property-manager',
            'tip' => 'If you manage, but don\'t own properties',
        ]);

        AccountType::create([
            'name' => 'Renter',
            'slug' => 'renter',
            'tip' => 'If you are a renter',
        ]);
    }
}
