@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Fund Department</h2>
                <div class="p-4">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="card">
                                <h3 class="card-header h3">Add Department</h3>

                                <div class="card-body">
                                    <form action="{{ route('account.add-department') }}" method="POST">@csrf
                                        <div class="row mb-4">
                                            <div class="col-md-6 mb-3">
                                                <label for="add-fund-type" class="form-label">Fund Type*</label>
                                                <select id="add-fund-type" name="fund_id" class="form-control">
                                                    <option selected disabled value="">Select Fund Type</option>
                                                    @foreach($funds as $item)
                                                        <option class="capitalize"
                                                                value="{{ $item->id }}">{{ $item->type }}</option>

                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="add-department" class="form-label">Department Name*</label>
                                                <input type="text" id="add-department" name="name"
                                                       class="form-control">
                                            </div>
                                            <div class="col-auto md:mt-4 d-flex align-items-center">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-7">
                            <div class="card">
                                <h3 class="card-header h3">Department List</h3>
                                <div class="p-3">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                    <th>SL</th>
                                    <th>Fund Type</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    {{--<th>Action</th>--}}
                                    </thead>

                                    <tbody>

                                    @foreach($fundDepartments as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="capitalize">{{ $item->fund->type }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            {{--                                        <td class="row">--}}
                                            {{--                                            <button type="button" class="btn" data-toggle="modal"--}}
                                            {{--                                                    data-target="#editFundDepartmentModal">--}}
                                            {{--                                                <i class="fa fa-edit"></i>--}}
                                            {{--                                            </button>--}}
                                            {{--                                            <form action="" method="POST">@csrf--}}
                                            {{--                                                <input type="hidden" name="id" value="">--}}
                                            {{--                                                <button type="submit" class="btn">--}}
                                            {{--                                                    <i class="fa fa-trash"></i>--}}
                                            {{--                                                </button>--}}
                                            {{--                                            </form>--}}
                                            {{--                                        </td>--}}
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                </div>
                            </div>

                            <!-- Edit Fund Department Modal -->
                            <div class="modal fade" id="editFundDepartmentModal" tabindex="-1" role="dialog"
                                 aria-labelledby="editFundDepartmentModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Department</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="POST">@csrf
                                                <div class="row mb-4">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="edit-fund-type" class="form-label">Fund Type</label>
                                                        <select id="edit-fund-type" name="edit_fund_type"
                                                                class="form-control">
                                                            <option value="board">Board</option>
                                                            <option value="lab">Lab</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-9 mb-3">
                                                        <label for="edit-fund-department" class="form-label">Department
                                                            Name</label>
                                                        <input type="text" id="edit-fund-department"
                                                               name="edit_fund_department" class="form-control">
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
    </script>
@endpush
