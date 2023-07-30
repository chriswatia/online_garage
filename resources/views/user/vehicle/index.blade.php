@extends('user.user')

@section('title', 'Scheduled Services')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Vehicle List
                    <a href="{{ url('add-vehicle') }}" class="btn btn-primary btn-sm float-end">Add Vehicle
                        </a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @elseif (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Color</th>
                            <th>Registration Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->id }}</td>
                                <td>{{ App\Models\Brand::where('id', $vehicle->brand_id)->first()->name }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td>{{ $vehicle->year }}</td>
                                <td>{{ $vehicle->color }}</td>
                                <td>{{ $vehicle->registration_number }}</td>
                                @if ($vehicle->status == "1")
                                <td style="color:green">Available</td>
                                @else
                                <td style="color:red">Not Available</td>
                                @endif
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('edit-vehicle/' . $vehicle->id) }}">Edit</a>
                                    {{-- | --}}
                                    {{-- <a class="btn btn-danger btn-sm" href="{{ url('delete-vehicle/' . $vehicle->id) }}">Delete</a> --}}

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
