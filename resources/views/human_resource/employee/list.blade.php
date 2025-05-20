@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-row justify-content-start text-bold">
                                            <h3 class="h3">HR Information -Employee</h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        @userType('hr', 'admin')
                                        <div class="flex-row text-right">
                                            <a class="btn btn-sm btn-secondary my-2" title="Add Employee" href="{{route('employee.create')}}" style="line-height: 1.5 !important;"><i class="fas fa-pus"></i> Add New</a>
                                        </div>
                                        @enduserType
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Emp Id</th>
                                    <th>Joining Date</th>
                                    <th>Department</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @if(isset($lists))
                                        @foreach($lists as $k=>$list)
                                            <tr>
                                                <td>{{$k+1}}</td>
                                                <td>{{$list->name}}</td>
                                                <td>{{$list->emp_id}}</td>
                                                <td>{{$list->joining_date}}</td>
                                                <td>{{$list->department->name}}</td>
                                                <td>{{$list->type}}</td>
                                                <td>@if($list->status == 0)
                                                        Off
                                                    @else
                                                        On
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('employee.staff-summary', ['id' => $list->id]) }}" class="btn btn-sm btn-info my-2" title="View">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    @userType('hr', 'admin')
                                                    <a href="{{route('employee.edit',$list->id)}}" class="btn btn-sm btn-success my-2" title="Edit">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger my-2" title="Delete" onclick="deleteConfirm({{$list->id}})">
                                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                    @enduserType
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
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

        function deleteConfirm(id) {
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are you sure to delete this record!")) {
                $.ajax({
                    url: 'employee/delete/' + id,
                    type: 'get',
                    success: function (status) {
                        if (status.status == 1) {
                            window.location.reload();
                        }
                    }
                })
            }
        }
    </script>
@endpush

