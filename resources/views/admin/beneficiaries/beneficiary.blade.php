@extends('admin.layout')

@section('title', 'Beneficiary')

@section('content')

    <div class="row mb-1">
        <div class="col">
            <h3 class="fw-bold">Beneficiary</h3>

        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Excel Upload Form --}}
    <form action="{{ route('beneficiaries.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="file" disabled name="file" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button disabled class="btn btn-primary">Import Excel</button>
            </div>
        </div>
    </form>

    {{-- Filter Form  --}}

    {{-- Search Form --}}
    <form method="GET" action="{{ route('beneficiaries.index') }}">

        <div class="row mb-3">

            <div class="col-md-4">

                <input type="text" name="search" class="form-control" placeholder="Search here..."
                    value="{{ request('search') }}">

            </div>

            <div class="col-md-2">

                <button type="submit" class="btn btn-primary">

                    Search

                </button>

                <a href="{{ route('beneficiaries.index') }}" class="btn btn-secondary">

                    Reset

                </a>

            </div>

        </div>

    </form>



    <!-- New Add button -->
    <div class="d-flex justify-content-end mb-4" style="margin-top: -60px;">
        <a href="{{ route('beneficiaries.create') }}" class="btn btn-success">
            + Add New Beneficiary
        </a>
    </div>
    </div>
    <!-- Scrollable Table Card -->
    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="mb-3">Beneficiary Table</h5>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" style="width:100%; table-layout:auto;">
                    <thead class="table-dark">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>NID</th>
                            <th>Phone</th>
                            <th>Division</th>
                            <th>District</th>
                            <th>Upazila</th>
                            <th>Union</th>
                            <th>Gender</th>
                            <th>Father</th>
                            <th>Mother</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($beneficiaries as $b)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->name }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->nid }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->phone }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->division->name }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->district->name }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->upazila->name }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->union }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->gender }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->father }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $b->mother }}</td>

                                {{-- Edit, Details & delete buttton --}}
                                <td>
                                    <a href="{{ route('beneficiaries.edit', $b->id) }}"
                                        class="btn btn-sm btn-warning" style="padding:2px 6px; font-size:12px;">Edit</a>

                                    <a href="{{ route('beneficiaries.show', $b->id) }}" class="btn btn-info btn-sm" style="padding:2px 6px; font-size:12px;">
                                        Details
                                    </a>

                                    <form action="{{ route('beneficiaries.destroy', $b->id) }}" method="POST"
                                        style="display:inline-block" onsubmit="return confirm('Delete this record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" style="padding:2px 6px; font-size:12px;">Delete</button>
                                    </form>
                                </>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


@endsection
