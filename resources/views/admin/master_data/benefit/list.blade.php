@extends('admin.layout')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h3> Benefit List</h3>

            <div>
                <!-- Filter button is now a form toggle if you want later, for now we show inline -->
                <a href="{{ route('benefit.create') }}" class="btn btn-success">
                    Add New Benefit
                </a>
            </div>
        </div>

        {{-- Filter Option --}}
        {{-- <div class="row mb-3">
    <div class="col-md-7">
        <form method="GET" action="{{ route('benefit.filter') }}">
            <div class="d-flex gap-2">
                {{-- Search --}}
        {{-- <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search anything..."
                       value="{{ request('search') }}">

                {{-- Status --}}
        {{-- <select name="status" class="form-control">
                    <option value="">All</option>
                    <option value="Active"
                        {{ request('status') == 'Active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="Inactive"
                        {{ request('status') == 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
               </select> --}}
        {{-- Filter Button --}}
        {{-- <button class="btn btn-primary">
                    Filter
                </button> --}}
        {{-- Reset --}}
        {{-- <a href="{{ route('benefits.list') }}"
                   class="btn btn-secondary">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div> --}}


        <!-- Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Bangla Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($benefits as $benefit)
                    <tr>
                        <td>{{ $benefit->id }}</td>
                        <td>{{ $benefit->name }}</td>
                        <td>{{ $benefit->bn_name }}</td>
                        <td>
                            {{ implode(' ', array_slice(explode(' ', $benefit->description), 0, 5)) }}
                            @if (str_word_count($benefit->description) > 5)
                                ...
                            @endif
                        </td>
                        <td>
                            @if ($benefit->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('benefit.edit', $benefit->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('benefit.destroy', $benefit->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this benefit?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty

                    <tr>
                        <td colspan="7" class="text-center">No benefits found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>



    </div>
@endsection
