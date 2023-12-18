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
        <!-- Store Management Section -->
        <div id="storeManagement">
            <form action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="storeName">Store Name</label>
                    <input type="text" class="form-control @error('store_name') is-invalid @enderror" id="storeName"
                        name="store_name" placeholder="Enter Store name" value="{{ old('store_name') }}">
                    @error('store_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="storeLocation">Store Location</label>
                    <input type="text" class="form-control @error('store_location') is-invalid @enderror"
                        id="storeLocation" name="store_location" placeholder="Enter Store location"
                        value="{{ old('store_location') }}">
                    @error('store_location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="storeEmail">Store Email</label>
                            <input type="text" class="form-control @error('store_Email') is-invalid @enderror"
                                id="storeEmail" name="store_Email" placeholder="Enter Store Email"
                                value="{{ old('store_Email') }}">
                            @error('store_Email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="storeContactNumber">Store Contact Number</label>
                            <input type="tel" class="form-control @error('store_ContactNumber') is-invalid @enderror" id="storeContactNumber" name="store_ContactNumber" placeholder="Enter Store Contact Number (09XXXXXXXXX)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('store_ContactNumber') }}" minlength="11" maxlength="11">
                            @error('store_ContactNumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Store</button>
            </form>

            <!-- Search Form -->
            <br>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                    placeholder="Search by store name">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>

            <!-- List all existing stores -->
            <h2>List of Stores</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID_Number</th>
                            <th scope="col">Store Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $store)
                        <tr>
                            <td>{{$store['store_id']}}</td>
                            <td>{{$store['store_name']}}</td>
                            <td>{{$store['store_location']}}</td>
                            <td>{{$store['store_Email']}}</td>
                            <td>{{$store['store_ContactNumber']}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/edit-store/{{$store['store_id']}}" class="text-primary"><i
                                            class="fas fa-edit mr-3"></i></a>
                                    <form action="/delete-store/{{$store['store_id']}}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this store?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-link text-danger p-0 m-0 text-center"><i
                                                class="fas fa-trash"></i></button>
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
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.querySelector(".table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; 
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
