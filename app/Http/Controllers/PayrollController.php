<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Insurance;
use App\Models\Overtime;
use App\Models\Payroll;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PayrollController extends Controller
{
    private function checkId($id)
    {
        $payroll = Payroll::find($id);
        if (is_null($payroll)) {
            Alert::toast('Data payroll tidak ditemukan!', 'error');
            return false;
        }
        return $payroll;
    }

    private function countIncentive($lastdate, $employee_startdate)
    {
        $start_date = Carbon::parse($employee_startdate);
        $total_workyear = $lastdate->diffInYears($start_date);

        return 1000000 + (100000 * $total_workyear);
    }

    private function countOvertime($firstdate, $lastdate, $employee_id)
    {
        return Overtime::whereBetween('created_at', [$firstdate, $lastdate])->sum('total_salary');
    }

    private function countNwnp($firstdate, $lastdate, $basic_salary)
    {
        $total_workdays = $firstdate->diffInDaysFiltered(function(Carbon $date) {
        return $date->isWeekend();
        }, $lastdate);

        $total_presence = Presence::whereBetween('created_at', [$firstdate, $lastdate])->count();

        return ($total_workdays - $total_presence) * $basic_salary / 30;
    }

    private function countInsurance($firstdate, $lastdate, $employee_id)
    {
        return Insurance::whereBetween('created_at', [$firstdate, $lastdate])->sum('total_fee');
    }

    public function index()
    {
        $payroll = Payroll::latest()->get();
        return view('payroll.index', compact('payroll'));
    }

    public function show($id)
    {
        $payroll = $this->checkId($id);
        if (!$payroll) return back();
        
        return view('payroll.show', compact('payroll'));
    }

    public function selectEmployee()
    {
        $employee = Employee::all();
        // TODO: nanti disini kasih input month (isinya first date)
        return view('payroll.selectEmployee', compact('employee'));
    }

    public function create(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            Alert::toast('Data karyawan tidak ditemukan!', 'error');
            return back();
        }

        $firstdate = Carbon::parse($request->firstdate);
        $lastdate = $firstdate->endOfMonth();
        dd($firstdate, $lastdate); // FIXME: check month interval

        $incentive = $this->countIncentive($lastdate, $employee->start_date);
        $overtime = $this->countOvertime($firstdate, $lastdate, $id);
        $nwnp = $this->countNwnp($firstdate, $lastdate, $employee->basic_salary);
        $insurance = $this->countInsurance($firstdate, $lastdate, $id);

        $total_payroll = $employee->basic_salary + $employee->allowance + $incentive + $overtime - $nwnp - $insurance;
        return view('payroll.create', compact('employee', 'lastdate', 'incentive', 'overtime', 'nwnp', 'insurance', 'total_payroll'));
    }

    public function store(Request $request)
    {
        // TODO: isi store
        $validated = WebRequest::validator($request->all(), [
            'employee_id' => ['required', 'integer'],
        ]);
        if (!$validated) return back();

        $employee = Employee::find($request->employee_id);
        if (is_null($employee)) {
            Alert::toast('Data karyawan tidak ditemukan!', 'error');
            return back();
        }
        
        // $total_fee = round($this->countInsurance($employee));

        // Insurance::create([
        //     'employee_id' => $request->employee_id,
        //     'total_fee' => $total_fee,
        // ]);
 
        Alert::toast('Berhasil menambah data BPJS!', 'success');
        return to_route('insurance.index');
    }
    
    public function edit($id)
    {
        $insurance = $this->checkId($id);
        if (!$insurance) return back();

        return view('insurance.edit', compact('insurance'));
    }

    public function update(Request $request, $id)
    {
        $insurance = $this->checkId($id);
        if (!$insurance) return back();

        // $total_fee = $this->countOvertime($insurance->employee());

        // $insurance->update([
        //     'total_fee' => $total_fee,
        // ]);
 
        Alert::toast('Berhasil mengubah data BPJS!', 'success');
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
