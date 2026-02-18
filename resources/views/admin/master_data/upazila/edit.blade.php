@extends('admin.layout')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between mb-3">
            <h3>Edit Upazila</h3>
            <a href="{{ route('upazila.list') }}" class="btn btn-secondary">
                ← Back
            </a>

        </div>

        <div class="mx-auto shadow-lg p-3 mb-5 bg-white rounded" style="max-width: 600px;">

            <form action="{{ route('upazila.update', $upazila->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Upazila Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $upazila->name) }}">
                </div>

                <div class="mb-3">
                    <label>Division</label>
                    <select name="division_id" class="form-control">
                        <option value="">Select Division</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ $upazila->division_id == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>District</label>
                    <select name="district_id" class="form-control">
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}"
                                {{ $upazila->district_id == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $upazila->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $upazila->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $upazila->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>URL</label>
                    <input type="text" name="url" class="form-control" value="{{ old('url', $upazila->url) }}">
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('upazila.list') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>

    </div>
@endsection
