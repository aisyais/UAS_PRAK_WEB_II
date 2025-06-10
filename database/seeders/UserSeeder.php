<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Ensure the email and password match the login form
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com', // Matches the login form
            'password' => Hash::make('password'), // Password = password
        ]);
    }
}
