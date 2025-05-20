@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .autocomplete-results {
            position: absolute;
            z-index: 1000;
            background-color: white;
            border: 1px solid #ccc;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            /* Initially hidden */
        }

        .autocomplete-results a {
            display: block;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
        }

        .autocomplete-results a:hover {
            background-color: #f0f0f0;
        }
    </style>
    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="mx-auto rounded border p-4 shadow-lg bg-white">
                    <h2 class="py-3 text-3xl font-bold text-gray-800">Search Existing Patient</h2>


                    <div class="row mb-4">
                        <div class="col-md-9 mb-3">
                            <label for="patient_info" class="form-label">Search patient</label>
                            <input type="text" name="patient_info" id="patient_info" class="form-control"
                                placeholder="Search patient by  name or ID or phone number" />
                            <div class="autocomplete-results"></div>
                        </div>


                    </div>

                    <div class="">
                        <a class="btn btn-sm btn-secondary" title="Patient" href="{{ route('reception.create') }}">
                            <i class="fas fa-pus"></i> Add Patient
                        </a>
                    </div>
                </div>


                <div class="rounded border p-4 shadow-lg bg-white mt-8">
                    <h2 class="py-3 text-3xl font-bold text-gray-800">Invoice</h2>
                    <form id="invoice-form" action="{{ route('reception.payment.store') }}" method="POST">@csrf
                        <div class="mb-4">
                            <div class="form-row">
                                <input type="hidden" name="customer[id]" id="customer_id">
                                <div class="col-md-3 mb-3">
                                    <label for="name" class="font-semibold text-gray-700">Name</label>
                                    <input type="text" class="form-control" id="name" name="customer[name]"
                                        placeholder="Patient Name" readonly>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="phone" class="font-semibold text-gray-700">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="customer[phone]"
                                        placeholder="Phone Number" readonly>
                                </div>

                            </div>
                        </div>

                        <div id="service-section">
                            <div class="form-row align-items-center mb-3">
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="" class="">Service Name</label>
                                </div>

                                <div class="col-12 col-md-2 mb-2">
                                    <label for="" class="">Amount</label>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                </div>
                            </div>
                            <div class="form-row align-items-center mb-3">
                                <input type="hidden" name="services[0][primary_id]" value="">
                                <div class="col-12 col-md-2 mb-2">
                                    {{-- <label for="item-name-0" class="sr-only">Item Name</label> --}}
                                    <input type="text" class="form-control item-name" id="item-name-0"
                                        name="services[0][name]" placeholder="Search by name or ID">
                                    <div class="autocomplete-results"></div>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    {{-- <label for="amount-0" class="sr-only">Amount</label> --}}
                                    <input type="number" class="form-control" id="amount-0" name="services[0][amount]"
                                        placeholder="Amount" readonly>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary mb-4" onclick="addItem()">Add Item</button>

                        <div class="mb-4">
                            <div id="invoice-details">
                                <!-- Dynamic list of services will be displayed here -->
                            </div>
                        </div>

                        <div id="show-manual-item-div" class="d-none">
                            <div id="manual-service-section">
                                <div class="form-row align-items-center mb-3">
                                    <div class="col-12 col-md-2 mb-2">
                                        <label for="" class="">Manual Service Name</label>
                                    </div>

                                    <div class="col-12 col-md-2 mb-2">
                                        <label for="" class="">Fund Type</label>
                                    </div>
                                    <div class="col-12 col-md-2 mb-2">
                                        <label for="" class="">Amount</label>
                                    </div>
                                    <div class="col-12 col-md-2 mb-2">
                                    </div>
                                </div>
                                <div class="form-row align-items-center mb-3">
                                    <div class="col-12 col-md-2 mb-2">
                                        <input type="text" class="form-control manual-item-name" id="manual-item-name-0"
                                            name="manual_services[0][name]" placeholder="Service Name">
                                    </div>

                                    <div class="col-12 col-md-2 mb-2">
                                        <select class="form-control" id="fund-type-0"
                                            name="manual_services[0][fund_type]">
                                            <option selected disabled value="">Select Fund Type</option>
                                            @foreach ($funds as $item)
                                                <option class="capitalize" value="{{ $item->id }}">{{ $item->type  }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-2 mb-2">
                                        <input type="number" class="form-control" id="manual-amount-0"
                                            name="manual_services[0][amount]" placeholder="Amount">
                                    </div>

                                    <div class="col-12 col-md-2 mb-2">
                                        <button type="button" class="btn btn-danger" onclick="removeManualItem(this)">
                                            &times;
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <button type="button" class="btn btn-primary mb-4" onclick="addManualItem()"><i class="fas fa-plus"></i></button>

                            <div class="mb-4">
                                <div id="manual-invoice-details">
                                    <!-- Dynamic list of manual services will be displayed here -->
                                </div>
                            </div>
                        </div>


                        <div class="mb-4 row justify-content-between">
                            <div class="d-flex align-items-end mb-4">
                                <button type="button" id="show-manual-item" class="btn btn-primary">Add Manual Item</button>
                            </div>
                            <div class="col-lg-6 col-xl-4">
                                <h2 class="h4 mb-3">Invoice Details</h2>
                                {{-- <h3 class="h5 mb-2">Total Price: <span id="total-price">0</span></h3> --}}
                                {{-- <input type="hidden" name="total" id="total_price_input" value="0"> --}}
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label class="sr-only " for="total">Total</label>
                                        <div class="input-group mb-0 mr-sm-0 ">
                                            <div class="input-group-prepend ">
                                                <div class="input-group-text" style="width: 140px;">Total</div>
                                            </div>
                                            <input class="form-control text-success text-right font-weight-bold h6 total"
                                                readonly type="text" required id="total_price_input" name="total">
                                        </div>
                                    </div>

                                    <div class="col-md-12 form-group">
                                        <label class="sr-only" for="discount">Discount %</label>
                                        <div class="input-group mb-0 mr-sm-0">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" style="width: 140px;">Discount %</div>
                                            </div>
                                            <input type="number"
                                                class="form-control text-success text-right font-weight-bold discount"
                                                style="border-radius: 0;" id="discount" value="0" name="discount">
                                        </div>
                                    </div>


                                    <div class="col-md-12 form-group">
                                        <label class="sr-only" for="payable">Payable</label>
                                        <div class="input-group mb-0 mr-sm-0">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text pay" style="width: 140px; "> Payable
                                                </div>
                                            </div>

                                            <input class="form-control text-success text-right font-weight-bold payable"
                                                readonly type="text" id="payable" name="payable">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary add btn-block lidl mt-3" name="save"
                                    onclick="submitForm()" id="save">Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        // on click show manual item
        document.getElementById('show-manual-item').addEventListener('click', function() {
            document.getElementById('show-manual-item-div').classList.toggle('d-none');

            if (document.getElementById('show-manual-item-div').classList.contains('d-none')) {
                document.querySelectorAll('input[name^="manual_services"]').forEach((input) => {
                    input.closest('.form-row').remove();
                    calculateTotal();
                });
            }
        });

        let itemCount = 1;

        // Add new budget item
        function addItem() {
            const itemContainer = document.createElement('div');
            itemContainer.classList.add('form-row', 'align-items-center', 'mb-3');
            itemContainer.innerHTML = `
                <input type="hidden" name="services[${itemCount}][primary_id]" value="">
                <div class="col-12 col-md-2 mb-2">
                    <input type="text" class="form-control item-name" id="item-name-${itemCount}" name="services[${itemCount}][name]" placeholder="Search by name or ID">
                    <div class="autocomplete-results"></div>
                </div>

                <div class="col-12 col-md-2 mb-2">
                    <input type="number" class="form-control" id="amount-${itemCount}" name="services[${itemCount}][amount]" placeholder="Amount" readonly>
                </div>
                <div class="col-12 col-md-2 mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                        &times;
                    </button>
                </div>`;
            document.getElementById('service-section').appendChild(itemContainer);
            itemCount++;
            attachAutocompleteHandlers();
        }

        // Remove item and recalculate total
        function removeItem(button) {
            button.closest('.form-row').remove();
            calculateTotal();
        }


        // Manual Part
        let manualItemCount = 1;

        // Add new budget item
        function addManualItem() {
            const itemContainer = document.createElement('div');
            itemContainer.classList.add('form-row', 'align-items-center', 'mb-3');
            itemContainer.innerHTML = `
                <div class="col-12 col-md-2 mb-2">
                    <input type="text" class="form-control manual-item-name" id="manual-item-name-${manualItemCount}" name="manual_services[${manualItemCount}][name]" placeholder="Service Name">
                </div>

                <div class="col-12 col-md-2 mb-2">
                    <select class="form-control" id="fund-type-${manualItemCount}" name="manual_services[${manualItemCount}][fund_type]">
                        <option selected disabled value="">Select Fund Type</option>
                        @foreach ($funds as $item)
                            <option class="capitalize text-capitalize" value="{{ $item->id }}">{{ $item->type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-2 mb-2">
                    <input type="number" class="form-control" id="manual-amount-${manualItemCount}" name="manual_services[${manualItemCount}][amount]" placeholder="Amount">
                </div>

                <div class="col-12 col-md-2 mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeManualItem(this)">
                        &times;
                    </button>
                </div>`;
            document.getElementById('manual-service-section').appendChild(itemContainer);
            manualItemCount++;
            calculateTotal();
        }

        // Remove item and recalculate total
        function removeManualItem(button) {
            button.closest('.form-row').remove();
            calculateTotal();
        }


        // Calculate total budget
        function calculateTotal() {
            let total = 0;
            // document.querySelectorAll('input[id^="amount-"]').forEach((input, index) => {
            //     const quantity = input.value;
            //     total += parseFloat(quantity);
            // });

            // Calculate total for both normal and manual services
            document.querySelectorAll('input[name$="[amount]"]').forEach((input) => {
                const quantity = input.value;
                if (quantity) {
                    total += parseFloat(quantity);
                }
            });

            document.getElementById('total_price_input').value = parseFloat(total).toFixed(2);
            // document.getElementById('total-price').innerText = parseFloat(total).toFixed(2);

            // Calculate payable amount
            const discount = document.getElementById('discount').value;
            const payable = total - (total * discount / 100);
            if (isNaN(payable) || payable < 0) {
                document.getElementById('payable').value = 0;
                return;
            }
            document.getElementById('payable').value = parseFloat(payable).toFixed(2);
        }


        function attachAutocompleteHandlerForPatientSearch() {
            document.getElementById('patient_info').addEventListener('input', function() {
                let query = this.value;
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('get-patients') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            const resultsContainer = document.querySelector('.autocomplete-results');
                            resultsContainer.innerHTML = '';
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block'; // Show the results box
                                data.forEach(function(item) {
                                    const resultItem = document.createElement('a');
                                    resultItem.classList.add('list-group-item',
                                        'list-group-item-action');
                                    resultItem.textContent = item.name;
                                    resultItem.dataset.id = item.id;
                                    resultItem.dataset.phone = item.phone;
                                    resultItem.href = '#';
                                    resultItem.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        fillPatientDetails(item.id, item.phone);
                                        resultsContainer.style.display =
                                            'none'; // Hide the results box
                                    });
                                    resultsContainer.appendChild(resultItem);
                                });
                            } else {
                                resultsContainer.style.display =
                                    'none'; // Hide the results box if no results
                            }
                        }
                    });
                } else {
                    const resultsContainer = document.querySelector('.autocomplete-results');
                    resultsContainer.style.display =
                        'none'; // Hide the results box if query is less than 3 characters
                    resultsContainer.innerHTML = '';
                }
            });
        }

        function fillPatientDetails(id, phone) {
            $.ajax({
                url: `/get-patient-details/${id}`,
                type: "GET",
                success: function(data) {
                    document.getElementById('customer_id').value = data.id;
                    document.getElementById('name').value = data.name;
                    document.getElementById('phone').value = data.mobile;
                    document.getElementById('discount').value = data.discount;
                    calculateTotal();
                }
            });
        }

        function attachAutocompleteHandlers() {
            document.querySelectorAll('.item-name').forEach((input) => {
                input.addEventListener('input', function() {
                    let query = this.value;
                    if (query.length >= 3) {
                        $.ajax({
                            url: "{{ route('get-services') }}",
                            type: "GET",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                const resultsContainer = input.nextElementSibling;
                                resultsContainer.innerHTML = '';
                                if (data.length > 0) {
                                    resultsContainer.style.display =
                                        'block'; // Show the results box
                                    data.forEach(function(item) {
                                        const resultItem = document.createElement('a');
                                        resultItem.classList.add('list-group-item',
                                            'list-group-item-action');
                                        resultItem.textContent = item.name;
                                        resultItem.dataset.id = item.id;
                                        resultItem.href = '#';
                                        resultItem.addEventListener('click', function(
                                            e) {
                                            e.preventDefault();
                                            fillServiceDetails(input, item.id,
                                                item.quantity);
                                            resultsContainer.style.display =
                                                'none'; // Hide the results box
                                        });
                                        resultsContainer.appendChild(resultItem);
                                    });
                                } else {
                                    resultsContainer.style.display =
                                        'none'; // Hide the results box if no results
                                }
                            }
                        });
                    } else {
                        const resultsContainer = input.nextElementSibling;
                        resultsContainer.style.display =
                            'none'; // Hide the results box if query is less than 3 characters
                        resultsContainer.innerHTML = '';
                    }
                });
            });
        }

        function fillServiceDetails(input, id, inventory) {
            $.ajax({
                url: `/get-service-details/${id}`,
                type: "GET",
                success: function(data) {
                    // console.log(data);
                    const row = input.closest('.form-row');
                    row.querySelector('input[name$="[primary_id]"]').value = data.id;
                    row.querySelector('input[name$="[name]"]').value = data.name;
                    row.querySelector('input[name$="[amount]"]').value = data.price;

                    calculateTotal();
                }
            });
        }


        // Initialize event listeners
        document.getElementById('invoice-form').addEventListener('input', calculateTotal);

        // Submit form
        function submitForm() {
            document.getElementById('invoice-form').submit();
        }

        attachAutocompleteHandlerForPatientSearch();
        attachAutocompleteHandlers();
    </script>

    <script>
        // // Initialize event listeners
        // document.getElementById('invoice-form').addEventListener('input', calculateTotal);

        // // Submit form
        // function submitForm() {
        //     document.getElementById('invoice-form').submit();
        // }
    </script>
@endpush
