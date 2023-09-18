<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_id' => 1,
            'name' => 'User Supervisor',
            'username' => 'spvpayroll',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'User Staff',
            'username' => 'stfpayroll',
            'password' => Hash::make('password123'),
        ]);
    }
}
