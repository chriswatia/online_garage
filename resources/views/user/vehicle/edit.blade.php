@extends('user.user')

@section('title', 'Edit Vehicle')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Edit Vehicle</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('edit-vehicle/'.$vehicle->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Brand</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="brand_id">
                                @foreach ($brands as $brand)
                                    <option {{ old('brand_id', $vehicle->brand_id) ==  $brand->id ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Model</label>
                            <input type="text" name="model" value="{{ $vehicle->model }}" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Year</label>
                            <input type="number" name="year" value="{{ $vehicle->year }}" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Color</label>
                            <input type="text" name="color" value="{{ $vehicle->color }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Registration Number</label>
                            <input type="text" name="registration_number" value="{{ $vehicle->registration_number }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Mileage</label>
                            <input type="text" name="mileage" value="{{ $vehicle->mileage }}" class="form-control">
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Fuel Type</label>
                            <input type="text" name="fuel_type" value="{{ $vehicle->fuel_type }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status">
                            <option value="1" @if (old($vehicle->status) == "1") {{ "selected" }} @endif>Available</option>
                            <option value="0" @if (old($vehicle->status) == "0") {{ "selected" }} @endif>Not Available</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
