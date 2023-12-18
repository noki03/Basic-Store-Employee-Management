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
            <h1>Register Employee</h1>
            <!-- Add new employee form -->
            <form action="/registerEmp" method="POST">
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
            <div class="table-responsive">
                <table class="table" id="employeeTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Store</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee['employee_id']}}</td>
                            <td>{{ $employee['employee_name'] }}</td>
                            <td>{{ $employee['employee_position'] }}</td>
                            <td>{{ $employee['employee_Email'] }}</td>
                            <td>{{ $employee['employee_ContactNumber'] }}</td>
                            <td>{{ $employee['store_name'] }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/edit-employee/{{$employee['employee_id']}}" class="text-primary"><i class="fas fa-edit mr-3"></i></a>
                                    <form action="/delete-employee/{{ $employee->employee_id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 m-0 text-center"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>            
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
</body>
</html>
