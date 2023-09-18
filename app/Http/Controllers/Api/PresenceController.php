<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresenceController extends Controller
{
    public function employee()
    {
        $employee = Employee::all();
        
        if (!$employee->isEmpty()) {
            $data = [];
            foreach ($employee as $item) {
                $data[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'gender' => $item->gender,
                    'position' => $item->position,
                    'status' => $item->status,
                    'start_date' => $item->start_date,
                ];
            }

            return response()->json(['data' => $data], 200);
        } else {
            return response()->json(['message' => 'Data karyawan tidak ditemukan!'], 404);
        }
    }

    public function presence(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 400);
        }

        $presence = Presence::whereDate('created_at', Carbon::today())->first();
        if (isset($presence)) {
            return response()->json([
                'message' => 'Karyawan sudah melakukan presensi hari ini!'
            ], 400);
        }

        Presence::create([
            'employee_id' => $request->employee_id,
            'status' => 'present',
        ]);
 
        return response()->json([
            'message' => 'Berhasil melakukan presensi!'
        ], 200);
    }
}
