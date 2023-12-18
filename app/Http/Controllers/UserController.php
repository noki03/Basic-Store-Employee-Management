<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class UserController extends Controller
{
    

    public function deleteStore(Store $store)
    {
        $store->delete();
        return redirect('/');
    }

    public function updateStore(Store $store, Request $request)
    {
        $validatedFields = $request->validate([
            'store_name' => ['required', 'string', 'min:3', 'max:100'],
            'store_location' => ['required', 'string', 'min:3', 'max:100'],
            'store_Email' => ['required', 'email', 'max:100'],
            'store_ContactNumber' => ['required', 'numeric', 'digits:11'],
        ], [
            'store_Email.required' => 'Please enter the store\'s email address.',
            'store_ContactNumber.numeric' => 'The contact number must be a numeric value.',
            'store_ContactNumber.digits' => 'The contact number must be exactly :digits digits.',
        ]);
    
        // Update store details
        $store->update($validatedFields);
    
        // Update associated employee details
        foreach ($store->employees as $employee) {
            $employee->update([
                'store_name' => $validatedFields['store_name'],
                // Update other store-related fields if needed
            ]);
        }
    
        return redirect('/');
    }    

    public function editFunction(Store $store)
    {
        return view('edit-store', ['store' => $store]);
    }

    public function register(Request $request)
    {

        $incomingFields = $request->validate([
            'store_name' => ['required', 'string', 'min:3', 'max:100'],
            'store_location' => ['required', 'string', 'min:3', 'max:100'],
            'store_Email' => ['required', 'email', 'max:100'],
            'store_ContactNumber' => ['required', 'numeric', 'digits:11'],
        ], [
            'store_Email.required' => 'Please enter the store\'s email address.',
            'store_ContactNumber.numeric' => 'The contact number must be a numeric value.',
            'store_ContactNumber.digits' => 'The contact number must be exactly :digits digits.',
        ]);

        Store::create($incomingFields);
        return redirect('/');
    }
}
