@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

        <!-- Dashboard Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <h5>Total Users</h5>
                            <h3>{{ $totalUsers ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            <h5>Total Beneficiaries</h5>
                            <h3>{{ $totalBeneficiaries ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-dark shadow">
                        <div class="card-body">
                            <h5>New Registrations </h5>
                            <h3>{{ $newRegistrations ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            <h5>Pending Requests</h5>
                            <h3>{{ $pendingRequests ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

@endsection
