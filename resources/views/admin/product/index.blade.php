@extends('layouts.master')

@section('title', 'Product List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Product List
                    @if (Auth::user()->role_id == 1)
                    <a href="{{ url('admin/add-product') }}" class="btn btn-primary btn-sm float-end">Add Product
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Rate(Kshs)</th>
                            <th>Status</th>
                            @if (Auth::user()->role_id == 1)
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <img src="{{ asset('uploads/images/' . $product->image) }}" width="50px" height="50px"
                                        alt="">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ App\Models\Brand::where('id', $product->brand_id)->first()->name }}</td>
                                <td>{{ App\Models\Category::where('id', $product->category_id)->first()->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->rate }}</td>
                                @if ($product->status == "1")
                                <td style="color:green">Available</td>
                                @else
                                <td style="color:red">Not Available</td>
                                @endif
                                @if (Auth::user()->role_id == 1)
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/edit-product/' . $product->id) }}">Edit</a> |
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-product/' . $product->id) }}">Delete</a>

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
