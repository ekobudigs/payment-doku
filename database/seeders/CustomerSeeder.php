<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'username' => 'arie',
                'name' => 'Customer Arie',
                'email' => 'ariee.setiadi@gmail.com',
                'phone' => '082146335727',
                'password' => Hash::make('arie'),
                'status' => true,
            ],
        ];

        Customer::truncate();

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
