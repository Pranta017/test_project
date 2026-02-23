@extends('admin.layout')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h3>Add New Benefit</h3>
            <a href="{{ route('benefits.list') }}" class="btn btn-secondary">
                ← Back
            </a>
        </div>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="mx-auto shadow-lg p-3 mb-5 bg-white rounded" style="max-width: 600px;">
            <form action="{{ route('benefit.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Benefit Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Bangla Name</label>
                    <input type="text" name="bn_name" class="form-control">
                </div>

                  <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button class="btn btn-success">Add Benefit</button>
            </form>
        </div>
    </div>
@endsection
