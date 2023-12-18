<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store and Employee Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Store & Employee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Store</a>
                </li>
                <li class="nav-item {{ Request::is('emp') ? 'active' : '' }}">
                    <a class="nav-link" href="/emp">Employee</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div id="employeeManagement">
            <h1>Edit Employee</h1>
            {{-- ERROR MESSAGE --}}
            <form action="/edit-employee/{{$employee['employee_id']}}" method="POST">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
