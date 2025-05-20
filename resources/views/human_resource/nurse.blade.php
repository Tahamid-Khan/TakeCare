@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Nurse</h2>

                <div class="p-4">
                    <div class="">
                        <div class="">
                            <h3 class="py-3 h3">Add Nurse</h3>

                            <form action="{{ route('hr-nurse.store') }}" method="POST">@csrf
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-3 mb-3">
                                            <label for="nurse-name" class="form-label">Nurse Name<span class="text-danger">*</span></label>
                                            <input type="text" id="nurse-name" name="name" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-nurse-type" class="form-label">Type<span class="text-danger">*</span></label>
                                            <select id="add-nurse-type" name="type" class="form-control" required>
                                                <option value="">Select Nurse Type</option>
                                                @foreach ($nurseTypes as $item)
                                                    <option class="capitalize" value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-nurse-department" class="form-label">Department<span class="text-danger">*</span></label>
                                            <select id="add-nurse-department" name="department_id" class="form-control" required>
                                                <option value="">Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-md-3 mb-3">
                                            <label for="add-nurse-position" class="form-label">Position<span class="text-danger">*</span></label>
                                            <input type="text" id="add-nurse-position" name="position" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-nurse-qualification" class="form-label">Qualification<span class="text-danger">*</span></label>
                                            <input type="text" id="add-nurse-qualification" name="qualification" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-nurse-contact" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                            <input type="text" id="add-nurse-contact" name="phone" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-nurse-address" class="form-label">Address<span class="text-danger">*</span></label>
                                            <input type="text" id="add-nurse-address" name="address" class="form-control" required>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-nurse-ward-id" class="form-label">Ward<span class="text-danger">*</span></label>
                                            <select id="add-nurse-ward-id" name="ward_id" class="form-control" required>
                                                <option value="">Select Ward</option>
                                                @foreach ($wards as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-nurse-user-id" class="form-label">User Profile<span class="text-danger">*</span></label>
                                            <select id="add-nurse-user-id" name="user_id" class="form-control" required>
                                                <option value="">Select User Profile</option>
                                                @foreach ($users as $item)
                                                    <option value="{{ $item->id }}">{{$item->name . ' - '. $item->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-auto md:mt-4 d-flex align-items-center">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="">
                            <h3 class="py-3 h3">Nurse List</h3>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>SL</th>
                                <th>Nurse ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Type</th>
                                <th>Action</th>
                                </thead>

                                <tbody>
                                @foreach ($nurses as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nurse_id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td class="capitalize">{{ $item->type }}</td>
                                        <td class="row">
                                            <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#editNurseModal" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-type="{{ $item->type }}" data-status="{{ $item->status }}" data-department="{{ $item->department->id }}" data-position="{{ $item->position }}" data-qualification="{{ $item->qualification }}" data-phn="{{ $item->contact_number }}" data-address="{{ $item->address }}" data-ward_id="{{$item->ward_id}}" data-user_id="{{ $item->user_id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <form action="{{ route('hr-nurse.destroy', $item->id) }}" method="POST">@csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>


                        <!-- Edit Nurse Modal -->
                        <div class="modal fade" id="editNurseModal" tabindex="-1" role="dialog" aria-labelledby="editNurseModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="editNurseModalLabel">Edit Nurse</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="update-nurse-form" action="" method="POST">@csrf @method('PUT')
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-nurse-name" class="form-label">Nurse Name<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-nurse-name" name="name" class="form-control" required>
                                                </div>

                                                {{--                                                <div class="col-md-6 mb-3">--}}
                                                {{--                                                    <label for="edit-nurse-status" class="form-label">Status<span--}}
                                                {{--                                                            class="text-danger">*</span></label>--}}
                                                {{--                                                    <select id="edit-nurse-status" name="status" class="form-control"--}}
                                                {{--                                                            required>--}}
                                                {{--                                                        <option selected disabled>Select Status</option>--}}
                                                {{--                                                        <option class="capitalize" value="1">Active</option>--}}
                                                {{--                                                        <option class="capitalize" value="0">Inactive</option>--}}

                                                {{--                                                    </select>--}}
                                                {{--                                                </div>--}}
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-nurse-type" class="form-label">Type<span class="text-danger">*</span></label>
                                                    <select id="edit-nurse-type" name="type" class="form-control" required>
                                                        <option value="" selected>Select Nurse Type</option>
                                                        @foreach ($nurseTypes as $item)
                                                            <option class="capitalize" value="{{ $item }}">
                                                                {{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-nurse-department" class="form-label">Department<span class="text-danger">*</span></label>
                                                    <select id="edit-nurse-department" name="department_id" class="form-control" required>
                                                        <option value="">Select Department</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}">{{ $department->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>


                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-nurse-position" class="form-label">Position<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-nurse-position" name="position" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-nurse-qualification" class="form-label">Qualification<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-nurse-qualification" name="qualification" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-nurse-contact" class="form-label">Contact Number<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-nurse-contact" name="phone" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-nurse-address" class="form-label">Address<span class="text-danger">*</span></label>
                                                    <input type="text" id="edit-nurse-address" name="address" class="form-control" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-nurse-ward-id" class="form-label">Ward<span class="text-danger">*</span></label>
                                                    <select id="edit-nurse-ward-id" name="ward_id" class="form-control" required>
                                                        <option value="">Select Ward</option>
                                                        @foreach ($wards as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label for="edit-nurse-user-id" class="form-label">User Profile<span class="text-danger">*</span></label>
                                                    <select id="edit-nurse-user-id" disabled name="user_id" class="form-control" required>
                                                        <option value="">Select User Profile</option>
                                                        @foreach ($assignedUsers as $item)
                                                            <option value="{{ $item->id }}">{{$item->name . ' - '. $item->email }}</option>
                                                        @endforeach
                                                    </select>

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
        $('#add-nurse-user-id').select2({
            placeholder: "Select User Profile",
            allowClear: true
        });


        $('#editNurseModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let name = button.data('name');
            let type = button.data('type');
            let status = button.data('status');
            let department = button.data('department');
            let position = button.data('position');
            let qualification = button.data('qualification');
            let phn = button.data('phn');
            let address = button.data('address');
            let ward_id = button.data('ward_id');
            let user_id = button.data('user_id');

            let modal = $(this);
            modal.find('.modal-body #edit-nurse-name').val(name);
            modal.find('.modal-body #edit-nurse-type').val(type);
            modal.find('.modal-body #edit-nurse-status').val(status);
            modal.find('.modal-body #edit-nurse-department').val(department);
            modal.find('.modal-body #edit-nurse-position').val(position);
            modal.find('.modal-body #edit-nurse-qualification').val(qualification);
            modal.find('.modal-body #edit-nurse-contact').val(phn);
            modal.find('.modal-body #edit-nurse-address').val(address);
            modal.find('.modal-body #edit-nurse-ward-id').val(ward_id);
            modal.find('.modal-body #edit-nurse-user-id').val(user_id);

            let form = document.getElementById('update-nurse-form');
            form.action = '/hr-nurse/' + id;
        });


    </script>
@endpush
