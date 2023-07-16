@extends('layouts.master')

@section('title', 'Add Product')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Product</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/add-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Brand</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                name="brand_id">
                                <option selected>Choose Brand</option>
                                @foreach ($brands as $brand)
                                    <option class="form-control" name="brand_id" value="{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Category</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                name="category_id">
                                <option selected>Choose category</option>
                                @foreach ($categories as $category)
                                    <option class="form-control" name="category_id" value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Quantity</label>
                            <input type="number" name="quantity" id="" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Rate(Kshs)</label>
                            <input type="number" name="rate" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="">Status</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status">
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
