@extends('admin.layout')

@section('title', 'Beneficiary')

@section('content')

    <div class="row mb-1">
        <div class="col">
            <h2 class="fw-bold">Beneficiary</h2>

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
                <input type="file" name="file" class="form-control" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Import Excel</button>
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
                            <td style="word-wrap: break-word; white-space: normal;">{{ $b->division }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $b->district }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $b->upazila }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $b->union }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $b->gender }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $b->father }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $b->mother }}</td>
                            <td>
                                <a href="{{ route('beneficiaries.edit', $b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('beneficiaries.destroy', $b->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Delete this record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>


@endsection
