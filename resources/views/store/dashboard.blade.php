@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .mw200 {
            max-width: 200px;
        }

        .btn-check {
            background-color: #02991e67;
            color: white;
            border: none;
            padding: 0.3rem .5rem;
            border-radius: .25rem;
            font-size: 0.5rem;
            line-height: 1.5;
        }

        .bg-danger-light {
            background-color: #f8d7da;
        }

        .bg-warning-light {
            background-color: #fff3cd;
        }

        .bg-success-light {
            background-color: #d4edda;
        }

        .bg-primary-light {
            background-color: #d1ecf1;
        }

        .font-semibold {
            font-weight: 600;
        }

        .value-card {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.39;
        }
    </style>

    <div class="content-wrapper">
        <section class="content">

            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Store Dashboard</h2>

                <div class="row mb-4 p-3">
                    <!-- Card 1 -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="rounded-lg bg-danger-light p-3 shadow">
                            <h3 class="mb-2 h5">Total Departments</h3>
                            <p class="h3 font-weight-bold text-danger">15</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="rounded-lg bg-primary-light p-3 shadow">
                            <h3 class="mb-2 h5">Total Products</h3>
                            <p class="h3 font-weight-bold text-primary">2353</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="rounded-lg bg-success-light p-3 shadow">
                            <h3 class="mb-2 h5">New Requests</h3>
                            <p class="h3 font-weight-bold text-success">2</p>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="rounded-lg bg-warning-light p-3 shadow">
                            <h3 class="mb-2 h5">Total Value</h3>
                            <p class="value-card text-warning"><span class="taka-large">&#2547;</span>45,678</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3 class="card-header h3">Store Item</h3>

                <div class="p-3">
                    <div class="pl-3">
                        <form action="" method="GET" class="row mb-4">
                            <div class="mr-4 mb-2">
                                <label class="mb-2 d-block font-weight-bold text-gray-700"
                                       for="department">Department</label>
                                <select name="department" id="department" class="form-control mw200">
                                    <option selected disabled>Select Department</option>
                                    @foreach ($store_departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="mb-2 d-block font-weight-bold text-gray-700" for="item_type">Item
                                    Type</label>
                                <select name="item_type" id="item_type" class="form-control mw200">
                                    <option selected disabled>Select Item Type</option>

                                </select>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    $('#department').on('change', function () {
                                        let department_id = $(this).val();
                                        if (department_id) {
                                            $.ajax({
                                                url: '/get-item-type/' + department_id,
                                                type: 'GET',
                                                dataType: 'json',
                                                success: function (data) {

                                                    $('#item_type').empty();
                                                    $('#item_type').append(
                                                        '<option selected disabled>Select Item Type</option>');
                                                    $.each(data, function (key, value) {
                                                        $('#item_type').append('<option value="' + value.id +
                                                            '">' +
                                                            value.name + '</option>');
                                                    });
                                                }
                                            });
                                        } else {
                                            $('#item_type').empty();
                                        }
                                    });
                                });
                            </script>


                            <div class="row ml-2 md:ml-4 d-flex align-items-center mt-4">
                                <div class="mr-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>

                                <div class="">
                                    <a href="{{ url()->current() }}" class="btn btn-primary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>Product ID</th>
                                <th>Name</th>
                                {{-- <th>Image</th> --}}
                                <th>Qty</th>
                                </thead>

                                <tbody>
                                @if (isset($products))
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->product_id }}</td>
                                            <td>{{ $product->name }}</td>
                                            {{-- <td><img src="{{ $product->image }}" alt="{{ $product->name }}" class="mw200"></td> --}}
                                            <td>{{ $product->inventory->quantity }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Showing Edit -->
            <div class="modal fade" id="show-edit-modal" tabindex="-1" role="dialog" aria-labelledby="showEditModal"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-xl font-semibold" id="showEditModal">Edit Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control"
                                           placeholder="Quantity">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Material Requests --}}
            <div class="card">
                <h3 class="card-header h3">Material Requests</h3>

                <div class="p-4">
                    <div class="mb-4 d-flex justify-content-end">
                        <button data-toggle="modal" data-target="#show-add-modal" class="btn btn-primary">Add New
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="classList2">
                            <thead>
                            <th>Request ID</th>
                            <th>Requested From</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>In Stock</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Action</th>
                            </thead>


                            <tbody>
                            @foreach ($requests as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="capitalize">{{ $item->requested_from }}</td>
                                    <td>{{ $item->product->product_id }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->product->inventory->quantity }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="capitalize">{{ $item->status }}</td>
                                    @if ($item->product->inventory->quantity <= $item->quantity)
                                        <td style="color: #b3002d;">
                                            <form action="{{ route('store.response-to-request') }}" method="POST">@csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="flex items-center gap-2 font-bold">
                                                    <p> Low Stock</p>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                {{--                                        <button data-toggle="modal" data-target="#cancel-reason-modal"> --}}
                                                {{--                                            <i class="fas fa-trash"></i> --}}
                                                {{--                                        </button> --}}
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <form action="{{ route('store.response-to-request') }}" method="POST">@csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <select name="status">
                                                    <option value="pending">Pending</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                                <button type="submit" class="btn-check btn-primary">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                {{--                                        <button data-toggle="modal" data-target="#cancel-reason-modal"> --}}
                                                {{--                                            <i class="fas fa-trash"></i> --}}
                                                {{--                                        </button> --}}
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                    <!-- Modal for Showing Add -->
                    <div class="modal fade" id="show-add-modal" tabindex="-1" role="dialog"
                         aria-labelledby="showAddModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-xl font-semibold" id="showAddModal">New Material
                                        Request</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('store.add-request-item') }}" method="POST"> @csrf
                                        <div class="form-group">
                                            <label for="add-req-from-department">Requested From</label>
                                            <select name="requested_from" id="add-req-from-department"
                                                    class="form-control">
                                                <option selected disabled>Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option
                                                        value="{{ $department->name }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="add-req-department">Department</label>
                                            <select name="department" id="add-req-department" class="form-control">
                                                <option selected disabled>Select Department</option>
                                                @foreach ($store_departments as $department)
                                                    <option
                                                        value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="add-req-item-type">Item Type</label>
                                            <select name="item_type" id="add-req-item-type" class="form-control">
                                                <option selected disabled>Select Department First</option>
                                            </select>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('#add-req-department').on('change', function () {
                                                    let department_id = $(this).val();
                                                    if (department_id) {
                                                        $.ajax({
                                                            url: '/get-item-type/' + department_id,
                                                            type: 'GET',
                                                            dataType: 'json',
                                                            success: function (data) {

                                                                $('#add-req-item-type').empty();
                                                                $('#add-req-item-type').append(
                                                                    '<option selected disabled>Select Item Type</option>');
                                                                $.each(data, function (key, value) {
                                                                    $('#add-req-item-type').append('<option value="' + value
                                                                            .id + '">' +
                                                                        value.name + '</option>');
                                                                });
                                                            }
                                                        });
                                                    } else {
                                                        $('#add-req-item-type').empty();
                                                    }
                                                });
                                            });
                                        </script>

                                        <div class="form-group">
                                            <label for="add-req-item">Item</label>
                                            <select name="item" id="add-req-item" class="form-control">
                                                <option selected disabled>Select Item Type First</option>
                                            </select>
                                        </div>
                                        <script>
                                            $(document).ready(function () {
                                                $('#add-req-item-type').on('change', function () {
                                                    let item_type_id = $(this).val();
                                                    if (item_type_id) {
                                                        $.ajax({
                                                            url: '/get-item/' + item_type_id,
                                                            type: 'GET',
                                                            dataType: 'json',
                                                            success: function (data) {

                                                                $('#add-req-item').empty();
                                                                $('#add-req-item').append(
                                                                    '<option selected disabled>Select Item</option>');
                                                                $.each(data, function (key, value) {
                                                                    $('#add-req-item').append('<option value="' + value.id +
                                                                        '">' +
                                                                        value.name + '</option>');
                                                                });
                                                            }
                                                        });
                                                    } else {
                                                        $('#add-req-item').empty();
                                                    }
                                                });
                                            });
                                        </script>

                                        <div class="form-group">
                                            <label for="add-req-quantity">Quantity</label>
                                            <input type="number" name="quantity" id="add-req-quantity"
                                                   class="form-control"
                                                   placeholder="Quantity">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Showing Cancel Reason -->
                    <div class="modal fade" id="cancel-reason-modal" tabindex="-1" role="dialog"
                         aria-labelledby="cancelReasonModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-xl font-semibold" id="cancelReasonModal">Cancel
                                        Reason</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="cancel_reason">Reason</label>
                                            <textarea name="cancel_reason" id="cancel_reason" class="form-control"
                                                      placeholder="Reason"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger">OK</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Low Inventory --}}
            <div class="card">
                <h3 class="card-header h3">Low Inventory</h3>

                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="low-inventory">
                            <thead>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>In Stock</th>
                            </thead>


                            <tbody>
                            @foreach ($lowInventory as $item)
                                <tr>
                                    <td>{{ $item->product_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->inventory->quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(function () {
            $("#classList2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
        $(function () {
            $("#low-inventory").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "filter": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
