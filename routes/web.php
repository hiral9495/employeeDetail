<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

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
Route::get('/', [EmployeeController::class, 'show'])->name('employees.table');
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/generate-code', [EmployeeController::class, 'generateCode'])->name('employees.generateCode'); 
Route::get('/employees/data', [EmployeeController::class, 'getEmployees'])->name('employees.data');