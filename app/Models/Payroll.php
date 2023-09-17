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

    public function employee() 
    {
        return $this->belongsTo(Employee::class);
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
