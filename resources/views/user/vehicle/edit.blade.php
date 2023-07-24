@extends('user.user')

@section('title', 'Edit product')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit product</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/edit-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $product->name }}" id="" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Brand</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="brand_id">
                                {{-- <option selected>{{ $cell}}</option> --}}
                                @foreach ($brands as $brand)
                                <option {{ old('brand_id', $product->brand_id) ==  $brand->id ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Category</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category_id">
                                {{-- <option selected>{{ $cell}}</option> --}}
                                @foreach ($categories as $category)
                                <option {{ old('category_id', $product->category_id) ==  $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Quantity</label>
                            <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Rate(Kshs)</label>
                            <input type="number" name="rate" value="{{ $product->rate }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status">
                        <option value="1" @if (old($product->status) == "1") {{ "selected" }} @endif>Available</option>
                        <option value="0" @if (old($product->status) == "0") {{ "selected" }} @endif>Not Available</option>
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
