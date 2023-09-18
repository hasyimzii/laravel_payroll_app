<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EmployeeController extends Controller
{
    private function checkId($id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            Alert::toast('Data karyawan tidak ditemukan!', 'error');
            return false;
        }
        return $employee;
    }

    public function index()
    {
        $employee = Employee::all();
        return view('employee.index', compact('employee'));
    }

    public function show($id)
    {
        $employee = $this->checkId($id);
        if (!$employee) return back();

        $presence = $employee->presence()->latest()->get();
        $overtime = $employee->overtime()->latest()->get();
        $insurance = $employee->insurance()->latest()->get();
        
        return view('employee.show', compact('employee', 'presence', 'overtime', 'insurance'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'name' => ['required', 'string', 'max:50'],
            'birth_place' => ['required', 'string', 'max:20'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'position' => ['required', 'string', 'max:20'],
            'status' => ['required', 'string'],
            'basic_salary' => ['required', 'integer', 'max_digits:10'],
            'allowance' => ['required', 'integer', 'max_digits:10'],
            'start_date' => ['required', 'date'],
        ]);
        if (!$validated) return back();

        Employee::create([
            'name' => $request->name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'position' => $request->position,
            'status' => $request->status,
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'start_date' => $request->start_date,
        ]);
 
        Alert::toast('Berhasil menambah data karyawan!', 'success');
        return to_route('employee.index');
    }
    
    public function edit($id)
    {
        $employee = $this->checkId($id);
        if (!$employee) return back();

        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = $this->checkId($id);
        if (!$employee) return back();
        
        $validated = WebRequest::validator($request->all(), [
            'name' => ['required', 'string', 'max:50'],
            'birth_place' => ['required', 'string', 'max:20'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'position' => ['required', 'string', 'max:20'],
            'status' => ['required', 'string'],
            'basic_salary' => ['required', 'integer', 'max_digits:10'],
            'allowance' => ['required', 'integer', 'max_digits:10'],
            'start_date' => ['required', 'date'],
        ]);
        if (!$validated) return back();

        $employee->update([
            'name' => $request->name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'position' => $request->position,
            'status' => $request->status,
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'start_date' => $request->start_date,
        ]);
 
        Alert::toast('Berhasil mengubah data karyawan!', 'success');
        return to_route('employee.index');
    }

    public function delete($id)
    {
        $employee = $this->checkId($id);
        if (!$employee) return back();

        $employee->delete();

        Alert::toast('Berhasil menghapus data karyawan!', 'success');
        return back();
    }
}
