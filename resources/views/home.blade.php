@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Store Management Section -->
    <div id="storeManagement">
        <form action="{{ route('stores.store') }}" method="POST">
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
                <label for="storeEmail">Store Email</label>
                <input type="text" class="form-control @error('store_Email') is-invalid @enderror" id="storeEmail"
                    name="store_Email" placeholder="Enter Store Email (sample@email.com)" value="{{ old('store_Email') }}">
                @error('store_Email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="storeContactNumber">Store Contact Number</label>
                        <input type="tel" class="form-control @error('store_ContactNumber') is-invalid @enderror" id="storeContactNumber" name="store_ContactNumber" placeholder="Enter Store Contact Number (09XXXXXXXXX)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('store_ContactNumber') }}" minlength="11" maxlength="11">
                        @error('store_ContactNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Register Store</button>
        </form>
        <br>
        <!-- List all stores -->
        <h2>List of Stores</h2>
        <x-store-list :stores="$stores" />
    </div>
@endsection

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
