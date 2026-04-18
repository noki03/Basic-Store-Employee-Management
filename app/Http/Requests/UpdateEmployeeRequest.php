<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_name' => 'required|string|max:255',
            'employee_position' => 'required|string|max:255',
            'employee_Email' => 'required|email|unique:employees,employee_Email,' . $this->route('employee'),
            'employee_ContactNumber' => 'required|numeric|digits:11',
            'store_id' => 'required|exists:stores,store_id',
        ];
    }
}
