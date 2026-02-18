@extends('admin.layout')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h3>Division List</h3>

        <div>
                <!-- Filter button is now a form toggle if you want later, for now we show inline -->
                <a href="{{ route('division.create') }}" class="btn btn-success">
                    Add New Division
                </a>
            </div>
        </div>

       {{-- Filter Option --}}
<div class="row mb-3">
    <div class="col-md-7">
        <form method="GET" action="{{ route('division.filter') }}">
            <div class="d-flex gap-2">
                {{-- Search --}}
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search anything..."
                       value="{{ request('search') }}">
                       
                {{-- Status --}}
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
                {{-- Filter Button --}}
                <button class="btn btn-primary">
                    Filter
                </button>
                {{-- Reset --}}
                <a href="{{ route('division.list') }}"
                   class="btn btn-secondary">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>


        <!-- Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Bangla Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>URL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($divisions as $division)
                    <tr>
                        <td>{{ $division->id }}</td>
                        <td>{{ $division->name }}</td>
                        <td>{{ $division->bn_name }}</td>
                        <td>
                            {{ implode(' ', array_slice(explode(' ', $division->description), 0, 5)) }}
                            @if (str_word_count($division->description) > 5)
                                ...
                            @endif
                        </td>
                        <td>
                            @if ($division->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $division->url }}</td>
                        <td>
                            <a href="{{ route('division.edit', $division->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('division.destroy', $division->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this division?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No divisions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>



    </div>
@endsection
