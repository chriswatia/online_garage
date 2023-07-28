@extends('user.user')

@section('title', 'Scheduled Services')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Scheduled Services
                    <a href="{{ url('add-booking') }}" class="btn btn-primary btn-sm float-end">Schedule Service
                        </a>
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ App\Models\Vehicle::where('id', $booking->vehicle_id)->first()->model }}</td>
                                <td>{{ App\Models\Service::where('id', $booking->service_id)->first()->service }}</td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ $booking->notes }}</td>

                                @if ($vehicle->status == "Pending")
                                <td style="color:grey">Pending</td>

                                @elseif ($vehicle->status == "In Progress")
                                <td style="color:blue">In Progress</td>

                                @else
                                <td style="color:green">Done</td>
                                @endif
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('edit-booking/' . $booking->id) }}">Edit</a>
                                    {{-- | --}}
                                    {{-- <a class="btn btn-danger btn-sm" href="{{ url('delete-booking/' . $booking->id) }}">Delete</a> --}}

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
