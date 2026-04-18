<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeService
{
    protected EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAllEmployees()
    {
        return $this->employeeRepository->all();
    }

    public function registerEmployee(StoreEmployeeRequest $request): Employee
    {
        $validatedData = $request->validated();
        return $this->employeeRepository->create($validatedData);
    }

    public function updateEmployee(Employee $employee, UpdateEmployeeRequest $request): Employee
    {
        $validatedData = $request->validated();
        return $this->employeeRepository->update($employee, $validatedData);
    }

    public function deleteEmployee(Employee $employee): bool
    {
        return $this->employeeRepository->delete($employee);
    }

    public function findById(int $id): ?Employee
    {
        return $this->employeeRepository->findById($id);
    }
}
