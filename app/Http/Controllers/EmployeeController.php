<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Store;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{   
    // DELETE EMPLOYEE
    public function deleteEmployee(Employee $employee){
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }
    //UPDATE EMPLOYEE

    public function updateEmployee(Employee $employee, UpdateEmployeeRequest $request) {
        $validatedFields = $request->validated();
    
        // Update employee record
        $employee->update([
            'employee_name' => $validatedFields['employee_name'],
            'employee_position' => $validatedFields['employee_position'],
            'employee_Email' => $validatedFields['employee_Email'],
            'employee_ContactNumber' => $validatedFields['employee_ContactNumber'],
            'store_id' => $validatedFields['store_id'],
            ]);
        return redirect('/emp');
    }

    //EDIT EMPLOYEE
    public function editFunctionEmp(Employee $employee){
        $stores = Store::all(); // Fetch stores
        return view('edit-employee', ['employee' => $employee, 'stores' => $stores]);
    }
    //REGISTER EMPLOYEE
    public function registerEmp(StoreEmployeeRequest $request)
    {
            $validatedFields = $request->validated();
            
            Employee::create($validatedFields);
            return redirect()->route('employees.index')->with('success', 'Employee registered successfully!');
    }

}
