<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class EmployeeController extends Controller
{   
    // DELETE EMPLOYEE
    public function deleteEmployee(Employee $employee){
        $employee->delete();
        return redirect('/emp');
    }
    //UPDATE EMPLOYEE

    public function updateEmployee(Employee $employee, Request $request) {
        $validatedFields = $request->validate([
            'employee_name' => ['required', 'string', 'min:3', 'max:100'],
            'employee_position' => ['required', 'string', 'min:3', 'max:100'],
            'employee_Email' => ['required', 'email', 'max:100'],
            'employee_ContactNumber' => ['required', 'numeric', 'digits:11'],
            'store_id' => ['required', 'exists:stores,store_id'],
        ], [
            'employee_Email.required' => 'Please enter the employee\'s email address.',
            'employee_ContactNumber.numeric' => 'The contact number must be a numeric value.',
            'employee_ContactNumber.digits' => 'The contact number must be exactly :digits digits.',
            'store_id.required' => 'Please assign a store.',
        ]);
    
        // Retrieve the selected store
        $selectedStore = Store::findOrFail($validatedFields['store_id']);
    
        // Update employee record
        $employee->update([
            'employee_name' => $validatedFields['employee_name'],
            'employee_position' => $validatedFields['employee_position'],
            'employee_Email' => $validatedFields['employee_Email'],
            'employee_ContactNumber' => $validatedFields['employee_ContactNumber'],
            'store_id' => $selectedStore->store_id,
            'store_name' => $selectedStore->store_name,
            ]);
        return redirect('/emp');
    }

        
    // public function updateEmployee(Employee $employee, Request $request){

    //     $validatedFields = $request->validate([
    //         'employee_name' => ['required', 'string', 'min:3', 'max:100'],
    //         'employee_position' => ['required', 'string', 'min:3', 'max:100'],
    //         'employee_Email' => ['required', 'email', 'max:100'],
    //         'employee_ContactNumber' => ['required', 'numeric', 'digits:11'],
    //         'store_id' => ['required', 'exists:stores,store_id'],
    //     ], [
    //         'employee_Email.required' => 'Please enter the employee\'s email address.',
    //         'employee_ContactNumber.numeric' => 'The contact number must be a numeric value.',
    //         'employee_ContactNumber.digits' => 'The contact number must be exactly :digits digits.',
    //         'store_id.required' => 'Please assign a store.',
    //     ]);

    //     // Additional validation and sanitization as needed

    //     // Retrieve the selected store
    //     $selectedStore = Store::findOrFail($validatedFields['store_id']);

    //     // Update employee record
    //     $employee->update([
    //         'employee_name' => $validatedFields['employee_name'],
    //         'employee_position' => $validatedFields['employee_position'],
    //         'employee_Email' => $validatedFields['employee_Email'],
    //         'employee_ContactNumber' => $validatedFields['employee_ContactNumber'],
    //         'store_id' => $selectedStore->store_id,
    //         'store_name' => $selectedStore->store_name,
    //     ]);

    //     return redirect('/emp');
    // }

    // public function updateEmployee(Employee $employee, Request $request){
    //     $incomingFields = $request->validate([
    //         'employee_name' => ['required', 'string', 'min:3', 'max:100'],
    //         'employee_position' => ['required', 'string', 'min:3', 'max:100'],
    //         'employee_Email' => ['required', 'email', 'max:100'],
    //         'employee_ContactNumber' => [
    //             'required',
    //             'numeric',
    //             'digits:11',
    //         ],
    //         'store_id' => ['required', 'exists:stores,store_id'],
    //     ], [
    //         'employee_Email.required' => 'Please enter the employee\'s email address.',
    //         'employee_ContactNumber.numeric' => 'The contact number must be a numeric value.',
    //         'employee_ContactNumber.digits' => 'The contact number must be exactly :digits digits.',
    //         'store_id.required' => 'Please assign a store.',
    //     ]);

    //     $incomingFields['employee_name'] = strip_tags($incomingFields['employee_name']);
    //     $incomingFields['employee_position'] = strip_tags($incomingFields['employee_position']);
    //     $incomingFields['employee_Email'] = strip_tags($incomingFields['employee_Email']);
    //     $incomingFields['employee_ContactNumber'] = strip_tags($incomingFields['employee_ContactNumber']);
    
    //     $employee->update($incomingFields);
    //     return redirect('/emp');
    // }
    //EDIT EMPLOYEE
    public function editFunctionEmp(Employee $employee){
        $stores = Store::all(); // Fetch stores
        return view('edit-employee', ['employee' => $employee, 'stores' => $stores]);
    }
    //REGISTER EMPLOYEE
    public function registerEmp(Request $request)
    {
            $incomingFields = $request->validate([
                'employee_name' => 'required|string|min:3|max:100',
                'employee_position' => 'required|string|min:3|max:100',
                'employee_Email' => 'required|email|max:100',
                'employee_ContactNumber' => [
                    'required',
                    'numeric',
                    'digits:11',
                ],
                'store_id' => 'required|exists:stores,store_id',
            ], [
                'employee_Email.required' => 'Please enter the employee\'s email address.',
                'employee_ContactNumber.max' => 'The contact number must be a maximum of :max digits.',
                'employee_ContactNumber.min' => 'The contact number must be a minimum of :min digits.',
                'store_id.required' => 'Please assign a store.',
            ]);
            

            $store = Store::find($incomingFields['store_id']);
            $incomingFields['store_name'] = $store->store_name;
            
            Employee::create($incomingFields);
            return redirect('/emp');
    }

}
