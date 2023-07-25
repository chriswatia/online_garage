@extends('layouts.master')

@section('title', 'Add Order')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="">Add Order</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/add-order') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Order Number</label>
                            <input type="number" name="order_number" value="{{ $order_number }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Order Date</label>
                            <input type="date" name="name" id="" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Customer Name</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_id" id="customerSelect" onchange="updateInputs()">
                                @foreach ($customers as $customer)
                                    <option selected>Choose Customer</option>
                                    <option class="form-control" name="user_id" value="{{ $customer->id }}">
                                        {{ $customer->firstname.' '.$customer->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Customer Phone No.</label>
                            <input type="number" name="phone" id="customerPhone" value="" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Mechanic Name</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="mechanic_id" >
                                @foreach ($mechanics as $mechanic)
                                    <option selected>Choose Mechanic</option>
                                    <option class="form-control" name="mechanic" value="{{ $mechanic->id }}">
                                        {{ $mechanic->firstname.' '.$mechanic->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Supervisor</label>
                            <input type="text" name="supervisor" id="" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Customer Vehicle</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="vehicle_id" id="customerVehicle">
                                <!-- Your options will be dynamically added here -->
                            </select>
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="">Supervisor</label>
                            <input type="text" name="supervisor" id="" class="form-control" required>
                        </div> --}}
                    </div>

                    <div class="mb-3">
                        <label for="">Status</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="order_status">
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
     // Create an object to store the customer data (id -> phone mapping)
     const customerData = {
        @foreach ($customers as $customer)
            "{{ $customer->id }}": "{{ $customer->phone }}",
        @endforeach
    };

    // Function to update the phone input field based on the selected customer
    function updateInputs() {
        const customerSelect = document.getElementById('customerSelect');
        const customerPhoneInput = document.getElementById('customerPhone');
        const selectedCustomerId = customerSelect.value;
        const selectedCustomerPhone = customerData[selectedCustomerId] || ''; // Get the phone number or an empty string if not found
        customerPhoneInput.value = selectedCustomerPhone;

        const customerVehicleSelect = document.getElementById("customerVehicle");
        const selectedUserId = customerSelect.value;

        // Clear previous options
        customerVehicleSelect.innerHTML = "";

        // Add a default "Choose Vehicle" option
        const defaultOption = document.createElement("option");
        defaultOption.text = "Choose Vehicle";
        customerVehicleSelect.appendChild(defaultOption);

        // Fetch the customer vehicles using AJAX
        fetch(`/api/getCustomerVehicles/${selectedUserId}`)
            .then(response => response.json())
            .then(data => {
                // Populate the customer vehicle options
                console.log(data);
                data.forEach(vehicle => {
                    const option = document.createElement("option");
                    option.value = vehicle.id;
                    option.text = `${vehicle.name} ${vehicle.model}`;
                    customerVehicleSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error("Error fetching customer vehicles:", error);
            });
    }

</script>

