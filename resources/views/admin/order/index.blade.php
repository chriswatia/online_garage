@extends('layouts.master')

@section('title', 'Order List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Order List
                    <a href="{{ url('admin/add-order') }}" class="btn btn-primary btn-sm float-end">Add Order
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
                            <th>ID</th>
                            <th>Oder Date</th>
                            <th>Client Name</th>
                            <th>Contact</th>
                            <th>Total Amount(Kshs)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ App\Models\User::where('id', $order->user_id)->first()->firstname }}</td>
                                <td>{{ App\Models\User::where('id', $order->user_id)->first()->phone }}</td>
                                <td>{{ $order->grand_total }}</td>
                                @if ($order->order_status == "1")
                                <td style="color:green">Available</td>
                                @else
                                <td style="color:red">Not Available</td>
                                @endif
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/edit-order/' . $order->id) }}">Edit</a> |
                                    <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-order/' . $order->id) }}">Delete</a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection