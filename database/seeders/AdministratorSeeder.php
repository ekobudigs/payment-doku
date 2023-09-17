<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrators = [
            [
                'username' => 'arie',
                'name' => 'Administrator Arie',
                'email' => 'ariee.setiadi@gmail.com',
                'phone' => '082146335727',
                'password' => Hash::make('arie'),
                'status' => true,
            ],
        ];

        Administrator::truncate();

        foreach ($administrators as $administrator) {
            Administrator::create($administrator);
        }
    }
}
