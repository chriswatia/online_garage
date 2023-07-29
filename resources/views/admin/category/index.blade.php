@extends('layouts.master')

@section('title', 'Product Category List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Product Category List
                    @if (Auth::user()->role_id == 1)
                    <a href="{{ url('admin/add-category') }}" class="btn btn-primary btn-sm float-end">Add Product Category
                        </a>
                    @endif
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
                            @if (Auth::user()->role_id == 1)
                            <th>Action</th>
                            @endif
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
                                @if (Auth::user()->role_id == 1)
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/edit-category/' . $category->id) }}">Edit</a> |
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-category/' . $category->id) }}">Delete</a>

                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
