@props(['stores'])

@if($stores->count() > 0)
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Store Name</th>
                    <th scope="col">Location</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Employee Count</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $store)
                <tr>
                    <td>{{ $store->store_id }}</td>
                    <td>{{ $store->store_name }}</td>
                    <td>{{ $store->store_location }}</td>
                    <td>{{ $store->store_Email }}</td>
                    <td>{{ $store->store_ContactNumber }}</td>
                    <td>{{ $store->employees_count }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('stores.edit', $store->store_id) }}" class="text-primary"><i class="fas fa-edit mr-3"></i></a>
                            <form action="{{ route('stores.destroy', $store->store_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this store?')">
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
        <i class="fas fa-store fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">No stores found</h4>
        <p class="text-muted">Start by adding your first store to manage your business locations.</p>
    </div>
@endif
