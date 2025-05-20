@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="card">
                    <h2 class="card-header h2 font-weight-bold">Update Existing Product</h2>
                    <div class="p-4">
                        <form action="" method="GET">
                            <div class="row mb-4">
                                <div class="col-md-4 mb-3">
                                    <label for="product_id" class="form-label">Search by Product ID</label>
                                    <input type="text" name="id" id="product_id" class="form-control "
                                           placeholder="Product ID"/>
                                </div>

                                <div class="col-auto d-flex align-items-center mt-md-4">
                                    <p class="text-gray-600 mx-4">OR</p>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="product_name" class="form-label">Search by Product Name</label>
                                    <input type="text" name="name" id="product_name" class="form-control"
                                           placeholder="Product Name"/>
                                </div>

                                <div class="col-auto mt-md-3 d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Vendor</th>
                                <th>Qty</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @if (isset($products))
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $item->product_id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->vendor->name ?? '---' }}</td>
                                            <td>{{ $item->inventory->quantity ?? '---' }}</td>
                                            <td>
                                                <button data-toggle="modal" data-target="#show-editModal"
                                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                        data-qty="{{ $item->inventory->quantity }}"
                                                        data-price="{{ $item->price }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-center font-bold mt-8">
                    <h1>Or</h1>
                </div>

                <div class="card mt-4">
                    <h2 class="card-header h2 font-weight-bold">Add New Product</h2>
                    <div class="card-body">
                        <form action="{{ route('store.add-new-product') }}" method="POST"> @csrf
                            <div class="row g-3">
                                <div class="col-md-4 mb-4">
                                    <label for="department"
                                           class="mb-2 d-block font-weight-bold text-gray-700">Department</label>
                                    <select id="department" class="form-control mw200" name="department_id">
                                        <option selected>Choose a Department</option>
                                        @foreach ($store_departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label class="mb-2 d-block font-weight-bold text-gray-700" for="item_type">Item
                                        Type</label>
                                    <select name="item_type_id" id="item_type" class="form-control mw200">
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

                                <div class="col-md-4 mb-4">
                                    <label for="product_name" class="form-label">Product Name</label>
                                    <input type="text" id="product_name" name="name" class="form-control"
                                           placeholder="Product Name" required/>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" id="qty" name="quantity" class="form-control"
                                           placeholder="Quantity" required/>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="unit_price" class="form-label">Unit Price</label>
                                    <input type="number" id="unit_price" name="price" class="form-control"
                                           placeholder="Unit Price" required/>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="unit_price" class="form-label">Vendor</label>
                                    {{-- select --}}
                                    <select name="vendor_id" id="vendor_id" class="form-control">
                                        <option selected disabled>Select Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <label for="minimum_quantity" class="form-label">Minimum Quantity Before
                                        Warning</label>
                                    <input type="number" id="minimum_quantity" name="minimum_quantity"
                                           class="form-control"
                                           placeholder="Minimum Quantity" required/>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- <div class="container mt-8">
                    <div class="container mx-auto rounded border bg-white p-4 shadow-lg">
                        <h2 class="py-3 text-3xl font-bold text-gray-800">Update Department and Item Type</h2>
                        <form action="">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <label for="department_name" class="form-label me-3">Department</label>
                                        <button class="btn btn-outline-secondary btn-sm">+</button>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <input type="text" id="department_name" class="form-control me-3" />
                                        <button class="btn btn-outline-secondary btn-sm">-</button>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <label for="item_type" class="form-label me-3">Item Type</label>
                                        <button class="btn btn-outline-secondary btn-sm">+</button>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <input type="text" id="item_type" class="form-control me-3" />
                                        <button class="btn btn-outline-secondary btn-sm">-</button>
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="show-editModal" tabindex="-1" role="dialog" aria-labelledby="showEditModal"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('store.update-product') }}" method="POST">@csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="h3">Add New Lot</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="hidden" id="edit_product_id" class="form-control" name="id"
                                           value="5"/>
                                    <label for="edit_product_name" class="form-label">Product Name</label>
                                    <input type="text" id="edit_product_name" class="form-control"
                                           placeholder="Product Name" readonly/>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_qty" class="form-label">Quantity*</label>
                                    <input type="number" id="edit_qty" class="form-control" placeholder="Quantity"
                                           name="quantity" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_qty" class="form-label">Expire Date*</label>
                                    <input type="date" id="edit_qty" class="form-control" placeholder="Expire Date"
                                           name="expire_date" required/>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_price" class="form-label">Price per Item*</label>
                                    <input type="number" id="edit_price" class="form-control" placeholder="Price"
                                           name="price" required/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
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

        $(document).ready(function () {
            $('#vendor_id').select2();
        });

        $('#show-editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');


            // Update the modal's content.
            let modal = $(this);
            modal.find('.modal-body input[name="id"]').val(id);
            modal.find('#edit_product_name').val(name);


        });
    </script>
@endpush
