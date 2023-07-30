@extends('layouts.master')

@section('title', 'View Order')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">View Order</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/orders') }}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Order Number</label>
                            <input type="number" name="order_number" value="{{ $order->order_number }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Order Date</label>
                            <input type="date" name="order_date" value="{{ $order->order_date }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Customer Name</label>
                            <input type="number" name="name" value="{{ $order->firstname }}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Customer Phone No.</label>
                            <input type="number" name="phone" value="{{ $order->phone }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Mechanic Name</label>
                            <input type="text" name="supervisor" value="{{ $order->supervisor }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Supervisor</label>
                            <input type="text" name="supervisor" value="{{ $order->supervisor }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Customer Vehicle</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="vehicle_type" id="customerVehicle" onchange="updateRegNo()">
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Vehicle Registration Number</label>
                            <input type="text" name="registration_number" class="form-control" id="registration_number" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mt-4">
                                <!-- Hidden input field to store the selected service IDs -->
                                <input type="hidden" name="selected_services" id="selectedServices">
                                <div class="card-header">
                                    <h4 class="">Services Done
                                    </h4>
                                </div>
                                <div class="card-body" id="servicesContainer">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Service</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- The services rows will be dynamically added here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h4 class="">Products Used
                                    </h4>
                                </div>
                                <div class="card-body" id="productsContainer">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Rate/Price</th>
                                                <th>Available</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- The services rows will be dynamically added here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4 class="">Payment Amounts
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-1">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Sub Total</label>
                                        <input type="number" name="sub_total" value="{{ $order->sub_total }}" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Total Amount</label>
                                        <input type="number" name="total_amount" value="{{ $order->total_amount }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Discount</label>
                                        <input type="number" name="discount" value="{{ $order->discount }}" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Grand Total</label>
                                        <input type="number" name="grand_total" value="{{ $order->grand_total }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Paid Amount</label>
                                        <input type="number" name="paid" value="{{ $order->paid }}" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Due Amount</label>
                                        <input type="number" name="due" value="{{ $order->due }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Payment Type</label>
                                        <input type="number" name="due" value="{{ $order->due }}" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Status</label>
                                        <input type="number" name="due" value="{{ $order->order_status }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <button type="submit" class="btn btn-primary">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
