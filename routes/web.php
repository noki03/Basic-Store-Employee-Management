<?php

use App\Models\Store;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Services\EmployeeService;
use App\Services\StoreService;

Route::get('/', function () {
    $storeService = app(StoreService::class);
    $stores = $storeService->getAllStores();
    return view('home', ['stores' => $stores]);
})->name('stores.index');

Route::get('/emp', function () {
    $stores = Store::all();
    $employeeService = app(EmployeeService::class);
    $employees = $employeeService->getAllEmployees();

    return view('empManagement', [
        'stores' => $stores,
        'employees' => $employees,
    ]);
})->name('employees.index');

// STORE
Route::post('/register', [UserController::class, 'register'])->name('stores.store');
Route::get('/edit-store/{store}', [UserController::class, 'editFunction'])->name('stores.edit');
Route::put('/edit-store/{store}', [UserController::class, 'updateStore'])->name('stores.update');
Route::delete('/delete-store/{store}', [UserController::class, 'deleteStore'])->name('stores.destroy');
// EMPLOYEE
Route::post('/registerEmp', [EmployeeController::class, 'registerEmp'])->name('employees.store');
Route::get('/edit-employee/{employee}', [EmployeeController::class, 'editFunctionEmp'])->name('employees.edit');
Route::put('/edit-employee/{employee}', [EmployeeController::class, 'updateEmployee'])->name('employees.update');
Route::delete('/delete-employee/{employee}', [EmployeeController::class, 'deleteEmployee'])->name('employees.destroy');



