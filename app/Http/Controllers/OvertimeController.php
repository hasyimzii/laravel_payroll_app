<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Overtime;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OvertimeController extends Controller
{
    private function checkId($id)
    {
        $overtime = Overtime::find($id);
        if (is_null($overtime)) {
            Alert::toast('Data lembur tidak ditemukan!', 'error');
            return false;
        }
        return $overtime;
    }

    private function countOvertime($employee, $hours)
    {
        $salary_per_hours = 0;
        $overtime_hours = 0;

        if ($employee->status == 'fulltime' || $employee->status == 'contract') {
            $salary_per_hours = ($employee->basic_salary + $employee->allowance) / 173;
        } else if ($employee->status == 'freelance') {
            $salary_per_hours = $employee->basic_salary / 173;
        } else {
            Alert::toast('Status karyawan tidak sesuai!', 'error');
            return false;
        }

        if ($hours > 4) {
            $overtime_hours = 4 + (($hours - 4) * 2);
        } else {
            $overtime_hours = $hours;
        }

        return $salary_per_hours * $overtime_hours;
    }

    public function index()
    {
        $overtime = Overtime::latest()->get();
        return view('overtime.index', compact('overtime'));
    }

    public function create()
    {
        $employee = Employee::all();
        return view('overtime.create', compact('employee'));
    }

    public function store(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'employee_id' => ['required', 'integer'],
            'hours' => ['required', 'integer'],
        ]);
        if (!$validated) return back();

        $employee = Employee::find($request->employee_id);
        if (is_null($employee)) {
            Alert::toast('Data karyawan tidak ditemukan!', 'error');
            return back();
        }
        
        $total_salary = $this->countOvertime($employee, $request->hours);
        if (!$total_salary) return back();

        Overtime::create([
            'employee_id' => $request->employee_id,
            'hours' => $request->hours,
            'total_salary' => $total_salary,
        ]);
 
        Alert::toast('Berhasil menambah data lembur!', 'success');
        return to_route('overtime.index');
    }
    
    public function edit($id)
    {
        $overtime = $this->checkId($id);
        if (!$overtime) return back();

        return view('overtime.edit', compact('overtime'));
    }

    public function update(Request $request, $id)
    {
        $overtime = $this->checkId($id);
        if (!$overtime) return back();
        
        $validated = WebRequest::validator($request->all(), [
            'hours' => ['required', 'integer'],
        ]);
        if (!$validated) return back();

        $total_salary = $this->countOvertime($overtime->employee(), $request->hours);
        if (!$total_salary) return back();

        $overtime->update([
            'hours' => $request->hours,
            'total_salary' => $total_salary,
        ]);
 
        Alert::toast('Berhasil mengubah data lembur!', 'success');
        return to_route('overtime.index');
    }

    public function delete($id)
    {
        $overtime = $this->checkId($id);
        if (!$overtime) return back();

        $overtime->delete();

        Alert::toast('Berhasil menghapus data lembur!', 'success');
        return back();
    }
}
