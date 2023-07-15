@extends('layouts.master')

@section('title', 'Service Category List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Service Category List
                    <a href="{{ url('admin/add-category') }}" class="btn btn-primary btn-sm float-end">Add Service Category
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
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                @if ($category->status == "1")
                                <td style="color:green">Available</td>
                                @else
                                <td style="color:red">Not Available</td> 
                                @endif                                
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/edit-category/' . $category->id) }}">Edit</a> |
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-category/' . $category->id) }}">Delete</a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
