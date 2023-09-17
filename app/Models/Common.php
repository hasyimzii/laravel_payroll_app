<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    use HasFactory;

    protected $fillable = [
        'incentive',
        'overtime',
        'nwnp',
        'insurance',
    ];

    public $timestamps = false;
}
