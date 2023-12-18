<?php

use App\Models\Store;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    $stores = Store::all();
    return view('home', ['stores' => $stores]);
});

Route::get('/emp', function () {
    $stores = Store::all();
    $employees = Employee::all();

    return view('empManagement', [
        'stores' => $stores,
        'employees' => $employees,
    ]);
});

// STORE
Route::post('/register', [UserController::class, 'register']);
Route::get('/edit-store/{store}', [UserController::class, 'editFunction']);
Route::put('/edit-store/{store}', [UserController::class, 'updateStore']);
Route::delete('/delete-store/{store}', [UserController::class, 'deleteStore']);
// EMPLOYEE
Route::post('/registerEmp', [EmployeeController::class, 'registerEmp']);
Route::get('/edit-employee/{employee}', [EmployeeController::class, 'editFunctionEmp']);
Route::put('/edit-employee/{employee}', [EmployeeController::class, 'updateEmployee']);
Route::delete('/delete-employee/{employee}', [EmployeeController::class, 'deleteEmployee']);



