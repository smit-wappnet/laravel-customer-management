<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $customer = new Customer();
        $customer->firstname = "Demo name";
        $customer->middlename = "Demo Middlename";
        $customer->lastname = "Demo lastname";
        $customer->mobile = "0000111100";
        $customer->email = "demo@demo.com";
        $customer->city = "Demo";
        $customer->save();
    }
}
