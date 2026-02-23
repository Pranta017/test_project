@extends('admin.layout')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h4>Edit benefit</h4>

            <a href="{{ route('benefits.list') }}" class="btn btn-secondary">
                ← Back
            </a>
        </div>



        <div class="mx-auto shadow-lg p-4 bg-white rounded" style="max-width: 600px;">
            <form action="{{ route('benefit.update', $benefit->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Benefit Name</label>
                    <input type="text" name="name" value="{{ $benefit->name }}" class="form-control">
                </div>


                <div class="mb-3">
                    <label>Bangla Name</label>
                    <input type="text" name="bn_name" value="{{ $benefit->bn_name }}" class="form-control">
                </div>


                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control">{{ $benefit->description }}</textarea>
                </div>


                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="active" {{ $benefit->status == 'active' ? 'selected' : '' }}>Active</option>

                        <option value="inactive" {{ $benefit->status == 'inactive' ? 'selected' : '' }}>Inactive</option>

                    </select>

                </div>

                 <button type="submit" class="btn btn-success mt-2">Update</button>

            </form>
        </div>

    </div>
@endsection
