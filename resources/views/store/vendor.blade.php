@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Vendors</h2>
                <div class="p-4">
                    <div class="row">
                        <!-- Add Vendor -->
                        <div class="col-12 col-xl-5">
                            <div class="card">
                                <h3 class="card-header h3">Add Vendor</h3>
                                <div class="card-body">
                                    <form action="{{ route('store-vendor.store') }}" method="POST">@csrf
                                        <div class="row mb-4">
                                            <!-- Vendor Name -->
                                            <div class="col-md-6 mb-3">
                                                <label for="add-vendor-name" class="form-label">Vendor Name</label>
                                                <input type="text" id="add-vendor-name" name="name"
                                                       class="form-control">
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6 mb-3">
                                                <label for="add-vendor-email" class="form-label">Email</label>
                                                <input type="email" id="add-vendor-email" name="email"
                                                       class="form-control">
                                            </div>

                                            <!-- Phone Number -->
                                            <div class="col-md-6 mb-3">
                                                <label for="add-vendor-phone" class="form-label">Phone Number</label>
                                                <input type="text" id="add-vendor-phone" name="phone"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-auto md:mt-4 d-flex align-items-center">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-7">
                            <div class="card">
                                <h3 class="card-header h3">Vendor's List</h3>
                                <div class="p-3">
                                    <table class="table table-bordered table-striped" id="classList">
                                        <thead>
                                        <tr>
                                            <th>Vendor ID</th>
                                            <th>Vendor Name</th>
                                            <th>Phone Number</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($vendors as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td class="d-md-flex">
                                                    <button type="button" class="btn btn-sm btn-success mr-2"
                                                            data-toggle="modal"
                                                            data-target="#editVendorModal" data-id="{{ $item->id }}"
                                                            data-name="{{ $item->name }}"
                                                            data-email="{{ $item->email }}"
                                                            data-phone="{{ $item->phone }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger delete-vendor"
                                                            data-id="{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- Edit Vendor Modal -->
                            <div class="modal fade" id="editVendorModal" tabindex="-1" role="dialog"
                                 aria-labelledby="editVendorModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="h3" id="editVendorModalLabel">Update Vendor</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form id="vendorForm" action="" method="POST">@csrf @method('PUT')
                                                <div class="row mb-4">
                                                    <!-- Update Vendor Name -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="edit-vendor-name" class="form-label">Vendor
                                                            Name</label>
                                                        <input type="text" id="edit-vendor-name" name="name"
                                                               class="form-control">
                                                    </div>

                                                    <!-- Update Email -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="edit-vendor-email" class="form-label">Email</label>
                                                        <input type="email" id="edit-vendor-email" name="email"
                                                               class="form-control">
                                                    </div>

                                                    <!-- Update Phone Number -->
                                                    <div class="col-md-6 mb-3">
                                                        <label for="edit-vendor-phone" class="form-label">Phone
                                                            Number</label>
                                                        <input type="text" id="edit-vendor-phone" name="phone"
                                                               class="form-control">
                                                    </div>

                                                </div>
                                                <div class="col-auto md:mt-4 d-flex align-items-center">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        $('#editVendorModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let name = button.data('name');
            let email = button.data('email');
            let phone = button.data('phone');
            let address = button.data('address');
            let category = button.data('category');
            let website = button.data('website');
            let status = button.data('status');

            let modal = $(this);
            modal.find('.modal-body #edit-vendor-name').val(name);
            modal.find('.modal-body #edit-vendor-email').val(email);
            modal.find('.modal-body #edit-vendor-phone').val(phone);
            modal.find('.modal-body #edit-vendor-address').val(address);
            modal.find('.modal-body #edit-vendor-category').val(category);
            modal.find('.modal-body #edit-vendor-website').val(website);
            modal.find('.modal-body #edit-vendor-status').val(status);

            let form = document.getElementById('vendorForm');
            form.action = "store-vendor/" + id;
        });


        $(document).on('click', '.delete-vendor', function () {
            let form = $(this).closest('form');
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this vendor!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "store-vendor/" + id,
                        type: 'DELETE',
                        data: {
                            id: id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (response.status) {
                                Swal.fire(
                                    'Deleted!',
                                    'Vendor has been deleted.',
                                    'success'
                                );
                                // console.log(response);
                                location.reload();
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        }
                    });
                }
            })
        });
    </script>
@endpush
