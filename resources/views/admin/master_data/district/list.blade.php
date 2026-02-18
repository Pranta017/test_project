@extends('admin.layout')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between mb-3">
            <h3>District List</h3>
            <div>
                <!-- Filter button is now a form toggle if you want later, for now we show inline -->
                <a href="{{ route('district.create') }}" class="btn btn-primary mb-2">Add New District</a>
            </div>
        </div>


            {{-- Filter --}}
<form method="GET" action="{{ route('district.filter') }} " class="mb-3 col-md-6" >

    <div class="d-flex gap-1">

        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search anything..."
               value="{{ request('search') }}">

        <select name="status" class="form-control">

            <option value="">All</option>

            <option value="Active">Active</option>

            <option value="Inactive">Inactive</option>

        </select>

        <button class="btn btn-primary">Filter</button>

        <a href="{{ route('district.list') }}"
           class="btn btn-secondary">Reset</a>

    </div>

</form>




        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>District Name</th>
                    <th>Division</th>
                    <th>Bangla Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($districts as $district)
                    <tr>
                        <td>{{ $district->id }}</td>
                        <td>{{ $district->name }}</td>
                        <td>{{ $district->bn_name }}</td>
                        <td>{{ $district->division->name ?? '-' }}</td>
                        <td>{{ $district->description }}</td>
                        <td>
                            @if ($district->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $district->url }}</td>
                        <td>
                            <a href="{{ route('district.edit', $district->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('district.delete', $district->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection

