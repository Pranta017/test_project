<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Beneficiary</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }
        #sidebar-wrapper {
            min-height: 100vh;
            width: 220px;
        }
        .list-group-item:hover {
            background-color: #343a40;
        }
        .list-group,
        .list-group-item {
            border: none !important;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white" id="sidebar-wrapper">
        <div class="text-center py-4 fs-4 fw-bold">
            Dashboard
        </div>

        <div class="list-group list-group-flush">
            <a href="{{ route('dashboard') }}" class="list-group-item bg-dark text-white">Dashboard</a>
            <a href="{{ route('beneficiaries.index') }}" class="list-group-item bg-dark text-white">Beneficiaries</a>
            <a href="#" class="list-group-item bg-dark text-white">Training</a>
        </div>
    </div>

    <!-- Page Content -->
    <div class="flex-fill">

        <!-- Navbar -->
        <nav class="navbar navbar-light bg-light border-bottom px-3">
            <button class="btn btn-primary" id="menu-toggle">☰</button>

            <ul class="navbar-nav ms-auto flex-row gap-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <!-- Main Content -->
        <div class="container py-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="mb-4">Edit Beneficiary</h4>

                    <form action="{{ route('beneficiaries.update', $beneficiary->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $beneficiary->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NID</label>
                            <input type="text" name="nid" class="form-control"
                                   value="{{ old('nid', $beneficiary->nid) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control"
                                   value="{{ old('address', $beneficiary->address) }}">
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Division</label>
                                <input type="text" name="division" class="form-control"
                                       value="{{ old('division', $beneficiary->division) }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">District</label>
                                <input type="text" name="district" class="form-control"
                                       value="{{ old('district', $beneficiary->district) }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Upazila</label>
                                <input type="text" name="upazila" class="form-control"
                                       value="{{ old('upazila', $beneficiary->upazila) }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Union</label>
                                <input type="text" name="union" class="form-control"
                                       value="{{ old('union', $beneficiary->union) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone', $beneficiary->phone) }}">
                        </div>

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Male" {{ $beneficiary->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $beneficiary->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Father</label>
                                <input type="text" name="father" class="form-control"
                                       value="{{ old('father', $beneficiary->father) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mother</label>
                            <input type="text" name="mother" class="form-control"
                                   value="{{ old('mother', $beneficiary->mother) }}">
                        </div>

                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('beneficiaries.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function () {
        document.getElementById('sidebar-wrapper').classList.toggle('d-none');
    });
</script>

</body>
</html>
