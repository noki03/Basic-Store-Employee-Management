@extends('layouts.app')

@section('content')
<div class="container">
    <div id="employeeManagement">
        <h1>Edit Employee</h1>
        {{-- ERROR MESSAGE --}}
        @if(session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if(session('error'))
            <x-alert type="danger" :message="session('error')" />
        @endif
        <form action="{{ route('employees.update', $employee->employee_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="employeeName">Employee Name</label>
                <input type="text" class="form-control @error('employee_name') is-invalid @enderror" id="employeeName" name="employee_name" value="{{ old('employee_name', $employee->employee_name) }}">

                @error('employee_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="employeePosition">Employee Position</label>
                <input type="text" class="form-control @error('employee_position') is-invalid @enderror" id="employeePosition" name="employee_position" value="{{ old('employee_position', $employee->employee_position) }}">
                @error('employee_position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="employeeEmail">Employee Email</label>
                        <input type="text" class="form-control @error('employee_Email') is-invalid @enderror" id="employeeEmail" name="employee_Email" value="{{ old('employee_Email', $employee->employee_Email) }}">
                        @error('employee_Email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="employeeContactNumber">Employee Contact Number</label>
                        <input type="tel" class="form-control @error('employee_ContactNumber') is-invalid @enderror" id="employeeContactNumber" name="employee_ContactNumber" placeholder="Enter Employee Contact Number (09XXXXXXXXX)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('employee_ContactNumber', $employee->employee_ContactNumber) }}" minlength="11" maxlength="11">
                        @error('employee_ContactNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            @if($errors->has('employee_ContactNumber_length'))
                                <div class="invalid-feedback">{{ $errors->first('employee_ContactNumber_length') }}</div>
                            @endif
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
                        <option value="{{ $store->store_id }}" @if(old('store_id', $employee->store_id) == $store->store_id) selected @endif>
                            {{ $store->store_name }}
                        </option>
                    @endforeach
                </select>
                @error('store_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>             
    </div>
</div>
@endsection
