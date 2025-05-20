@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .autocomplete-results {
            position: absolute;
            z-index: 1000;
            background-color: white;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            padding-right: 14px;
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
            <div>
                <div class="card">
                    <h2 class="card-header h2 font-weight-bold">Return Product</h2>
                    <div class="card-body">
                        <form action="{{ route('store.return-product') }}" method="POST"> @csrf
                            <div class="row g-3">
                                <!--Product ID-->
                                <div class="col-md-4 mb-4">
                                    <label for="product_name" class="form-label">Product ID</label>
                                    <input type="text" id="product_name" name="product_id" class="form-control"
                                           placeholder="Product ID" required/>
                                    <div class="autocomplete-results list-group"></div>
                                </div>

                                <!--Department-->
                                <div class="col-md-4 mb-4">
                                    <label for="department"
                                           class="mb-2 d-block font-weight-bold text-gray-700">Department</label>
                                    <select name="department_id" id="department" class="form-control" required>
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!--Quantity-->
                                <div class="col-md-4 mb-4">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" id="qty" name="quantity" class="form-control" value="1"
                                           placeholder="Quantity" required/>
                                </div>

                                <!--Reason-->
                                <div class="col-md-4 mb-4">
                                    <label for="reason" class="form-label">Reason</label>
                                    <textarea id="reason" name="reason" class="form-control" placeholder="Reason"
                                              required></textarea>
                                </div>


                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Return</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{--                <div class="text-center font-bold mt-8">--}}
                {{--                    <h1>Or</h1>--}}
                {{--                </div>--}}

                {{--                <div class="container mt-8">--}}
                {{--                    <div class="container mx-auto rounded border p-4 shadow-lg bg-white">--}}
                {{--                        <h2 class="py-3 h2 font-weight-bold">Exchange Product</h2>--}}
                {{--                        <form action="{{ route('store.exchange-product') }}" method="POST"> @csrf--}}
                {{--                            <div class="row align-items-center p-3">--}}
                {{--                                <div class="col-12 col-lg-5 row g-3">--}}
                {{--                                    <!--Product ID-->--}}
                {{--                                    <div class="col-12 mb-4 mr-2">--}}
                {{--                                        <label for="current-product-id" class="form-label">Current Product ID</label>--}}
                {{--                                        <input type="text" id="current-product-id" name="current_product_id"--}}
                {{--                                               class="form-control"--}}
                {{--                                               placeholder="Current Product ID"/>--}}
                {{--                                    </div>--}}

                {{--                                    <!--Department-->--}}
                {{--                                    <div class="col-12 mb-4 mr-2">--}}
                {{--                                        <label for="current-department"--}}
                {{--                                               class="mb-2 d-block font-weight-bold text-gray-700">Department</label>--}}
                {{--                                        <select name="department" id="department" class="form-control" required>--}}
                {{--                                            <option value="">Select Department</option>--}}
                {{--                                            @foreach($departments as $department)--}}
                {{--                                                <option value="{{ $department->id }}">{{ $department->name }}</option>--}}
                {{--                                            @endforeach--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}

                {{--                                    <!--Quantity-->--}}
                {{--                                    <div class="col-12 mb-4 mr-2">--}}
                {{--                                        <label for="qty-current-exc" class="form-label">Quantity</label>--}}
                {{--                                        <input type="number" id="qty-current-exc" name="quantity" class="form-control"--}}
                {{--                                               placeholder="Quantity" required/>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-12 col-lg-2 px-4 my-2 text-center"><i class="fas fa-exchange-alt"></i>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-12 col-lg-5 row g-3">--}}
                {{--                                    <!--Product ID-->--}}
                {{--                                    <div class="col-12 mb-4 mr-2">--}}
                {{--                                        <label for="exchange-product-id" class="form-label">Exchange Product ID</label>--}}
                {{--                                        <input type="text" id="exchange-product-id" name="exchange_product_id"--}}
                {{--                                               class="form-control"--}}
                {{--                                               placeholder="Exchange Product ID" readonly/>--}}
                {{--                                    </div>--}}

                {{--                                    <!--Product Name-->--}}
                {{--                                    <div class="col-12 mb-4">--}}
                {{--                                        <label for="exchange-product_name" class="form-label">Exchange Product--}}
                {{--                                            Name</label>--}}
                {{--                                        <input type="text" id="exchange-product_name" name="exchange_name"--}}
                {{--                                               class="form-control"--}}
                {{--                                               placeholder="Exchange Product Name" required/>--}}
                {{--                                        <div class="autocomplete-results-exchange-product list-group"></div>--}}
                {{--                                    </div>--}}
                {{--                                    <!--Quantity-->--}}
                {{--                                    <div class="col-12 mb-4 mr-2">--}}
                {{--                                        <label for="qty-new-exc" class="form-label">Quantity</label>--}}
                {{--                                        <input type="number" id="qty-new-exc" name="quantity" class="form-control"--}}
                {{--                                               placeholder="Quantity" required/>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="px-3">--}}
                {{--                                <button type="submit" class="btn btn-primary">Exchange</button>--}}
                {{--                            </div>--}}
                {{--                        </form>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="card">
                    <h3 class="card-header h3">Returned Product</h3>

                    <div class="p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="low-inventory">
                                <thead>
                                <th>Date</th>
                                <th>Product ID</th>
                                <th>Department</th>
                                <th>Quantity</th>
                                <th>Remarks</th>
                                </thead>


                                <tbody>
                                @foreach ($returnedProducts as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->return_date)->format('d-m-Y') }}</td>
                                        <td>{{ $item->product_id }}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->reason }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(function () {
            $("#low-inventory").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        function attachAutocompleteHandlerForProductSearch() {
            document.getElementById('product_name').addEventListener('input', function () {
                let query = this.value;
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('get-products') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function (data) {
                            console.log(data);
                            const resultsContainer = document.querySelector('.autocomplete-results');
                            resultsContainer.innerHTML = '';
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block'; // Show the results box
                                data.forEach(function (item) {
                                    const a = document.createElement('a');
                                    a.href = '#';
                                    a.textContent = item.name;
                                    a.classList.add('list-group-item');
                                    a.addEventListener('click', function () {
                                        document.getElementById('product-id').value = item.id;
                                        document.getElementById('department-id').value = item.department_id;
                                        document.getElementById('product_name').value = item.name;
                                        document.getElementById('department').value = item.department.name;
                                        resultsContainer.style.display = 'none';
                                    });
                                    resultsContainer.appendChild(a);
                                });
                            } else {
                                resultsContainer.style.display = 'none'; // Hide the results box if no results
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

        attachAutocompleteHandlerForProductSearch();
    </script>

    <script>
        function attachAutocompleteHandlerForExchangeProductSearch() {
            document.getElementById('current-product_name').addEventListener('input', function () {
                let query = this.value;
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('get-products') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function (data) {
                            console.log(data);
                            const resultsContainer = document.querySelector('.autocomplete-results-current-product');
                            resultsContainer.innerHTML = '';
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block'; // Show the results box
                                data.forEach(function (item) {
                                    const a = document.createElement('a');
                                    a.href = '#';
                                    a.textContent = item.name;
                                    a.classList.add('list-group-item');
                                    a.addEventListener('click', function () {
                                        document.getElementById('current-product-id').value = item.product_id;
                                        document.getElementById('current-product_name').value = item.name;
                                        resultsContainer.style.display = 'none';
                                    });
                                    resultsContainer.appendChild(a);
                                });
                            } else {
                                resultsContainer.style.display = 'none'; // Hide the results box if no results
                            }
                        }
                    });
                } else {
                    const resultsContainer = document.querySelector('.autocomplete-results-current-product');
                    resultsContainer.style.display =
                        'none'; // Hide the results box if query is less than 3 characters
                    resultsContainer.innerHTML = '';
                }
            });
        }

        attachAutocompleteHandlerForExchangeProductSearch();
    </script>

    <script>
        function attachAutocompleteHandlerForExchangeProductSearch() {
            document.getElementById('exchange-product_name').addEventListener('input', function () {
                let query = this.value;
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('get-products') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function (data) {
                            console.log(data);
                            const resultsContainer = document.querySelector('.autocomplete-results-exchange-product');
                            resultsContainer.innerHTML = '';
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block'; // Show the results box
                                data.forEach(function (item) {
                                    const a = document.createElement('a');
                                    a.href = '#';
                                    a.textContent = item.name;
                                    a.classList.add('list-group-item');
                                    a.addEventListener('click', function () {
                                        document.getElementById('exchange-product-id').value = item.product_id;
                                        document.getElementById('exchange-product_name').value = item.name;
                                        resultsContainer.style.display = 'none';
                                    });
                                    resultsContainer.appendChild(a);
                                });
                            } else {
                                resultsContainer.style.display = 'none'; // Hide the results box if no results
                            }
                        }
                    });
                } else {
                    const resultsContainer = document.querySelector('.autocomplete-results-exchange-product');
                    resultsContainer.style.display =
                        'none'; // Hide the results box if query is less than 3 characters
                    resultsContainer.innerHTML = '';
                }
            });
        }

        attachAutocompleteHandlerForExchangeProductSearch();
    </script>

@endpush
