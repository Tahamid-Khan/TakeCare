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
                                <h3 class="h3">Attendance Lists</h3>
                            </div>

                            <div class="card-header">
                                <form action="" method="GET">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="start-date">Start Date</label>
                                                <input type="date" name="start_date" id="start-date" class="form-control"
                                                    value="{{ request()->start_date }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="end-date">End Date</label>
                                                <input type="date" name="end_date" id="end-date" class="form-control"
                                                    value="{{ request()->end_date }}">
                                            </div>
                                        </div>

{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="employee_id">Employee ID</label>--}}
{{--                                                <select name="employee_id" id="employee_id" class="form-control">--}}
{{--                                                    <option value="">Select</option>--}}
{{--                                                    @foreach ($employees as $item)--}}
{{--                                                        <option value="{{ $item->id }}"--}}
{{--                                                            @if (request()->employee_id == $item->id) selected @endif>--}}
{{--                                                            {{ $item->emp_id }}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="shift_id">Shift</label>
                                                <select name="shift_id" id="shift_id" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="morning" @if(request()->shift_id == 'morning') selected @endif>Morning</option>
                                                    <option value="evening" @if(request()->shift_id == 'evening') selected @endif>Evening</option>
                                                    <option value="night" @if(request()->shift_id == 'night') selected @endif>Night</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <a href="{{url()->current()}}" class="btn btn-danger">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div>



                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Checking In</th>
                                        <th>Checking Out</th>
                                        <th>Total Work Time</th>
                                        <th>Attandance</th>
                                        <th>Date</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($lists as $item)
                                            <tr>
                                                <td>{{ $item->employee->emp_id }}</td>
                                                <td class="capitalize">{{ $item->employee->name }}</td>
                                                <td>{{ $item->check_in->format('h:i a') }}</td>
                                                <td>{{ $item->check_out->format('h:i a') }}</td>
                                                <td>{{ $item->total_hours->format('h') . ' h ' . $item->total_hours->format('i') . ' m' }}</td>
                                                <td class="capitalize">{{ $item->status }}</td>
                                                <td>{{ $item->date->format('d-m-Y') }}</td>
                                            </tr>
                                        @endforeach
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
        $(function() {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
