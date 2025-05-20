@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Ambulance</h2>
                <div class="">
                    <div class="">
                        <div class="p-4 card-body">
                            <h3 class="py-3 h3">Add Ambulance</h3>

                            <form action="{{ route('ambulance.store') }}" method="POST">@csrf
                                <div class="row mb-4">
                                    <div class="col-md-4 form-group">
                                        <label for="add-car_number" class="form-label">Ambulance Number</label>
                                        <input type="text" class="form-control" id="add-car_number" name="car_number">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="add-contact_number" class="form-label">Contact No</label>
                                        <input type="text" class="form-control" id="add-contact_number"
                                            name="contact_number">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-driver_id" class="form-label">Driver</label>
                                        <select class="form-control" id="add-driver_id" name="driver_id">
                                            <option disabled>Select Driver</option>
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-type" class="form-label">Type</label>
                                        <select class="form-control" id="add-type" name="type">
                                            <option value="">Select Type</option>
                                            <option value="external">External</option>
                                            <option value="internal">Internal</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-category" class="form-label">Category</label>
                                        <select class="form-control" id="add-category" name="category">
                                            <option value="">Select Category</option>
                                            <option value="basic">Basic</option>
                                            <option value="basic_o2">Basic O2</option>
                                            <option value="icu">ICU</option>
                                            <option value="freezer">Freezer</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-status" class="form-label">Status</label>
                                        <select class="form-control" id="add-status" name="status">
                                            <option value="">Select Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>


                                    <div class="col-auto md:mt-4 d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-12 p-4">
                            <h3 class="py-3 h3">Ambulance List</h3>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                    <th>SL</th>
                                    <th>Ambulance Number</th>
                                    <th>Contact No</th>
                                    <th>Driver</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($ambulances as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->car_number }}</td>
                                            <td>{{ $item->contact_number }}</td>
                                            <td class="capitalize">{{ $item->driver->name }}</td>
                                            <td class="capitalize">{{ $item->type }}</td>
                                            <td class="capitalize">{{ str_replace('_', ' ', $item->category) }}</td>
                                            <td class="capitalize">{{ $item->status }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#editAmbulanceModal" data-id="{{ $item->id }}"
                                                    data-car_number="{{ $item->car_number }}"
                                                    data-contact_number="{{ $item->contact_number }}"
                                                    data-driver_id="{{ $item->driver_id }}"
                                                    data-type="{{ $item->type }}" data-category="{{ $item->category }}"
                                                    data-status="{{ $item->status }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('ambulance.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">@csrf @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger delete-car">
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
                        <div class="modal fade" id="editAmbulanceModal" tabindex="-1" role="dialog"
                            aria-labelledby="editAmbulanceModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="editAmbulanceModalLabel">Edit Ambulance</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('ambulance.update', 'update') }}" method="POST">@csrf
                                            @method('PUT')
                                            <input type="hidden" id="id" name="id">
                                            <div class="row mb-4">
                                                <div class="col-md-6 form-group">
                                                    <label for="edit-car_number" class="form-label">Ambulance
                                                        Number</label>
                                                    <input type="text" class="form-control" id="edit-car_number"
                                                        name="car_number">
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="edit-contact_number" class="form-label">Contact No</label>
                                                    <input type="text" class="form-control" id="edit-contact_number"
                                                        name="contact_number">
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="edit-driver_id" class="form-label">Driver</label>
                                                    <select class="form-control" id="edit-driver_id" name="driver_id">
                                                        <option disabled>Select Driver</option>
                                                        @foreach ($drivers as $driver)
                                                            <option value="{{ $driver->id }}">{{ $driver->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="edit-type" class="form-label">Type</label>
                                                    <select class="form-control" id="edit-type" name="type">
                                                        <option value="">Select Type</option>
                                                        <option value="external">External</option>
                                                        <option value="internal">Internal</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="edit-category" class="form-label">Category</label>
                                                    <select class="form-control" id="edit-category" name="category">
                                                        <option value="">Select Category</option>
                                                        <option value="basic">Basic</option>
                                                        <option value="basic_o2">Basic O2</option>
                                                        <option value="icu">ICU</option>
                                                        <option value="freezer">Freezer</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label for="edit-status" class="form-label">Status</label>
                                                    <select class="form-control" id="edit-status" name="status">
                                                        <option value="">Select Status</option>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>

                                                <div class="col-auto md:mt-4 d-flex align-items-center">
                                                    <button type="submit" class="btn btn-primary"
                                                        id="update-ambulance">Update</button>
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
        $(function() {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');

            $(document).on('click', '.delete-car', function() {
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

        $('#editAmbulanceModal').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let car_number = button.data('car_number');
            let contact_number = button.data('contact_number');
            let driver_id = button.data('driver_id');
            let type = button.data('type');
            let category = button.data('category');
            let status = button.data('status');

            let modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #edit-car_number').val(car_number);
            modal.find('.modal-body #edit-contact_number').val(contact_number);
            modal.find('.modal-body #edit-driver_id').val(driver_id);
            modal.find('.modal-body #edit-type').val(type);
            modal.find('.modal-body #edit-category').val(category);
            modal.find('.modal-body #edit-status').val(status);


            $('#update-ambulance').click(function() {
                let form = modal.find('.modal-body form');
                let action = form.attr('action');
                form.attr('action', action.replace('update', id));
                form.submit();
            });
        });
    </script>
@endpush
