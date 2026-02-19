@extends('admin.layout')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between mb-3">
            <h3>Upazila List</h3>
            <div>
                <a href="{{ route('upazilas.create') }}" class="btn btn-primary mb-2">Add New Upazila</a>
            </div>
        </div>
    </div>

        {{-- Filter --}}
<div class="row mb-3">
    <div class="col-md-7">
        <form method="GET" action="{{ route('upazila.index') }}">
            <div class="d-flex gap-1">

                {{-- Search box --}}
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search anything..."
                       value="{{ request('search') }}">

                {{-- Status filter --}}
                <select name="status" class="form-control">
                    <option value="">All</option>

                    <option value="Active"
                        {{ request('status') == 'Active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="Inactive"
                        {{ request('status') == 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>

                {{-- Filter button --}}
                <button class="btn btn-primary">
                    Filter
                </button>

                {{-- Reset --}}
                <a href="{{ route('upazila.index') }}"
                   class="btn btn-secondary">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Table Part --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Upazila Name</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($upazilas as $upazila)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $upazila->name }}</td>
                        <td>{{ $upazila->division->name ?? '-' }}</td>
                        <td>{{ $upazila->district->name ?? '-' }}</td>
                       <td>
                            {{ implode(' ', array_slice(explode(' ', $upazila->description), 0, 5)) }}
                            @if (str_word_count($upazila->description) > 5)
                                ...
                            @endif
                        </td>
                        <td>
                            @if ($upazila->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if ($upazila->url)
                                <a href="{{ $upazila->url }}" target="_blank">{{ $upazila->url }}</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('upazila.edit', $upazila->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('upazila.destroy', $upazila->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Upazilas found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
@endsection
