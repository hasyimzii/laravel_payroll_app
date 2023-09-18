<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'user_id',
        'basic_salary',
        'allowance',
        'incentive',
        'overtime',
        'nwnp',
        'insurance',
        'status',
        'payroll_date',
    ];

    public function totalPayroll()
    {
        $total_payroll = $this->employee->basic_salary + $this->employee->allowance + $this->incentive + $this->overtime - $this->nwnp - $this->insurance;
        return $total_payroll;
    }

    public function employee() 
    {
        return $this->belongsTo(Employee::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
