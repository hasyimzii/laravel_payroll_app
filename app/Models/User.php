<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'name',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function hasRole($role)
    {
        if ($this->role()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
    
    public function role() 
    {
        return $this->belongsTo(Role::class);
    }

    public function payroll() 
    {
        return $this->hasMany(Payroll::class);
    }
}
