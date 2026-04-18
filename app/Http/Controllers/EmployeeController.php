<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Store;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{   
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    // DELETE EMPLOYEE
    public function deleteEmployee(Employee $employee){
        $this->employeeService->deleteEmployee($employee);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
    //UPDATE EMPLOYEE

    public function updateEmployee(Employee $employee, UpdateEmployeeRequest $request) {
        $this->employeeService->updateEmployee($employee, $request);
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully!');
    }

    //EDIT EMPLOYEE
    public function editFunctionEmp(Employee $employee){
        $stores = Store::all(); // Fetch stores
        return view('edit-employee', ['employee' => $employee, 'stores' => $stores]);
    }
    //REGISTER EMPLOYEE
    public function registerEmp(StoreEmployeeRequest $request)
    {
            $this->employeeService->registerEmployee($request);
            return redirect()->route('employees.index')->with('success', 'Employee registered successfully!');
    }

}
