@extends('admin.layout')

@section('content')
    <div class="container">

         <div class="d-flex justify-content-between mb-3">
            <h3>Edit Division</h3>
            <a href="{{ route('division.list') }}" class="btn btn-secondary">
                ← Back
            </a>
        </div>



        <div class="mx-auto shadow-lg p-4 bg-white rounded" style="max-width: 600px;">
            <form action="{{ route('division.update', $division->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Division Name</label>
                    <input type="text" name="name" value="{{ $division->name }}" class="form-control">
                </div>


                <div class="mb-3">
                    <label>Bangla Name</label>
                    <input type="text" name="bn_name" value="{{ $division->bn_name }}" class="form-control">
                </div>


                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="active" {{ $division->status == 'active' ? 'selected' : '' }}>Active</option>

                        <option value="inactive" {{ $division->status == 'inactive' ? 'selected' : '' }}>Inactive</option>

                    </select>

                </div>


                <div class="mb-3">
                    <label>URL</label>
                    <input type="text" name="url" value="{{ $division->url }}" class="form-control">
                </div>


                <button class="btn btn-success">Update</button>

            </form>
        </div>

    </div>
@endsection
