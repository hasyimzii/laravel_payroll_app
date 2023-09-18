<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\StaffRole;
use App\Http\Middleware\SupervisorRole;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(SupervisorRole::class)->group(function () {
    Route::prefix('payroll')->name('payroll.')->group(function () {
        Route::get('/request', [PayrollController::class, 'request'])->name('request');
        Route::get('/request/{id}/show', [PayrollController::class, 'showRequest'])->name('showRequest');
        Route::post('/request/{id}/update', [PayrollController::class, 'updateRequest'])->name('updateRequest');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/create', [UserController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [UserController::class, 'update'])->name('update');
        Route::get('/{id}/editPassword', [UserController::class, 'editPassword'])->name('editPassword');
        Route::post('/{id}/editPassword', [UserController::class, 'updatePassword'])->name('updatePassword');
    });
});

Route::middleware(StaffRole::class)->group(function () {
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('index');
        Route::get('/{id}/show', [EmployeeController::class, 'show'])->name('show');
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::post('/create', [EmployeeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [EmployeeController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [EmployeeController::class, 'delete'])->name('delete');
    });

    Route::prefix('presence')->name('presence.')->group(function () {
        Route::get('/', [PresenceController::class, 'index'])->name('index');
        Route::get('/create', [PresenceController::class, 'create'])->name('create');
        Route::post('/create', [PresenceController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PresenceController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [PresenceController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [PresenceController::class, 'delete'])->name('delete');
    });

    Route::prefix('overtime')->name('overtime.')->group(function () {
        Route::get('/', [OvertimeController::class, 'index'])->name('index');
        Route::get('/create', [OvertimeController::class, 'create'])->name('create');
        Route::post('/create', [OvertimeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [OvertimeController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [OvertimeController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [OvertimeController::class, 'delete'])->name('delete');
    });

    Route::prefix('insurance')->name('insurance.')->group(function () {
        Route::get('/', [InsuranceController::class, 'index'])->name('index');
        Route::get('/create', [InsuranceController::class, 'create'])->name('create');
        Route::post('/create', [InsuranceController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [InsuranceController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [InsuranceController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [InsuranceController::class, 'delete'])->name('delete');
    });

    Route::prefix('payroll')->name('payroll.')->group(function () {
        Route::get('/', [PayrollController::class, 'index'])->name('index');
        Route::get('/{id}/show', [PayrollController::class, 'show'])->name('show');
        Route::get('/selectEmployee', [PayrollController::class, 'selectEmployee'])->name('selectEmployee');
        Route::get('/{id}/create', [PayrollController::class, 'create'])->name('create');
        Route::post('/{id}/store', [PayrollController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PayrollController::class, 'edit'])->name('edit');
        Route::post('/{id}/update', [PayrollController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [PayrollController::class, 'delete'])->name('delete');
    });

    // TODO: export PDF
});
