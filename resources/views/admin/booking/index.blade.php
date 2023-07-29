@extends('layouts.master')

@section('title', 'Scheduled Services')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Scheduled Services</h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Contact</th>
                            <th>Vehicle</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Mechanic</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->firstname .' '. $booking->lastname }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->name .' '. $booking->model .' - '.$booking->registration_number }}</td>
                                <td>{{ App\Models\Service::where('id', $booking->service_id)->first()->service }}</td>
                                <td>{{ $booking->date }}</td>
                                <td>{{ optional(App\Models\User::where('id', $booking->mechanic_id)->first())->firstname .' '
                                        .optional(App\Models\User::where('id', $booking->mechanic_id)->first())->lastname }}</td>

                                @if ($booking->status == "Pending")
                                <td style="color:blue">Pending</td>

                                @elseif ($booking->status == "In Progress")
                                <td style="color:green">In Progress</td>

                                @else
                                <td style="color:red">Done</td>
                                @endif

                                @if ($booking->mechanic_id)
                                <td>
                                    @if ($booking->status == 'In Progress')
                                        <a class="btn btn-danger btn-sm" href="{{ url('admin/close/' . $booking->id) }}">Done</a>
                                    @else
                                        <a class="btn btn-success btn-sm" href="{{ url('admin/view/' . $booking->id) }}">View</a>
                                    @endif
                                </td>
                                @else
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/assign-mechanic/' . $booking->id) }}">Assign Mechanic</a>
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
