@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Ambulance Driver</h2>
                <div class="">
                    <div class="">
                        <div class="p-4 card-body">
                            <h3 class="py-3 h3">Add Driver</h3>

                            <form action="{{ route('ambulance-driver.store') }}" method="POST">@csrf
                                <div class="row mb-4">
                                    <div class="col-md-3 form-group">
                                        <label for="add-name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="add-name" name="name" required>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="add-phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="add-phone" name="phone" required>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="add-nid" class="form-label">NID</label>
                                        <input type="text" class="form-control" id="add-nid" name="nid" required>
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="add-status" class="form-label">Status</label>
                                        <select class="form-control" id="add-status" name="status" required>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-address" class="form-label">Address</label>
                                        <textarea class="form-control" id="add-address" name="address"
                                                  required></textarea>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-remark" class="form-label">Remark</label>
                                        <textarea class="form-control" id="add-remark" name="remark"></textarea>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-12 p-4">
                            <h3 class="py-3 h3">Drivers</h3>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>NID</th>
                                <th>Status</th>
                                <th>Action</th>
                                </thead>

                                <tbody>
                                @foreach ($drivers as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->nid }}</td>
                                        <td class="capitalize">{{ $item->status }}</td>
                                        <td class="row mr-0">
                                            <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal"
                                                    data-target="#editDriverModal"
                                                    data-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}"
                                                    data-phone="{{ $item->phone }}"
                                                    data-address="{{ $item->address }}"
                                                    data-nid="{{ $item->nid }}"
                                                    data-status="{{ $item->status }}"
                                                    data-remark="{{ $item->remarks }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('ambulance-driver.destroy', $item->id) }}"
                                                  method="POST">@csrf @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-driver">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        <!-- Edit Ambulance Modal -->
                        <div class="modal fade" id="editDriverModal" tabindex="-1" role="dialog"
                             aria-labelledby="editDriverModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="editDriverModalLabel">Edit Driver</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('ambulance-driver.update', 'setID') }}"
                                              method="POST">@csrf @method('PUT')
                                            <input type="hidden" id="id" name="id" value="">
                                            <div class="row mb-4">
                                                <div class="col-md-6 form-group">
                                                    <label for="edit-name" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="edit-name" name="name"
                                                           required>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="edit-phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="edit-phone" name="phone"
                                                           required>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label for="edit-address" class="form-label">Address</label>
                                                    <textarea class="form-control" id="edit-address" name="address"
                                                              required></textarea>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="edit-nid" class="form-label">NID</label>
                                                    <input type="text" class="form-control" id="edit-nid" name="nid"
                                                           required>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="edit-status" class="form-label">Status</label>
                                                    <select class="form-control" id="edit-status" name="status"
                                                            required>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-12 form-group">
                                                    <label for="edit-remark" class="form-label">Remark</label>
                                                    <textarea class="form-control" id="edit-remark"
                                                              name="remark"></textarea>
                                                </div>

                                                <div class="col-auto md:mt-4 d-flex align-items-center">
                                                    <button  id="edit-submit-button" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
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

            $(document).on('click', '.delete-driver', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to delete this driver?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                })
            });
        });

        $('#editDriverModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let name = button.data('name');
            let phone = button.data('phone');
            let address = button.data('address');
            let nid = button.data('nid');
            let status = button.data('status');
            let remark = button.data('remark');

            let modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #edit-name').val(name);
            modal.find('.modal-body #edit-phone').val(phone);
            modal.find('.modal-body #edit-address').val(address);
            modal.find('.modal-body #edit-nid').val(nid);
            modal.find('.modal-body #edit-status').val(status);
            modal.find('.modal-body #edit-remark').val(remark);
        });


        // edit submit button onclick submit the form to a route with the id as a parameter
        $('#edit-submit-button').on('click', function () {
            let id = $('#id').val();
            let form = $('#editDriverModal form');
            let url = form.attr('action').replace('setID', id);
            form.attr('action', url);
            form.submit();
        });

    </script>
@endpush
