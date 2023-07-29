@extends('layouts.master')

@section('title', 'View Booking')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">View Booking</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/viewBooking/'.$booking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Vehicle</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="vehicle_id" disabled>
                                @foreach ($vehicles as $vehicle)
                                <option {{ old('vehicle_id', $booking->vehicle_id) ==  $vehicle->id ? 'selected' : ''}} value="{{ $vehicle->id }}">
                                    {{ $vehicle->name .' '.$vehicle->model .' - '.$vehicle->registration_number}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Service</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="service_id" disabled>
                                @foreach ($services as $service)
                                <option {{ old('service_id', $booking->service_id) ==  $service->id ? 'selected' : ''}} value="{{ $service->id }}">
                                    {{ $service->service }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Date</label>
                            <input type="datetime-local" name="date" value="{{ $booking->date }}" class="form-control" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status" disabled>
                            <option value="Done">Done</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label for="">Notes</label>
                            <textarea name="notes" id="" class="form-control" required readonly>{{ $booking->notes }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Mechanic</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="mechanic_id" disabled>
                            @foreach ($mechanics as $mechanic)
                                <option class="form-control" name="mechanic_id" value="{{ $mechanic->user_id }}">
                                    {{ $mechanic->firstname .' '.$mechanic->lastname .' - '.$mechanic->specialization}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
