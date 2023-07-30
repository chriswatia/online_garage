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
                            <input type="date" name="order_date" id="" class="form-control" required>
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
                                        <a onclick="addRow()" class="btn btn-primary btn-sm float-end">Add Service
                                            </a>
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
                                <!-- Hidden input field to store the selected service IDs -->
                                <input type="hidden" name="selected_products" id="selectedProducts">
                                <div class="card-header">
                                    <h4 class="">Products Used
                                        <a onclick="addProduct()" class="btn btn-primary btn-sm float-end">Add Product
                                            </a>
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
                                    <a onclick="calculateAmounts()" class="btn btn-primary btn-sm float-end">Calculate
                                        </a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-1">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Sub Total</label>
                                        <input type="number" name="sub_total" value="0" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Total Amount</label>
                                        <input type="number" name="total_amount" value="0" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Discount</label>
                                        <input type="number" id="discountInput" name="discount" value="0" class="form-control" oninput="updateGrandTotalOnDiscountChange">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Grand Total</label>
                                        <input type="number" name="grand_total" value="0" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="">Paid Amount</label>
                                        <input type="number" name="paid" value="0" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="">Due Amount</label>
                                        <input type="number" name="due" value="0" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="">Payment Type</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="payment_type">
                                            <option value="Cash">Cash</option>
                                            <option value="M_PESA" selected>M-PESA</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Status</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-lg example" required="required" name="order_status">
                                            <option value="Pending">Pending</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Closed">Closed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    // Function to add a new service row dynamically
    function addRow() {
        const servicesContainer = document.getElementById('servicesContainer');
        const rowId = Date.now(); // Unique identifier for each row
        const newRowHtml = `
        <div class="row" id="row-${rowId}">
            <div class="col-md-6 mt-2">
                <select class="form-select" name="service_id[]" onchange="updatePrice(${rowId})" id="serviceSelect-${rowId}">
                    <option selected>Choose Service</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->service }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mt-2">
                <input type="number" class="form-control" name="service_price[]" readonly id="servicePrice-${rowId}">
            </div>
            <div class="col-md-1 mt-2">
                <button class="btn btn-danger" onclick="removeRow(${rowId})">Remove</button>
            </div>
        </div>
        `;

        // Create a new element and add it to the servicesContainer
        const newRow = document.createElement('div');
        newRow.innerHTML = newRowHtml;
        servicesContainer.appendChild(newRow);

        // Attach the updateSelectedServices function to the onchange event of service selects
        const serviceSelect = newRow.querySelector('select[name="service_id[]"]');
        serviceSelect.addEventListener('change', updateSelectedServices);
    }

    // Function to remove a service row
    function removeRow(rowId) {
        const row = document.getElementById(`row-${rowId}`);
        row.remove();
    }

    function addProduct() {
        const servicesContainer = document.getElementById('productsContainer');
        const rowId = Date.now(); // Unique identifier for each row
        const newRowHtml = `
        <div class="row" id="row-${rowId}">
            <div class="col-md-3 mt-2">
                <select class="form-select" name="product_id[]" onchange="updateProductPrice(${rowId})">
                    <option selected>Choose Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mt-2">
                <input type="number" class="form-control" placeholder="Rate" name="product_price[]" readonly id="productPrice-${rowId}">
            </div>
            <div class="col-md-2 mt-2">
                <input type="number" class="form-control" placeholder="Available" name="product_available_quantity[]" readonly id="productQuantity-${rowId}">
            </div>
            <div class="col-md-2 mt-2">
                <input type="number" class="form-control" placeholder="Quantity" name="product_request_quantity[]" place id="productRequestQuantity-${rowId}" oninput="updateProductTotalAmount(${rowId})">
            </div>
            <div class="col-md-2 mt-2">
                <input type="number" class="form-control" placeholder="Total Amount" name="total_amount[]" readonly place id="productTotalAmount-${rowId}">
            </div>
            <div class="col-md-1 mt-2">
                <button class="btn btn-danger" onclick="removeProductRow(${rowId})">Remove</button>
            </div>
        </div>
        `;

        // Create a new element and add it to the productsContainer
        const newRow = document.createElement('div');
        newRow.innerHTML = newRowHtml;
        productsContainer.appendChild(newRow);

        // Attach the updateSelectedProducts function to the onchange event of product selects
        const productSelect = newRow.querySelector('select[name="product_id[]"]');
        productSelect.addEventListener('change', updateSelectedProducts);
    }

    function removeProductRow(rowId) {
        const row = document.getElementById(`row-${rowId}`);
        row.remove();
    }

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
        const customerVehicleSelect = document.getElementById("customerVehicle");


        const selectedCustomerId = customerSelect.value;
        const selectedCustomerPhone = customerData[selectedCustomerId] || ''; // Get the phone number or an empty string if not found
        customerPhoneInput.value = selectedCustomerPhone;
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

    function updateRegNo(){
        const customerVehicleSelect = document.getElementById("customerVehicle");
        const registration_number = document.getElementById("registration_number");
        customerVehicle = customerVehicleSelect.value;

        fetch(`/api/getVehicle/${customerVehicle}`)
            .then(response => response.json())
            .then(data => {
                // Populate the customer vehicle options
                data.forEach(vehicle => {
                    registration_number.value = vehicle.registration_number
                });
            })
            .catch(error => {
                console.error("Error fetching customer vehicles:", error);
            });
    }

    const serviceData = {
    @foreach ($services as $service)
        "{{ $service->id }}": "{{ $service->rate }}",
        @endforeach
    };

    function updatePrice(rowId) {
        const serviceSelect = document.querySelector(`#row-${rowId} select`);
        const servicePriceInput = document.querySelector(`#row-${rowId} input`);

        const selectedServiceId = serviceSelect.value;
        const selectedServicePrice = serviceData[selectedServiceId] || 0;
        servicePriceInput.value = selectedServicePrice;
    }

    // Function to update the hidden input field with selected service IDs
    function updateSelectedServices() {
        const serviceSelects = document.querySelectorAll('select[name="service_id[]"]');
        const servicePrices = document.querySelectorAll('input[name="service_price[]"]');
        const selectedServices = [];

        for (let i = 0; i < serviceSelects.length; i++) {
            const select = serviceSelects[i];
            const priceInput = servicePrices[i];
            const serviceId = select.value;
            const servicePrice = priceInput.value;

            if (servicePrice !== '') {
                selectedServices.push(serviceId);
            }
        }

        const hiddenInput = document.getElementById('selectedServices');
        hiddenInput.value = selectedServices.join(',');
    }

    // Attach the updateSelectedServices function to the onchange event of service selects
    const serviceSelects = document.querySelectorAll('select[name="service_id[]"]');
    serviceSelects.forEach(select => {
        select.addEventListener('change', updateSelectedServices);
    });

    const productData = {
        @foreach ($products as $product)
            "{{ $product->id }}": {
                "rate": "{{ $product->rate }}",
                "quantity": "{{ $product->quantity }}"
            },
        @endforeach
    };

    function updateProductPrice(rowId) {
        const productSelect = document.querySelector(`#row-${rowId} select`);
        const productPriceInput = document.querySelector(`#row-${rowId} input[name="product_price[]"]`);
        const productQuantityInput = document.querySelector(`#row-${rowId} input[name="product_available_quantity[]"]`);
        const productRequestQuantityInput = document.querySelector(`#row-${rowId} input[name="product_request_quantity[]"]`);
        const productTotalAmountInput = document.querySelector(`#row-${rowId} input[name="total_amount[]"]`);

        const selectedProductId = productSelect.value;
        const selectedProduct = productData[selectedProductId] || { rate: 0, quantity: 0 };

        const selectedProductPrice = selectedProduct.rate || 0;
        const selectedProductQuantity = selectedProduct.quantity || 0;
        const requestedQuantity = productRequestQuantityInput.value || 0;

        productPriceInput.value = selectedProductPrice;
        productQuantityInput.value = selectedProductQuantity;
        productTotalAmountInput.value = selectedProductPrice * requestedQuantity;
    }

    // Function to update the hidden input field with selected service IDs
    function updateSelectedProducts() {
        const productSelects = document.querySelectorAll('select[name="product_id[]"]');
        const productQuantities = document.querySelectorAll('input[name="product_request_quantity[]"]');
        const selectedProducts = [];

        for (let i = 0; i < productSelects.length; i++) {
            const select = productSelects[i];
            const quantityInput = productQuantities[i];
            const productId = select.value;
            const quantity = quantityInput.value;

            if (quantity !== '' && quantity > 0) {
                selectedProducts.push({ id: productId, quantity: quantity });
            }
        }

        const hiddenInput = document.getElementById('selectedProducts');
        hiddenInput.value = JSON.stringify(selectedProducts);
    }

    // Attach the updateSelectedProducts function to the onchange event of product selects
    const productSelects = document.querySelectorAll('select[name="product_id[]"]');
    productSelects.forEach(select => {
        select.addEventListener('change', updateSelectedProducts);
    });

    function updateProductTotalAmount(rowId) {
        const productRequestQuantityInput = document.querySelector(`#row-${rowId} input[name="product_request_quantity[]"]`);
        const productPriceInput = document.querySelector(`#row-${rowId} input[name="product_price[]"]`);
        const productTotalAmountInput = document.querySelector(`#row-${rowId} input[name="total_amount[]"]`);

        const requestedQuantity = productRequestQuantityInput.value || 0;
        const productPrice = productPriceInput.value || 0;
        const totalAmount = requestedQuantity * productPrice;

        productTotalAmountInput.value = totalAmount;
        updateGrandTotal();
    }

    // Function to calculate payment amounts
    function calculateAmounts() {
        const subTotalInput = document.querySelector('input[name="sub_total"]');
        const totalAmountInput = document.querySelector('input[name="total_amount"]');
        const discountInput = document.getElementById('discountInput');
        const grandTotalInput = document.querySelector('input[name="grand_total"]');
        const paidAmountInput = document.querySelector('input[name="paid"]');
        const dueAmountInput = document.querySelector('input[name="due"]');

        // Calculate the total price of services
        const servicePriceInputs = document.querySelectorAll('input[name="service_price[]"]');
        let servicesTotal = 0;
        servicePriceInputs.forEach(input => {
            const price = parseFloat(input.value) || 0;
            servicesTotal += price;
        });

        // Calculate the total price of products
        const productTotalAmountInputs = document.querySelectorAll('input[name="total_amount[]"]');
        let productsTotal = 0;
        productTotalAmountInputs.forEach(input => {
            const price = parseFloat(input.value) || 0;
            productsTotal += price;
        });

        // Calculate sub total and total amount
        const subTotal = servicesTotal + productsTotal;
        const discount = parseFloat(discountInput.value) || 0;
        const totalAmount = servicesTotal + productsTotal;

        // Update the sub total and total amount inputs
        subTotalInput.value = subTotal.toFixed(2);
        totalAmountInput.value = totalAmount.toFixed(2);

        // Calculate grand total and due amount
        const paidAmount = parseFloat(paidAmountInput.value) || 0;
        const grandTotal = subTotal - discount;
        const dueAmount = grandTotal - paidAmount;

        // Update the grand total and due amount inputs
        grandTotalInput.value = grandTotal.toFixed(2);
        dueAmountInput.value = dueAmount.toFixed(2);
    }

</script>

