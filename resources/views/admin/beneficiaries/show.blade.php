@extends('admin.layout')

@section('content')

<div class="container">

    <h3>Beneficiary Details</h3>

    <table class="table table-bordered">

        <tr>
            <th>Name</th>
            <td>{{ $beneficiary->name }}</td>
        </tr>

        <tr>
            <th>Phone</th>
            <td>{{ $beneficiary->phone }}</td>
        </tr>

        <tr>
            <th>NID</th>
            <td>{{ $beneficiary->nid }}</td>
        </tr>

        <tr>
            <th>Division Name</th>
            <td>{{ $beneficiary->division->name }}</td>
        </tr>

        <tr>
            <th>District Name</th>
            <td>{{ $beneficiary->district->name }}</td>
        </tr>

        <tr>
            <th>Upazila Name</th>
            <td>{{ $beneficiary->upazila->name }}</td>
        </tr>

        <tr>
            <th>Father Name</th>
            <td>{{ $beneficiary->father }}</td>
        </tr>

        <tr>
            <th>Mother Name</th>
            <td>{{ $beneficiary->mother }}</td>
        </tr>


    </table>

    <a href="{{ route('beneficiaries.index') }}"
       class="btn btn-primary">

       Back

    </a>

</div>

@endsection
