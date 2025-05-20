@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .w-0 {
            width: 0px;
        }

        .w-100p {
            width: 100px;
        }
    </style>
    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Hospital</h2>
                <div class="p-4">
                    <div class="">
                        <div class="">
                            <h3 class="py-3 h3">Add Hospital</h3>
                            <div class="card-body">
                                <form action="{{ route('add-hospital') }}" method="POST">@csrf
                                    <div class="row mb-4">
                                        <div class="col-md-3 mb-3">
                                            <label for="add-hospital-name" class="form-label">Hospital Name</label>
                                            <input type="text" id="add-hospital-name" name="name"
                                                   class="form-control">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-email" class="form-label">Email</label>
                                            <input type="email" id="add-email" name="email" class="form-control">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-phone-number" class="form-label">Phone Number</label>
                                            <input type="text" id="add-phone-number" name="phone"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="add-website" class="form-label">Website</label>
                                            <input type="text" id="add-website" name="website"
                                                   class="form-control">
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label for="add-address" class="form-label">Address</label>
                                            <textarea id="add-address" name="address" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h3 class="py-3 h3">Hospital's List</h3>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Hospital Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($hospitals as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td class="row mr-0">
                                            <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal"
                                                    data-target="#editHospitalModal" data-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}" data-email="{{ $item->email }}"
                                                    data-phone="{{ $item->phone }}" data-website="{{ $item->website }}"
                                                    data-address="{{ $item->address }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <form action="{{ route('delete-hospital') }}" method="POST">@csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="button" class="btn btn-sm btn-danger delete-hospital">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        <!-- Edit Hospital Modal -->
                        <div class="modal fade" id="editHospitalModal" tabindex="-1" role="dialog"
                             aria-labelledby="editHospitalModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="editHospitalModalLabel">Update Hospital</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('edit-hospital') }}" method="POST">@csrf
                                            <input type="hidden" id="edit-id" name="id">
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-hospital-name" class="form-label">Hospital
                                                        Name</label>
                                                    <input type="text" id="edit-hospital-name" name="name"
                                                           class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-email" class="form-label">Email</label>
                                                    <input type="email" id="edit-email" name="email"
                                                           class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-phone-number" class="form-label">Phone
                                                        Number</label>
                                                    <input type="text" id="edit-phone-number" name="phone"
                                                           class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-website" class="form-label">Website</label>
                                                    <input type="text" id="edit-website" name="website"
                                                           class="form-control">
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label for="edit-address" class="form-label">Address</label>
                                                    <textarea id="edit-address" name="address"
                                                              class="form-control"></textarea>
                                                </div>


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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        $('#editHospitalModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var email = button.data('email');
            var phone = button.data('phone');
            var website = button.data('website');
            var address = button.data('address');

            var modal = $(this);
            modal.find('.modal-body #edit-id').val(id);
            modal.find('.modal-body #edit-hospital-name').val(name);
            modal.find('.modal-body #edit-email').val(email);
            modal.find('.modal-body #edit-phone-number').val(phone);
            modal.find('.modal-body #edit-website').val(website);
            modal.find('.modal-body #edit-address').val(address);
        });

        $(document).on('click', '.delete-hospital', function () {
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this hospital!",
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
