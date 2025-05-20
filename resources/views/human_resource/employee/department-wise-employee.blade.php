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
                                <div class="row justify-content-between">
                                    <h3 class="h3">Department Wise Employee</h3>
                                    @userType('hr', 'admin')
                                    <div class="flex-row text-right">
                                        <a class="btn btn-sm btn-secondary my-2" title="Add Teacher" href="{{route('department.create')}}" style="line-height: 1.5 !important;"><i class="fas fa-pus"></i> Add New</a>
                                    </div>
                                    @enduserType
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('employee') }}" class="btn btn-primary my-2">All Employees</a>
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                    <th>Department Name</th>
                                    <th>Total Employee</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody>
                                    @if(isset($lists))
                                        @foreach($lists as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->total_emp ?? 0 }}</td>
                                                <td>
                                                    <a href="{{ route('department.employee-list', ['id' => $item->id]) }}" class="btn btn-sm btn-info my-2" title="View">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a>
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
    </script>
@endpush

