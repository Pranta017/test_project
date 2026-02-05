<!DOCTYPE html>
<html>
<head>
    <title>Beneficiaries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5">
    <div class="container">
        <h2>Beneficiaries</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Excel Import Form -->
        <form action="{{ route('beneficiaries.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Import Excel</button>
                </div>
            </div>
        </form>

        <!-- Display Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>NID</th>
                    <th>Address</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Union</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beneficiaries as $b)
                    <tr>
                        <td>{{ $b->name }}</td>
                        <td>{{ $b->nid }}</td>
                        <td>{{ $b->address }}</td>
                        <td>{{ $b->division }}</td>
                        <td>{{ $b->district }}</td>
                        <td>{{ $b->upazila }}</td>
                        <td>{{ $b->union }}</td>
                        <td>{{ $b->phone }}</td>
                        <td>{{ $b->gender }}</td>
                        <td>{{ $b->father }}</td>
                        <td>{{ $b->mother }}</td>
                        <td>{{ $b->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center">No data found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
