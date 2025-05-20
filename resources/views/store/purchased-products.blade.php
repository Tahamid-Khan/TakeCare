@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content">
            <div class="container py-5">
                <div class="container mx-auto rounded border p-4 shadow-lg bg-white">
                    <h2 class="py-3 text-3xl font-bold text-gray-800">Purchased Items</h2>
                    <form id="invoice-form" class="bg-white p-4 rounded shadow"
                          action="{{ route('store.purchased-invoice') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="name" class="font-semibold text-gray-700">Name*</label>
                                    <input type="text" class="form-control" id="name" name="customer[name]"
                                           placeholder="Customer Name" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="phone" class="font-semibold text-gray-700">Phone*</label>
                                    <input type="tel" class="form-control" id="phone" name="customer[phone]"
                                           placeholder="Phone Number" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="address" class="font-semibold text-gray-700">Address</label>
                                    <input type="text" class="form-control" id="address" name="customer[address]"
                                           placeholder="Address">
                                </div>
                            </div>
                        </div>

                        <div id="products-section">
                            <div class="form-row align-items-center mb-3">
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="" class="">Product Name</label>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="" class="">Product ID</label>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="" class="">Quantity</label>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="" class="">Unit Price</label>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="" class="">Total</label>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                </div>
                            </div>
                            <div class="form-row align-items-center mb-3">
                                <input type="hidden" name="products[0][primary_id]" value="">
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="product-name-0" class="sr-only">Product Name</label>
                                    <input type="text" class="form-control product-name" id="product-name-0"
                                           name="products[0][name]" placeholder="Search by name or ID">
                                    <div class="autocomplete-results"></div>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="product-id-0" class="sr-only">Product ID</label>
                                    <input type="text" class="form-control" id="product-id-0" name="products[0][id]"
                                           placeholder="Product ID" readonly>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="quantity-0" class="sr-only">Quantity</label>
                                    <input type="number" class="form-control" id="quantity-0"
                                           name="products[0][quantity]" placeholder="Quantity">
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="price-0" class="sr-only">Unit Price</label>
                                    <input type="number" class="form-control" id="price-0" name="products[0][price]"
                                           placeholder="Price">
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="total-0" class="sr-only">Total</label>
                                    <input type="number" class="form-control" id="total-0" name="products[0][total]"
                                           placeholder="Total" readonly>
                                </div>
                                <div class="col-12 col-md-2 mb-2">
                                    <button type="button" class="btn btn-danger" onclick="removeProduct(this)">
                                        &times;
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary mb-4" onclick="addProduct()">Add Product</button>

                        <div class="mb-4">
                            <h2 class="h4 mb-3">Invoice Details</h2>
                            <div id="invoice-details">
                                <!-- Dynamic list of products will be displayed here -->
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3 class="h5 mb-2">Total Price: <span id="total-price">0</span></h3>
                        </div>
                        <input type="hidden" name="total" id="total_price_input" value="0">
                        <button type="button" onclick="submitForm()" class="btn btn-success">Save & Print Invoice
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('custom_css')
    <style>
        .autocomplete-results {
            position: absolute;
            z-index: 1000;
            background-color: white;
            border: 1px solid #ccc;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            display: none; /* Initially hidden */
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
@endpush
@push('custom_js')
    <script>
        function submitForm() {
            // check name, phone is not empty
            if (document.getElementById('name').value.trim() === '') {
                alert('Please enter customer name');
                return;
            }
            if (document.getElementById('phone').value.trim() === '') {
                alert('Please enter customer phone number');
                return;
            }
            document.getElementById('invoice-form').submit();
            // reload the page after 2 seconds
            setTimeout(() => {
                location.reload();
            }, 2000);
        }

        let productCount = 1;

        function addProduct() {
            const productSection = document.getElementById('products-section');
            const newProductRow = document.createElement('div');
            newProductRow.classList.add('form-row', 'align-items-center', 'mb-3');

            newProductRow.innerHTML = `
            <input type="hidden" name="products[${productCount}][primary_id]" value="">
            <div class="col-12 col-md-2 mb-2">
                <label for="product-name-${productCount}" class="sr-only">Product</label>
                <input type="text" class="form-control product-name" id="product-name-${productCount}" name="products[${productCount}][name]"
                    placeholder="Search by name or ID">
                <div class="autocomplete-results"></div>
            </div>
            <div class="col-12 col-md-2 mb-2">
                <label for="product-id-${productCount}" class="sr-only">Product ID</label>
                <input type="text" class="form-control" id="product-id-${productCount}" name="products[${productCount}][id]"
                    placeholder="Product ID" readonly>
            </div>
            <div class="col-12 col-md-2 mb-2">
                <label for="quantity-${productCount}" class="sr-only">Quantity</label>
                <input type="number" class="form-control quantity" id="quantity-${productCount}" name="products[${productCount}][quantity]"
                    placeholder="Quantity">
            </div>
            <div class="col-12 col-md-2 mb-2">
                <label for="price-${productCount}" class="sr-only">Price</label>
                <input type="number" class="form-control" id="price-${productCount}" name="products[${productCount}][price]"
                    placeholder="Price">
            </div>
            <div class="col-12 col-md-2 mb-2">
                <label for="total-${productCount}" class="sr-only">Total</label>
                <input type="number" class="form-control" id="total-${productCount}" name="products[${productCount}][total]"
                    placeholder="Total" readonly>
            </div>
            <div class="col-12 col-md-2 mb-2">
                <button type="button" class="btn btn-danger" onclick="removeProduct(this)">
                    &times;
                </button>
            </div>
        `;

            productSection.appendChild(newProductRow);
            productCount++;
            attachAutocompleteHandlers();
            attachQuantityValidationHandlers(); // Attach validation handlers to new quantity inputs
        }

        function removeProduct(button) {
            button.closest('.form-row').remove();
            calculateTotal();
        }

        function calculateTotal() {
            let totalPrice = 0;
            document.querySelectorAll('input[id^="price-"]').forEach((input, index) => {
                const quantity = document.getElementById(`quantity-${index}`).value;
                const price = input.value;
                const total = quantity * price;
                document.getElementById(`total-${index}`).value = parseFloat(total).toFixed(2);
                totalPrice += total;
            });
            document.getElementById('total-price').innerText = parseFloat(totalPrice).toFixed(2);
            document.getElementById('total_price_input').value = parseFloat(totalPrice).toFixed(2);
        }

        document.getElementById('invoice-form').addEventListener('input', calculateTotal);

        function attachAutocompleteHandlers() {
            document.querySelectorAll('.product-name').forEach((input) => {
                input.addEventListener('input', function () {
                    let query = this.value;
                    if (query.length >= 3) {
                        $.ajax({
                            url: "{{ route('store.search-product') }}",
                            type: "GET",
                            data: {query: query},
                            success: function (data) {
                                const resultsContainer = input.nextElementSibling;
                                resultsContainer.innerHTML = '';
                                if (data.length > 0) {
                                    resultsContainer.style.display = 'block'; // Show the results box
                                    data.forEach(function (item) {
                                        const resultItem = document.createElement('a');
                                        resultItem.classList.add('list-group-item', 'list-group-item-action');
                                        resultItem.textContent = item.name;
                                        resultItem.dataset.id = item.id;
                                        resultItem.dataset.quantity = item.quantity; // Add inventory quantity to data attribute
                                        resultItem.href = '#';
                                        resultItem.addEventListener('click', function (e) {
                                            e.preventDefault();
                                            fillProductDetails(input, item.id, item.quantity);
                                            resultsContainer.style.display = 'none'; // Hide the results box
                                        });
                                        resultsContainer.appendChild(resultItem);
                                    });
                                } else {
                                    resultsContainer.style.display = 'none'; // Hide the results box if no results
                                }
                            }
                        });
                    } else {
                        const resultsContainer = input.nextElementSibling;
                        resultsContainer.style.display = 'none'; // Hide the results box if query is less than 3 characters
                        resultsContainer.innerHTML = '';
                    }
                });
            });
        }

        function fillProductDetails(input, id, inventory) {
            $.ajax({
                url: `/product-details/${id}`,
                type: "GET",
                success: function (data) {
                    const row = input.closest('.form-row');
                    row.querySelector('input[name$="[name]"]').value = data.name;
                    row.querySelector('input[name$="[id]"]').value = data.product_id;
                    row.querySelector('input[name$="[primary_id]"]').value = data.id;
                    row.querySelector('input[name$="[price]"]').value = data.price;
                    row.querySelector('input[name$="[total]"]').value = parseFloat(data.price * row.querySelector('input[name$="[quantity]"]').value).toFixed(2);
                    row.querySelector('input[name$="[quantity]"]').dataset.inventory = inventory; // Set inventory quantity as data attribute
                    calculateTotal();
                }
            });
        }

        function attachQuantityValidationHandlers() {
            document.querySelectorAll('.quantity').forEach((input) => {
                input.addEventListener('input', function () {
                    const inventory = this.dataset.inventory;
                    const quantity = this.value;
                    if (parseInt(quantity) > parseInt(inventory)) {
                        alert(`The selected quantity (${quantity}) exceeds the available stock (${inventory}).`);
                        this.value = inventory;
                    }
                    calculateTotal();
                });
            });
        }

        attachAutocompleteHandlers();
        attachQuantityValidationHandlers(); // Attach validation handlers initially
    </script>
@endpush


