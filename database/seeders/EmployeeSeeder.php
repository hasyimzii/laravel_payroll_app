<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'name' => 'Mamat Surahmat',
            'birth_place' => 'Jember',
            'birth_date' => '1998-10-11',
            'gender' => 'male',
            'position' => 'Staff Web Developer',
            'status' => 'fulltime',
            'basic_salary' => 5000000,
            'allowance' => 2000000,
            'start_date' => '2021-09-01',
        ]);

        Employee::create([
            'name' => 'Tati Surati',
            'birth_place' => 'Bekasi',
            'birth_date' => '2000-02-22',
            'gender' => 'female',
            'position' => 'Staff Accountant',
            'status' => 'freelance',
            'basic_salary' => 4000000,
            'allowance' => 1000000,
            'start_date' => '2023-09-01',
        ]);
    }
}
