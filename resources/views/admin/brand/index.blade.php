@extends('layouts.master')

@section('title', 'Brand List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Brand List
                    <a href="{{ url('admin/add-brand') }}" class="btn btn-primary btn-sm float-end">Add Brand
                        </a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                @if ($brand->status == "1")
                                <td style="color:green">Available</td>
                                @else
                                <td style="color:red">Not Available</td> 
                                @endif                                
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/edit-brand/' . $brand->id) }}">Edit</a> |
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-brand/' . $brand->id) }}">Delete</a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
