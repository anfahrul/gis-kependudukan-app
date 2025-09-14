<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Administrator 1',
                'email' => 'Administrator1@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'administrator'
            ],
            [
                'name' => 'Staff 1',
                'email' => 'staff1@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'staff'
            ]
        ];

        foreach ($userData as $key => $value) {
            User::create($value);
        };
    }
}
