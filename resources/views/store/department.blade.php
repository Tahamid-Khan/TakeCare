@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .w-45 {
            width: 45%;
        }
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12 col-xl-6 mb-4">
                    <div class="card">
                        <h2 class="card-header h2 font-weight-bold">Department</h2>

                        <div class="p-3">
                            <div>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addDepartment">Add New
                                </button>
                            </div>

                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>No</th>
                                <th>Department Name</th>
                                <th>Action</th>
                                </thead>


                                <tbody>
                                @foreach ($departments as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="d-flex">
                                            <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal"
                                                    data-target="#toggleDiv"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <form action="{{ route('store.delete-department') }}" method="POST">@csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>


                                {{-- Deparment Edit Popup Modal --}}
                                <div class="modal fade" id="toggleDiv" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('store.update-department') }}" method="POST">@csrf
                                                <div class="modal-header">
                                                    <h3 class="h3" id="exampleModalLabel">Update
                                                        Department</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <input type="hidden" name="id">
                                                    <div class="form-group">
                                                        <label for="department_name">Department Name</label>
                                                        <input type="text" class="form-control" id="department_name"
                                                               name="name">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Add modal for department --}}
                                <div class="modal fade" id="addDepartment" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('store.add-department') }}" method="POST">@csrf
                                                <div class="modal-header">
                                                    <h3 class="h3" id="exampleModalLabel">Add Department</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-group" id="department_name">
                                                        <label for="department_name">Department Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                               id="department_name">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Item --}}
                <div class="col-12 col-xl-6">
                    <div class="card">
                        <h3 class="card-header h3 font-weight-bold">Item</h3>

                        <div class="p-3">
                            <div>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addItem">Add New
                                </button>
                            </div>
                            <table class="table table-bordered table-striped" id="classList2">
                                <thead>
                                <th>No</th>
                                <th>Department</th>
                                <th>Item Type</th>
                                <th>Action</th>
                                </thead>


                                <tbody>
                                @foreach ($item_types as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->department->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="flex">
                                            <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal"
                                                    data-target="#item_toggleDiv"
                                                    data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                                    data-department="{{ $item->department->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <form action="{{ route('store.delete-item-type') }}" method="POST">@csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>


                                {{-- Item Type Edit Popup Modal --}}
                                <div class="modal fade" id="item_toggleDiv" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('store.update-item-type') }}" method="POST">@csrf
                                                <div class="modal-header">
                                                    <h3 class="h3" id="exampleModalLabel">Update Item Type</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <input type="hidden" name="id">
                                                    <div class="form-group">
                                                        <label for="item_type_name">Item Type Name*</label>
                                                        <input type="text" class="form-control" name="name"
                                                               id="item_type_name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="department_name">Department Name*</label>
                                                        <select name="department_id" id="department_id"
                                                                class="form-control">
                                                            <option selected disabled>Please Select</option>
                                                            @foreach ($departments as $item)
                                                                <option
                                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Add modal for item --}}
                                <div class="modal fade" id="addItem" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('store.add-item-type') }}" method="POST">@csrf
                                                <div class="modal-header">
                                                    <h3 class="h3" id="exampleModalLabel">Add Item Type</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="item_type_name">Item Type Name*</label>
                                                        <input type="text" class="form-control" name="name"
                                                               id="item_type_name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="department_name">Department Name*</label>
                                                        <select name="department_id" id="department_name"
                                                                class="form-control">
                                                            <option selected disabled>Please Select</option>
                                                            @foreach ($departments as $item)
                                                                <option
                                                                    value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

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
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
        $(function () {
            $("#classList2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $('#toggleDiv').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var modal = $(this);
            modal.find('.modal-body input[name="id"]').val(id);
            modal.find('.modal-body input[name="name"]').val(name);
        });

        $('#item_toggleDiv').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var department = button.data('department');
            var modal = $(this);
            modal.find('.modal-body input[name="id"]').val(id);
            modal.find('.modal-body input[name="name"]').val(name);
            modal.find('.modal-body select[name="department_id"]').val(department);
        });
    </script>
@endpush
