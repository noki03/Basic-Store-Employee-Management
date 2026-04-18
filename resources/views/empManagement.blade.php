@extends('layouts.app')

@section('content')
<div class="container">
    <div id="employeeManagement">
        <h1>Register Employee</h1>
        <!-- Add new employee form -->
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="employeeName">Employee Name</label>
                <input type="text" class="form-control @error('employee_name') is-invalid @enderror" id="employeeName" name="employee_name" placeholder="Enter Employee Name" value="{{ old('employee_name') }}">
                @error('employee_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="employeePosition">Employee Position</label>
                <input type="text" class="form-control @error('employee_position') is-invalid @enderror" id="employeePosition" name="employee_position" placeholder="Enter Employee Position" value="{{ old('employee_position') }}">
                @error('employee_position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="employeeEmail">Employee Email</label>
                        <input type="text" class="form-control @error('employee_Email') is-invalid @enderror" id="employeeEmail" name="employee_Email" placeholder="Enter Employee Email (sample@email.com)" value="{{ old('employee_Email') }}">
                        @error('employee_Email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="employeeContactNumber">Employee Contact Number</label>
                        <input type="tel" class="form-control @error('employee_ContactNumber') is-invalid @enderror" id="employeeContactNumber" name="employee_ContactNumber" placeholder="Enter Employee Contact Number (09XXXXXXXXX)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('employee_ContactNumber') }}" minlength="11" maxlength="11">
                        @error('employee_ContactNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        <!-- Assign to Store dropdown -->
            <div class="form-group">
                <label for="employeeStore">Assign to Store</label>
                <select class="form-control @error('store_id') is-invalid @enderror" id="employeeStore" name="store_id">
                    <option value="">Select a store</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->store_id }}" {{ old('store_id') == $store->store_id ? 'selected' : '' }}>
                            {{ $store->store_name }}
                        </option>
                    @endforeach
                </select>
                @error('store_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Register Employee</button>
        </form>
        <br>
        <!-- Search Form for Employees -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="employeeSearch" onkeyup="searchEmployee()"
                placeholder="Search by employee name">
            <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
        </div>

        <!-- List all employees -->
        <h2>List of Employees</h2>
        <x-employee-list :employees="$employees" />
    </div>
@endsection

<script>
    function searchEmployee() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("employeeSearch");
        filter = input.value.toUpperCase();
        table = document.querySelector("#employeeTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Adjust index based on your table structure
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
