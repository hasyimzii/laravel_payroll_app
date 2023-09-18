<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Insurance;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InsuranceController extends Controller
{
    private function checkId($id)
    {
        $insurance = Insurance::find($id);
        if (is_null($insurance)) {
            Alert::toast('Data BPJS tidak ditemukan!', 'error');
            return false;
        }
        return $insurance;
    }

    private function countInsurance($employee)
    {
        return ($employee->basic_salary + $employee->allowance) * 0.03;
    }

    public function index()
    {
        $insurance = Insurance::latest()->get();
        return view('insurance.index', compact('insurance'));
    }

    public function create()
    {
        $employee = Employee::all();
        return view('insurance.create', compact('employee'));
    }

    public function store(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'employee_id' => ['required', 'integer'],
        ]);
        if (!$validated) return back();

        $employee = Employee::find($request->employee_id);
        if (is_null($employee)) {
            Alert::toast('Data karyawan tidak ditemukan!', 'error');
            return back();
        }
        
        $total_fee = round($this->countInsurance($employee));

        Insurance::create([
            'employee_id' => $request->employee_id,
            'total_fee' => $total_fee,
        ]);
 
        Alert::toast('Berhasil menambah data BPJS!', 'success');
        return to_route('insurance.index');
    }

    public function delete($id)
    {
        $insurance = $this->checkId($id);
        if (!$insurance) return back();

        $insurance->delete();

        Alert::toast('Berhasil menghapus data BPJS!', 'success');
        return back();
    }
}
