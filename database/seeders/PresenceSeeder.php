<?php

namespace Database\Seeders;

use App\Models\Presence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datetimes = [
            '2023-08-01 08:00:00', '2023-08-02 08:00:00', '2023-08-03 08:00:00', '2023-08-04 08:00:00', '2023-08-07 08:00:00',
            '2023-08-08 08:00:00', '2023-08-09 08:00:00', '2023-08-10 08:00:00', '2023-08-11 08:00:00', '2023-08-14 08:00:00',
            '2023-08-15 08:00:00', '2023-08-16 08:00:00', '2023-08-17 08:00:00', '2023-08-18 08:00:00', '2023-08-21 08:00:00',
            '2023-08-22 08:00:00', '2023-08-23 08:00:00',
        ];

        foreach ($datetimes as $date) {
            Presence::create([
                'employee_id' => 1,
                'status' => 'present',
                'created_at' => $date,
            ]);

            Presence::create([
                'employee_id' => 2,
                'status' => 'present',
                'created_at' => $date,
            ]);
        }
    }
}
