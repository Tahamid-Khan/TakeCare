@extends('layouts.app')
@push('custom_css')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
@endpush
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Add Holiday</h2>

                <div class="p-4">
                    <div class="">
{{--                        <h3 class="py-3 h3">Holiday</h3>--}}

                        <div class="row">
                            <div class="col-lg-8 ">

{{--                                <div class="form-group">--}}
{{--                                    <label for="employee_id">Select Employee</label>--}}
{{--                                    <select name="employee_id" id="employee_id" class="form-control">--}}
{{--                                        <option value="">Select Employee</option>--}}
{{--                                        @foreach($employees as $employee)--}}
{{--                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}

                                <div id='calendar' class="calendar"></div>
                            </div>

{{--                            <div class=" col-lg-6 col-xl-7">--}}
{{--                                <h3 class="py-3 h3">Holiday List</h3>--}}
{{--                                <table class="table table-bordered table-striped" id="classList">--}}
{{--                                    <thead>--}}
{{--                                    <th>SL</th>--}}
{{--                                    <th>Employee ID</th>--}}
{{--                                    <th>Employee Name</th>--}}
{{--                                    <th>Start Date</th>--}}
{{--                                    <th>End Date</th>--}}
{{--                                    <th>Reason</th>--}}
{{--                                    </thead>--}}

{{--                                    <tbody>--}}
{{--                                    @foreach($employeeHolidays as $item)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $loop->iteration }}</td>--}}
{{--                                            <td>{{ $item->employee->emp_id }}</td>--}}
{{--                                            <td>{{ $item->employee->name }}</td>--}}
{{--                                            <td>{{ $item->holiday_start_date }}</td>--}}
{{--                                            <td>{{ $item->holiday_end_date }}</td>--}}
{{--                                            <td>{{ $item->holiday_reason }}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>

    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 6,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                editable: true,

                eventClick: function(info) {
                    if (confirm('Are you sure you want to delete this event?')) {
                        fetch('/employee-holiday/' + info.event.id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            }
                        }).then(function(response) {
                            console.log(response.json());
                            // calendar.refetchEvents();
                            location.reload();
                        });
                    }
                },

                eventDrop: function(info) {
                    var startDate = info.event.startStr;
                    var endDate = info.event.endStr;
                    endDate = new Date(new Date(endDate).getTime() - (24 * 60 * 60 * 1000));
                    endDate = endDate.toISOString().split('T')[0];

                    var reason = prompt('Enter new holiday reason:', info.event.title);

                    if (reason) {
                        fetch('/employee-holiday/' + info.event.id, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                start_date: startDate,
                                end_date: endDate,
                                reason: reason,
                                _token: "{{ csrf_token() }}"
                            })
                        }).then(function(response) {
                            // calendar.refetchEvents();
                            location.reload();
                        });
                    }
                },

                select: function (info) {
                    let startDate = info.startStr;
                    let endDate = info.endStr;
                    endDate = new Date(new Date(endDate).getTime() - (24 * 60 * 60 * 1000));
                    endDate = endDate.toISOString().split('T')[0];

                    let reason = prompt('Enter holiday reason:');
                    // let employee_id = document.getElementById('employee_id').value;

                    // if (!employee_id) {
                    //     alert('Please select an employee first');
                    //     return;
                    // }

                    if (reason) {
                        fetch('/employee-holiday', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                start_date: startDate,
                                end_date: endDate,
                                reason: reason,
                                // employee_id: employee_id,
                                _token: "{{ csrf_token() }}"
                            })
                        }).then(function (response) {
                            // console.log(response.json());
                            // calendar.refetchEvents();
                            location.reload();
                        });
                    }
                },
                events: '/holidays/get'
            });

            calendar.render();
        });
    </script>
@endpush
