<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_place',
        'birth_date',
        'gender',
        'position',
        'status',
        'basic_salary',
        'allowance',
        'start_date',
    ];

    public $timestamps = false;

    public function presence() {
        return $this->hasMany(Presence::class);
    }

    public function overtime() {
        return $this->hasMany(Overtime::class);
    }

    public function insurance() {
        return $this->hasMany(Insurance::class);
    }

    public function payroll() {
        return $this->hasMany(Payroll::class);
    }
}
