<?php

namespace Database\Seeders;

use App\Models\Common;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Common::create([
            'incentive' => 100000,
            'overtime' => 173,
            'nwnp' => 30,
            'insurance' => 0.03,
        ]);
    }
}
