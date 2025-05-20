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
                                <h3 class="h3">Employee Leave Lists</h3>
                            </div>

                            @php
                                $i = 1;

                                $employeeLeaveLists = [
                                    [
                                        'employee_id' => 'EMP-001',
                                        'name' => 'John Doe',
                                        'sick_leave' => '2/5',
                                        'casual_leave' => '3/5',
                                        'parent_leave' => '1/5',
                                        'total_leave' => '6',
                                        'date' => '2021-09-01',
                                    ],
                                    [
                                        'employee_id' => 'EMP-002',
                                        'name' => 'Jane Doe',
                                        'sick_leave' => '2/5',
                                        'casual_leave' => '3/5',
                                        'parent_leave' => '1/5',
                                        'total_leave' => '6',
                                        'date' => '2021-09-01',
                                    ],
                                    [
                                        'employee_id' => 'EMP-003',
                                        'name' => 'John Doe',
                                        'sick_leave' => '2/5',
                                        'casual_leave' => '3/5',
                                        'parent_leave' => '1/5',
                                        'total_leave' => '6',
                                        'date' => '2021-09-01',
                                    ],
                                    [
                                        'employee_id' => 'EMP-004',
                                        'name' => 'Jane Doe',
                                        'sick_leave' => '2/5',
                                        'casual_leave' => '3/5',
                                        'parent_leave' => '1/5',
                                        'total_leave' => '6',
                                        'date' => '2021-09-01',
                                    ],
                                    [
                                        'employee_id' => 'EMP-005',
                                        'name' => 'John Doe',
                                        'sick_leave' => '2/5',
                                        'casual_leave' => '3/5',
                                        'parent_leave' => '1/5',
                                        'total_leave' => '6',
                                        'date' => '2021-09-01',
                                    ],
                                ];
                            @endphp

                            {{-- <div class="card-header">
                                <form action="" method="GET">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" name="date" id="date" class="form-control"
                                                    value="{{ request()->date }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="employee_id">Employee ID</label>
                                                <select name="employee_id" id="employee_id" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach ($employees as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (request()->employee_id == $item->id) selected @endif>
                                                            {{ $item->emp_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                            <a href="{{ url()->current() }}" class="btn btn-danger">Reset</a>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}



                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Sick Leave</th>
                                        <th>Casual Leave</th>
                                        <th>Marital Leave</th>
                                        <th>Total Leave</th>
                                        {{-- <th>Date</th> --}}
                                    </thead>

                                    <tbody>
                                        @foreach ($lists as $item)
                                            <tr>
                                                <td>{{ $item->employee->emp_id }}</td>
                                                <td>{{ $item->employee->name }}</td>
                                                <td>{{ $item->sick_leave . "/" . $leave_types['sick_leave'] }}</td>
                                                <td>{{ $item->casual_leave . "/" . $leave_types['casual_leave'] }}</td>
                                                <td>{{ $item->marital_leave . "/" . $leave_types['marital_leave'] }}</td>
                                                <td>{{ $item->total_leave . "/" . $leave_types['total_leave'] }}</td>
                                                {{-- <td>{{ $employeeLeaveList['date'] }}</td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {{-- <div class="card-body">
                                @include('components.tab-item')
                            </div> --}}

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
