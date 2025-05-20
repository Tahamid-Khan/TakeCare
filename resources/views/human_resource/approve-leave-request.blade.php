@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Employee Leave Request Approve</h2>

                <div class="p-3">
                    <table class="table table-bordered table-striped" id="classList">
                        <thead>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Days</th>
                        <th>Reason</th>
                        <th>Actions</th>
                        </thead>


                        <tbody>
                        @foreach ($leaveRequests as $item)
                            <tr>
                                <td>{{ $item->employee->emp_id }}</td>
                                <td>{{ $item->employee->name }}</td>
                                <td>{{ $item->employee->department->name }}</td>
                                <td>{{ $item->leave_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}</td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $item->reason }}</td>
                                <td class="row mr-0">
                                    <form action="{{ route('hr.approve-leave-post') }}" method="POST">@csrf
                                        <input type="number" hidden name="id" value="{{ $item->id }}">
                                        <input type="text" hidden name="status" value="approved">
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <button class="btn btn-danger btn-sm ml-2" data-toggle="modal"
                                            data-target="#rejectionModal" data-id="{{ $item->id }}" id="reject-btn">
                                        Reject
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>


                    </table>

                    <div>
                        <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog"
                             aria-labelledby="rejectionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="rejectionModalLabel">Rejection Reason</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('hr.approve-leave-post') }}" method="POST">@csrf
                                        <div class="modal-body p-4">
                                            <input type="number" hidden name="id">
                                            <input type="text" hidden name="status" value="rejected">
                                            <textarea name="rejection_reason" id="reject-note" class="form-control"
                                                      rows="4"
                                                      placeholder="Provide a brief reason for rejecting the leave request"></textarea>
                                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
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
@endsection
@push('custom_js')
    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": [5, 'desc'],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        $('#rejectionModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let modal = $(this);
            modal.find('.modal-body input[name="id"]').val(id);
        });

    </script>
@endpush
