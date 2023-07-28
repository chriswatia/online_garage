@extends('user.user')

@section('title', 'Add Vehicle')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Vehicle</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('add-vehicle') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Brand</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                name="brand_id">
                                @foreach ($brands as $brand)
                                    <option class="form-control" name="brand_id" value="{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Model</label>
                            <input type="text" name="model" id="" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Year</label>
                            <input type="number" name="year" id="" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Color</label>
                            <input type="text" name="color" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Registration Number</label>
                            <input type="text" name="registration_number" id="" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Mileage</label>
                            <input type="text" name="mileage" id="" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Fuel Type</label>
                            <input type="text" name="fuel_type" id="" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status">
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
