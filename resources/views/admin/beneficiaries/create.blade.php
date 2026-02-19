@extends('admin.layout') <!-- main layout use korbe -->

@section('title', 'Add New Beneficiary') <!-- page title -->

@section('content')
    {{-- <x-app-layout> --}}
    <div class="d-flex justify-content-between mb-3">
        <h4>Add New Beneficiary</h4>
        <a href="{{ route('beneficiaries.index') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add New Beneficiary
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('beneficiaries.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">NID</label>
                                    <input type="text" name="nid" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>

                                <div class="row">

                                    <div class="mb-3">
                                        <label>Division</label>
                                        <select name="division_id" id="division" class="form-control">
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                                    {{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label>District</label>
                                        <select name="district_id" id="district" class="form-control">
                                            <option value="">Select District</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3">
                                        <label>Upazila</label>
                                        <select name="upazila_id" id="upazila" class="form-control">
                                            <option value="">Select Upazila</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Union</label>
                                        <input type="text" name="union" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Gender</label>
                                        <input type="text" name="gender" class="form-control">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Father</label>
                                        <input type="text" name="father" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mother</label>
                                    <input type="text" name="mother" class="form-control">
                                </div>

                                <button type="submit" class="btn btn-success">Add Beneficiary</button>
                                <a href="{{ route('beneficiaries.index') }}" class="btn btn-secondary">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- </x-app-layout> --}}

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /* Division → District */


        $('#division').change(function() {
            var division_id = $(this).val();
            if (division_id) {
                $('#district').html('<option>Loading...</option>');
                $.ajax({
                    url: "{{ url('master-data/get-districts') }}/" + division_id,
                    type: "GET",
                    success: function(data) {
                        $('#district').empty();
                        $('#district').append('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                        $('#upazila').html('<option value="">Select Upazila</option>');
                    }
                });
            }
        });


        /* District → Upazila */

        $('#district').change(function() {
            var district_id = $(this).val();
            if (district_id) {
                $('#upazila').html('<option>Loading...</option>');
                $.ajax({
                    url: "{{ url('master-data/get-upazilas') }}/" + district_id,
                    type: "GET",
                    success: function(data) {
                        $('#upazila').empty();
                        $('#upazila').append('<option value="">Select Upazila</option>');
                        $.each(data, function(key, value) {
                            $('#upazila').append('<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    }
                });
            }
        });

              //Upazila

        $('#district').change(function() {
            var district_id = $(this).val();
            if (district_id) {
                $('#upazila').html('<option>Loading...</option>');
                $.ajax({
                    url: "{{ url('get-upazilas') }}/" + district_id,
                    type: "GET",
                    success: function(data) {
                        $('#upazila').empty();
                        $('#upazila').append('<option value="">Select Upazila</option>');
                        $.each(data, function(key, value) {
                            $('#upazila').append('<option value="' + value.id + '">' + value
                                .name + '</option>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
