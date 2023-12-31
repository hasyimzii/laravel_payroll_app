<?php

namespace Database\Seeders;

use App\Models\Overtime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OvertimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Overtime::create([
            'employee_id' => 1,
            'hours' => 4,
            'total_salary' => 161850,
            'created_at' => '2023-08-01 08:00:00',
        ]);

        Overtime::create([
            'employee_id' => 2,
            'hours' => 6,
            'total_salary' => 184971,
            'created_at' => '2023-08-02 08:00:00',
        ]);
    }
}
