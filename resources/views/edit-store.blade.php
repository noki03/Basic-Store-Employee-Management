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
                <li class="nav-item {{ Request::is('emp*') ? 'active' : '' }}">
                    <a class="nav-link" href="/emp">Employee</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <!-- Store management content -->
        <div id="storeManagement">
            {{-- ERROR MESSAGE 
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <h1>Edit Store</h1>
            <form action="/edit-store/{{$store['store_id']}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="storeName">Store Name</label>
                    <input type="text" class="form-control @error('store_name') is-invalid @enderror" id="storeName" name="store_name"
                        value="{{ old('store_name', $store->store_name) }}">
                    @error('store_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="storeLocation">Store Location</label>
                    <input type="text" class="form-control @error('store_location') is-invalid @enderror" id="storeLocation" name="store_location"
                        value="{{ old('store_location', $store->store_location) }}">
                    @error('store_location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="storeEmail">Store Email</label>
                            <input type="text" class="form-control @error('store_Email') is-invalid @enderror" id="storeEmail" name="store_Email"
                                value="{{ old('store_Email', $store->store_Email) }}">
                            @error('store_Email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="storeContactNumber">Store Contact Number</label>
                            <input type="tel" class="form-control @error('store_ContactNumber') is-invalid @enderror" id="storeContactNumber" name="store_ContactNumber" placeholder="Enter Store Contact Number (09XXXXXXXXX)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('store_ContactNumber', $store->store_ContactNumber) }}" minlength="11" maxlength="11">
                            @error('store_ContactNumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                @if($errors->has('store_ContactNumber_length'))
                                    <div class="invalid-feedback">{{ $errors->first('store_ContactNumber_length') }}</div>
                                @endif
                            @enderror
                        </div>
                        
                    </div>
                </div>
                <button class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
