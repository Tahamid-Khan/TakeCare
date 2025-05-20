@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        .form-label {
            font-size: 1.2em;
            font-weight: bold;
        }

        .form-check-label {
            font-size: 1.1em;
        }

        .form-control {
            font-size: 1.1em;
        }
    </style>
    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <h1 class="card-header h2 font-weight-bold">Employee Leave Request Form</h1>

                <div class="p-3">
                    <form action="{{ route('employee.leave-request-post') }}" method="POST">@csrf
                        <div class="mb-3">
                            <label class="form-label">Leave Type</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="leaveType" id="sickLeave"
                                               value="sick_leave">
                                        <label class="form-check-label" for="sickLeave">Sick Leave</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="leaveType" id="casualLeave"
                                               value="casual_leave">
                                        <label class="form-check-label" for="casualLeave">Casual Leave</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="leaveType" id="annualLeave"
                                               value="marital_leave">
                                        <label class="form-check-label" for="annualLeave">Marital Leave</label>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="startDate" required>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date" id="endDate" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason for Leave</label>
                            <textarea class="form-control" id="reason" rows="4" name="reason"
                                      placeholder="Provide a brief reason for your leave" required></textarea>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>
                    </form>
                    <table class="table table-bordered table-striped" id="classList">
                        <thead>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total</th>
                        <th>Reason</th>
                        <th>Status</th>
                        </thead>

                        <tbody>
                        @foreach ($leaveRequests as $item)
                            <tr>
                                <td>{{ $item->leave_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->start_date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}</td>
                                <td>{{ $item->total }} days</td>
                                <td>{{ $item->reason }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
