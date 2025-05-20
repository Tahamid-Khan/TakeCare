@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Doctors</h2>

                <div class="p-4">
                    <div class="">
                        <div class="">
                            <h3 class="py-3 h3">Add Doctor</h3>

                            <form action="{{ route('hr.add-doctor') }}" method="POST">@csrf
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-3 mb-3">
                                            <label for="doctor-name" class="form-label">Doctor Name<span class="text-danger">*</span></label>
                                            <input type="text" id="doctor-name" name="name" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-doctor-type" class="form-label">Type<span class="text-danger">*</span></label>
                                            <select id="add-doctor-type" name="type" class="form-control" required>
                                                <option value="">Select Doctor Type</option>
                                                @foreach ($doctorTypes as $doctorType)
                                                    <option class="capitalize" value="{{ $doctorType }}">{{ $doctorType }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-doctor-department" class="form-label">Department<span class="text-danger">*</span></label>
                                            <select id="add-doctor-department" name="department_id" class="form-control" required>
                                                <option value="">Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-doctor-specialization" class="form-label">Specialization<span class="text-danger">*</span></label>
                                            <input type="text" id="add-doctor-specialization" name="specialization" class="form-control" required>
                                        </div>


                                        <div class="col-md-3 mb-3">
                                            <label for="add-doctor-position" class="form-label">Position<span class="text-danger">*</span></label>
                                            <input type="text" id="add-doctor-position" name="position" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-doctor-qualification" class="form-label">Qualification<span class="text-danger">*</span></label>
                                            <input type="text" id="add-doctor-qualification" name="qualification" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-doctor-contact" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                            <input type="text" id="add-doctor-contact" name="phone" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-doctor-address" class="form-label">Address<span class="text-danger">*</span></label>
                                            <input type="text" id="add-doctor-address" name="address" class="form-control" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="add-doctor-user-id" class="form-label">User Profile<span class="text-danger">*</span></label>
                                            <select id="add-doctor-user-id" name="user_id" class="form-control" required>
                                                <option value="">Select User Profile</option>
                                                @foreach ($users as $item)
                                                    <option value="{{ $item->id }}">{{$item->name . ' - '. $item->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="col-md-12 form-group mb-3">
                                            <label for="add-doctor-available-time" class="form-label">Available Time</label>
                                            <div class="row">
                                                <div class="col-6 input-group mb-0 mr-sm-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Start Time</div>
                                                    </div>
                                                    <input class="form-control" type="time" id="add-doctor-available-time" name="add_doctor_start_time" value="10:00:00">
                                                </div>
                                                <div class="col-6 input-group mb-0 mr-sm-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">End Time</div>
                                                    </div>
                                                    <input class="form-control" type="time" id="add-doctor-available-time" name="add_doctor_end_time" value="14:00:00">
                                                </div>
                                            </div>
                                        </div> --}}


                                        <div class="col-auto md:mt-4 d-flex align-items-center">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="">
                            <h3 class="py-3 h3">Doctor's List</h3>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>SL</th>
                                <th>Doctor ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Type</th>
                                <th>Action</th>
                                </thead>

                                <tbody>
                                @foreach ($doctors as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->doctor_id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td class="capitalize">{{ $item->type }}</td>
                                        <td class="row">
                                            <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#editDoctorModal" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-type="{{ $item->type }}" data-status="{{ $item->status }}" data-department="{{ $item->department->id }}" data-specialization="{{ $item->specialization }}" data-position="{{ $item->position }}" data-qualification="{{ $item->qualification }}" data-phn="{{ $item->contactNumber }}" data-address="{{ $item->address }}" data-user_id="{{ $item->user_id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <form action="{{ route('hr.delete-doctor') }}" method="POST">@csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-sm btn-danger delete-doctor">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>


                        <!-- Edit Doctor Modal -->
                        <div class="modal fade" id="editDoctorModal" tabindex="-1" role="dialog" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="editDoctorModalLabel">Edit Doctor</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('hr.update-doctor') }}" method="POST">@csrf
                                            <input type="hidden" id="id" name="id">
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-name" class="form-label">Doctor Name<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-doctor-name" name="name" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-status" class="form-label">Status<span class="text-danger">*</span></label>
                                                    <select id="edit-doctor-status" name="status" class="form-control" required>
                                                        <option selected disabled>Select Status</option>
                                                        <option class="capitalize" value="1">Active</option>
                                                        <option class="capitalize" value="0">Inactive</option>

                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-type" class="form-label">Type<span class="text-danger">*</span></label>
                                                    <select id="edit-doctor-type" name="type" class="form-control" required>
                                                        <option value="">Select Doctor Type</option>
                                                        @foreach ($doctorTypes as $doctorType)
                                                            <option class="capitalize" value="{{ $doctorType }}">
                                                                {{ $doctorType }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-department" class="form-label">Department<span class="text-danger">*</span></label>
                                                    <select id="edit-doctor-department" name="department_id" class="form-control" required>
                                                        <option value="">Select Department</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}">{{ $department->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-specialization" class="form-label">Specialization<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-doctor-specialization" name="specialization" class="form-control" required>
                                                </div>


                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-position" class="form-label">Position<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-doctor-position" name="position" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-qualification" class="form-label">Qualification<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-doctor-qualification" name="qualification" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-contact" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-doctor-contact" name="phone" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-doctor-address" class="form-label">Address<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-doctor-address" name="address" class="form-control" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="edit-doctor-user-id" class="form-label">User Profile<span class="text-danger">*</span></label>
                                                    <select id="edit-doctor-user-id" disabled name="user_id" class="form-control" required>
                                                        <option value="">No User Profile Selected</option>
                                                        @foreach ($assignedUsers as $item)
                                                            <option value="{{ $item->id }}">{{$item->name . ' - '. $item->email }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                {{-- <div class="col-md-12 form-group mb-3">
                                                    <label for="edit-doctor-available-time"
                                                        class="form-label">Available Time</label>
                                                    <div class="row">
                                                        <div class="col-6 input-group mb-0 mr-sm-0">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">Start Time</div>
                                                            </div>
                                                            <input class="form-control" type="time"
                                                                id="edit-doctor-available-time" name="edit_doctor_start_time" value="10:00:00">
                                                        </div>
                                                        <div class="col-6 input-group mb-0 mr-sm-0">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">End Time</div>
                                                            </div>
                                                            <input class="form-control" type="time"
                                                                id="edit-doctor-available-time" name="edit_doctor_end_time" value="14:00:00">
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <div class="col-auto md:mt-4 d-flex align-items-center">
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
                "filter": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
        $('#add-doctor-user-id').select2({
            placeholder: "Select User Profile",
            allowClear: true
        });


        $('#editDoctorModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var type = button.data('type')
            var status = button.data('status')
            var department = button.data('department')
            var specialization = button.data('specialization')
            var position = button.data('position')
            var qualification = button.data('qualification')
            var phn = button.data('phn')
            var address = button.data('address')
            var user_id = button.data('user_id');

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #edit-doctor-name').val(name)
            modal.find('.modal-body #edit-doctor-type').val(type)
            modal.find('.modal-body #edit-doctor-status').val(status)
            modal.find('.modal-body #edit-doctor-department').val(department)
            modal.find('.modal-body #edit-doctor-specialization').val(specialization)
            modal.find('.modal-body #edit-doctor-position').val(position)
            modal.find('.modal-body #edit-doctor-qualification').val(qualification)
            modal.find('.modal-body #edit-doctor-contact').val(phn)
            modal.find('.modal-body #edit-doctor-address').val(address)
            modal.find('.modal-body #edit-doctor-user-id').val(user_id);
        });

        $('.delete-doctor').on('click', function (e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this doctor!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endpush
