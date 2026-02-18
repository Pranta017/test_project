@extends('admin.layout')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h3>Edit District</h3>
            <a href="{{ route('district.list') }}" class="btn btn-secondary">
                ← Back
            </a>
        </div>


        <div class="mx-auto shadow-lg p-3 mb-5 bg-white rounded" style="max-width: 600px;">

        <form action="{{ route('district.update', $district->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>District Name</label>
                <input type="text" name="name" class="form-control" value="{{ $district->name }}" required>
            </div>

            <div class="form-group">
                <label>Bangla Name</label>
                <input type="text" name="bn_name" class="form-control" value="{{ $district->bn_name }}">
            </div>

            <div class="form-group">
                <label>Division</label>
                <select name="division_id" class="form-control" required>
                    <option value="">Select Division</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" @if ($district->division_id == $division->id) selected @endif>
                            {{ $division->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ $district->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="active" @if ($district->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if ($district->status == 'inactive') selected @endif>Inactive</option>
                </select>
            </div>

            <div class="form-group">
                <label>URL</label>
                <input type="text" name="url" class="form-control" value="{{ $district->url }}">
            </div>

            <button type="submit" class="btn btn-success mt-2">Update</button>
        </form>
        </div>
    </div>

    @endsection
