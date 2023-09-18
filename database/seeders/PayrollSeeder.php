<?php

namespace Database\Seeders;

use App\Models\Payroll;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payroll::create([
            'employee_id' => 1,
            'user_id' => 2,
            'basic_salary' => 5000000,
            'allowance' => 2000000,
            'incentive' => 1200000,
            'overtime' => 1000000,
            'nwnp' => 50000,
            'insurance' => 150000,
            'status' => 'draft',
            'payroll_date' => '2023-07-01',
        ]);
    }
}
