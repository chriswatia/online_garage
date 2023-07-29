@extends('user.user')

@section('title', 'Schedule Service')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Schedule Service</h4>
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
                            <label for="">Vehicle</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                name="vehicle_id">
                                @foreach ($vehicles as $vehicle)
                                    <option class="form-control" name="vehicle_id" value="{{ $vehicle->id }}">
                                        {{ $vehicle->name .' '.$vehicle->model .' - '.$vehicle->registration_number}}
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
                            <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <button type="submit" class="btn btn-primary">Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
