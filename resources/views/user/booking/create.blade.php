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
                <form action="{{ url('add-booking') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Vehicle</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="vehicle_id" required>
                                @foreach ($vehicles as $vehicle)
                                    <option class="form-control" name="vehicle_id" value="{{ $vehicle->id }}">
                                        {{ $vehicle->name .' '.$vehicle->model .' - '.$vehicle->registration_number}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Service</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="service_id" required>
                                @foreach ($services as $service)
                                    <option class="form-control" name="service_id" value="{{ $service->id }}">
                                        {{ $service->service}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Date</label>
                            <input type="datetime-local" name="date" id="" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Status</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="status">
                            <option value="Pending">Pending</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label for="">Notes</label>
                            <textarea name="notes" id="" class="form-control" required></textarea>
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
