<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(CommonSeeder::class);
        $this->call(OvertimeSeeder::class);
        $this->call(InsuranceSeeder::class);
    }
}
