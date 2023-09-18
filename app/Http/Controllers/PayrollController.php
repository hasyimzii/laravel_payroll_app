<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Insurance;
use App\Models\Overtime;
use App\Models\Payroll;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

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
        return Overtime::whereBetween('created_at', [$firstdate, $lastdate])->where('employee_id', $employee_id)->sum('total_salary');
    }

    private function countNwnp($firstdate, $lastdate, $employee)
    {
        $total_workdays = $firstdate->diffInDaysFiltered(function(Carbon $date) {
            return $date->isWeekday();
        }, $lastdate);

        $total_presence = Presence::whereBetween('created_at', [$firstdate, $lastdate])->where('employee_id', $employee->id)->count();

        return round(($total_workdays - $total_presence) * $employee->basic_salary / 30);
    }

    private function countInsurance($firstdate, $lastdate, $employee_id)
    {
        return Insurance::whereBetween('created_at', [$firstdate, $lastdate])->where('employee_id', $employee_id)->sum('total_fee');
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

        $month = [];
        for ($m = 1; $m <= 12; $m++) {
            $month[$m - 1]['date'] = date('Y-m-d H:i:s', mktime(0,0,0,$m, 1, date('Y')));
            $month[$m - 1]['name'] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        return view('payroll.selectEmployee', compact('employee', 'month'));
    }

    public function create(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (is_null($employee)) {
            Alert::toast('Data karyawan tidak ditemukan!', 'error');
            return back();
        }

        $firstdate = Carbon::parse($request->firstdate);
        $lastdate = Carbon::parse($request->firstdate)->endOfMonth();

        $incentive = $this->countIncentive($lastdate, $employee->start_date);
        $overtime = $this->countOvertime($firstdate, $lastdate, $id);
        $nwnp = $this->countNwnp($firstdate, $lastdate, $employee);
        $insurance = $this->countInsurance($firstdate, $lastdate, $id);

        $total_payroll = $employee->basic_salary + $employee->allowance + $incentive + $overtime - $nwnp - $insurance;
        return view('payroll.create', compact('employee', 'lastdate', 'incentive', 'overtime', 'nwnp', 'insurance', 'total_payroll'));
    }

    public function store(Request $request)
    {
        $validated = WebRequest::validator($request->all(), [
            'employee_id' => ['required', 'integer'],
            'basic_salary' => ['required', 'integer'],
            'allowance' => ['required', 'integer'],
            'incentive' => ['required', 'integer'],
            'overtime' => ['required', 'integer'],
            'nwnp' => ['required', 'integer'],
            'insurance' => ['required', 'integer'],
            'payroll_date' => ['required', 'date'],
        ]);
        if (!$validated) return back();

        Payroll::create([
            'employee_id' => $request->employee_id,
            'user_id' => Auth::user()->id,
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'incentive' => $request->incentive,
            'overtime' => $request->overtime,
            'nwnp' => $request->nwnp,
            'insurance' => $request->insurance,
            'status' => 'draft',
            'payroll_date' => $request->payroll_date,
        ]);
 
        Alert::toast('Berhasil menambah data payroll!', 'success');
        return to_route('payroll.index');
    }

    public function printPdf($id)
    {
        $payroll = $this->checkId($id);
        if (!$payroll) return back();
        
        $pdf = Pdf::loadview('payroll.printPdf', ['payroll' => $payroll]);
	    return $pdf->stream();
	    // return $pdf->download('laporan-payroll.pdf');
    }

    public function request()
    {
        $payroll = Payroll::latest()->get();
        return view('payroll.request', compact('struk-payroll'));
    }

    public function showRequest($id)
    {
        $payroll = $this->checkId($id);
        if (!$payroll) return back();
        
        return view('payroll.showRequest', compact('payroll'));
    }

    public function updateRequest($id)
    {
        $payroll = $this->checkId($id);
        if (!$payroll) return back();

        $payroll->update([
            'status' => ($payroll->status == 'draft') ? 'approved' : 'draft',
        ]);
        
        Alert::toast('Berhasil mengubah data payroll!', 'success');
        return back();
    }
}
