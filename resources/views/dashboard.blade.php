<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

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
        #page-content-wrapper {
            flex: 1;
        }
        .list-group-item:hover {
            background-color: #343a40;
        }
    </style>
</head>
<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark text-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold">My Website</div>
        <div class="list-group list-group-flush">
            <a href="{{ url('/dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
            <a href="{{ url('/beneficiaries') }}" class="list-group-item list-group-item-action bg-dark text-white">Beneficiaries</a>
        </div>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper" class="w-100">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
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
                </div>
            </div>
        </nav>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <div class="container-fluid px-4 mt-4">

            <!-- Dashboard Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <h5>Total Users</h5>
                            <h3>120</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            <h5>Active Beneficiaries</h5>
                            <h3>75</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-dark shadow">
                        <div class="card-body">
                            <h5>New Registrations</h5>
                            <h3>15</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            <h5>Pending Requests</h5>
                            <h3>5</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Beneficiaries Table -->
            <div class="card shadow mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5>Beneficiaries</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>john@example.com</td>
                                <td>2026-02-03</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td>jane@example.com</td>
                                <td>2026-02-02</td>
                            </tr>
                            <!-- Add dynamic rows from database later -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar Toggle JS -->
<script>
    const toggleButton = document.getElementById('menu-toggle');
    toggleButton.addEventListener('click', function() {
        document.getElementById('sidebar-wrapper').classList.toggle('d-none');
    });
</script>

</body>
</html>
