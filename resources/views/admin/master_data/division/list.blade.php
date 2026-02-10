@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Division List</h4>
    <a href="#" class="btn btn-primary">Add Division</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Division Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Dhaka</td>
            <td>
                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                <a href="#" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
    </tbody>
</table>
@endsection
