@props(['employees'])

@if($employees->count() > 0)
    <div class="table-responsive">
        <table class="table">
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
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->employee_name }}</td>
                    <td>{{ $employee->employee_position }}</td>
                    <td>{{ $employee->employee_Email }}</td>
                    <td>{{ $employee->employee_ContactNumber }}</td>
                    <td>{{ $employee->store->store_name ?? 'N/A' }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('employees.edit', $employee->employee_id) }}" class="text-primary"><i class="fas fa-edit mr-3"></i></a>
                            <form action="{{ route('employees.destroy', $employee->employee_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?')">
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
@else
    <div class="text-center py-5">
        <i class="fas fa-users fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">No employees found</h4>
        <p class="text-muted">No employees have been registered yet. Start by adding your first employee.</p>
    </div>
@endif
