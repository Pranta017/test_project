@extends('admin.layout')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between mb-3">
            <h4>Add New Upazila</h4>
            <a href="{{ route('upazila.list') }}" class="btn btn-secondary">
                ← Back
            </a>

        </div>

        <div class="mx-auto shadow-lg p-3 mb-5 bg-white rounded" style="max-width: 600px;">

            <form action="{{ route('upazilas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Upazila Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label>Division</label>
                    <select name="division_id" id="division" class="form-control">
                        <option value="">Select Division</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>District</label>
                    <select name="district_id" id="district" class="form-control">
                        <option value="">Select District</option>
                        {{-- @foreach ($districts as $district)
                        <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                            {{ $district->name }}</option>
                    @endforeach --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>URL</label>
                    <input type="text" name="url" class="form-control" value="{{ old('url') }}">
                </div>

                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('upazila.list') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
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
