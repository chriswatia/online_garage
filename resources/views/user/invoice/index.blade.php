@extends('user.user')

@section('title', 'My Invoices')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Invoices
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
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
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ App\Models\User::where('id', $order->user_id)->first()->firstname .' '
                                 .App\Models\User::where('id', $order->user_id)->first()->lastname}}</td>
                                <td>{{ App\Models\User::where('id', $order->user_id)->first()->phone }}</td>
                                <td>{{ $order->grand_total }}</td>
                                @if ($order->order_status == "Pending")
                                <td style="color:blue">Pending</td>
                                @elseif ($order->order_status == "Paid")
                                <td style="color:green">Paid</td>
                                @else
                                <td style="color:red">Closed</td>
                                @endif
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('admin/edit-order/' . $order->id) }}">Pay</a>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
