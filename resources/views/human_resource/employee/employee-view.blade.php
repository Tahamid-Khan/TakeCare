@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper bg-white">
        <div class="content">
            <div class="card">
                <div class="card-header h3 font-weight-bold">Employee Info</div>
                <div class="p-3">
                    <div class="d-flex justify-content-between px-4 flex-column flex-column-reverse flex-md-row my-4">
                        <div>
                            <p class="my-2"><strong>Name: </strong>{{ $employee->name }}</p>
                            <p class="my-2"><strong>Employee ID: </strong>{{ $employee->emp_id }}</p>
                            <p class="my-2 capitalize"><strong>Shift Timing: </strong>{{ $employee->shift }}</p>
                            <p class="my-2"><strong> Posting
                                    (Department): </strong>{{ $employee->department ? $employee->department->name : 'N/A' }}
                            </p>
                        </div>
                        <div class="row justify-content-center">
                            @if($employee->photo != null)
                                <img src="{{asset('img/human_resource/'. $employee->photo)}}"
                                     class="rounded-circle img-fluid"
                                     alt="Staff Photo" style="max-width: 150px; object-fit: cover">
                            @else
                                <img src="{{ asset('img/avatar.png') }}" class="rounded-circle img-fluid"
                                     alt="Staff Photo" style="max-width: 150px; object-fit: cover">
                            @endif
                        </div>
                    </div>

                    <!-- Employee Basic Information -->
                    <div class="row my-4">
                        <div class="col-12">
                            <h3 class="h3">Basic Information</h3>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Age</th>
                                    <td>{{ $employee->age ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $employee->gender ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Religion</th>
                                    <td>{{ $employee->religion ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>{{ $employee->date_of_birth ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Joining</th>
                                    <td>{{ $employee->joining_date ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Account Information</th>
                                    <td>{{ $employee->account_no ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Present Work Position</th>
                                    <td>{{ $employee->work_position ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Current Merit Points:</th>
                                    <td>
                                        <div class="bg-success text-white p-3 rounded-lg text-lg"
                                             style="width: max-content">
                                            {{ $employee->merit_points }}
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h3 class="h3">Contact Information</h3>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile No</th>
                                    <td>{{ $employee->mobile_no }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $employee->address }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Professional Background -->
                    {{--            <div class="row mb-4">--}}
                    {{--                <div class="col-12">--}}
                    {{--                    <h3 class="h3">Professional Background</h3>--}}
                    {{--                    <table class="table table-bordered">--}}
                    {{--                        <tbody>--}}
                    {{--                        <tr>--}}
                    {{--                            <th>Qualifications</th>--}}
                    {{--                            <td>MD, Cardiology, ABC University</td>--}}
                    {{--                        </tr>--}}
                    {{--                        <tr>--}}
                    {{--                            <th>Experience</th>--}}
                    {{--                            <td>15 years in Cardiology</td>--}}
                    {{--                        </tr>--}}
                    {{--                        <tr>--}}
                    {{--                            <th>Specializations</th>--}}
                    {{--                            <td>Heart Transplant, Coronary Artery Disease</td>--}}
                    {{--                        </tr>--}}
                    {{--                        </tbody>--}}
                    {{--                    </table>--}}
                    {{--                </div>--}}
                    {{--            </div>--}}

                    <!-- Employee Showcases -->
                    <div class="">
                        <h3 class="h3">Employee Showcases</h3>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="card">
                                    <div class="card-header text-muted text-end">
                                        {{--                                <strong>Last Updated:</strong> {{ \Carbon\Carbon::parse( $employee->updated_at)->format('d-m-Y') ?? \Carbon\Carbon::parse( $employee->created_at)->format('d-m-Y') }}--}}
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $employee->showcases }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Employee Salary and Salary Scale -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h3 class="h3">Employee Salary</h3>
                            <div class="card">
                                <div class="card-header text-muted text-end">
                                    {{--                            <strong>Last Updated:</strong> {{ \Carbon\Carbon::parse( $employee->updated_at)->format('d-m-Y') ?? \Carbon\Carbon::parse( $employee->created_at)->format('d-m-Y') }}--}}
                                </div>
                                <div class="card-body bg-white">
                                    {{--                            <h5 class="h5 mb-4">Salary Details</h5>--}}
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                        <tr>
                                            <th>Basic Salary</th>
{{--                                            add taka sign before that--}}

                                            <td><span class="taka-small">&#2547;</span>{{ number_format($employee->basic_salary, 2) }}</td>


                                        </tr>
                                        {{--                                <tr>--}}
                                        {{--                                    <th>Bonuses</th>--}}
                                        {{--                                    <td>15,000 per annum</td>--}}
                                        {{--                                </tr>--}}
                                        {{--                                <tr>--}}
                                        {{--                                    <th>Other Allowances</th>--}}
                                        {{--                                    <td>5,000 per annum</td>--}}
                                        {{--                                </tr>--}}
                                        {{--                                <tr>--}}
                                        {{--                                    <th>Total Salary</th>--}}
                                        {{--                                    <td><strong>120,000 per annum</strong></td>--}}
                                        {{--                                </tr>--}}
                                        </tbody>
                                    </table>

                                    {{--                            <h5 class="h5 mt-4">Salary Scale</h5>--}}
                                    <!-- <p>Current Grade: <strong>Grade 8</strong></p>
                            <div class="progress mb-3">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70"
                                aria-valuemin="0" aria-valuemax="100">
                                70% to next grade
                              </div>
                            </div>
                            <p>Next Grade: <strong>Grade 9</strong></p> -->


                                    {{--                            <table class="table table-bordered">--}}
                                    {{--                                <thead>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <th scope="col">Employee Category</th>--}}
                                    {{--                                    <th scope="col">Experience Level</th>--}}
                                    {{--                                    <th scope="col">Salary</th>--}}
                                    {{--                                </tr>--}}
                                    {{--                                </thead>--}}
                                    {{--                                <tbody>--}}
                                    {{--                                <!-- Junior -->--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <th scope="row" rowspan="3">Junior</th>--}}
                                    {{--                                    <td>Entry Level</td>--}}
                                    {{--                                    <td>40,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <td>Mid Level</td>--}}
                                    {{--                                    <td>55,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <td>Senior Level</td>--}}
                                    {{--                                    <td>70,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <!-- Intermediate -->--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <th scope="row" rowspan="3">Intermediate</th>--}}
                                    {{--                                    <td>Entry Level</td>--}}
                                    {{--                                    <td>40,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <td>Mid Level</td>--}}
                                    {{--                                    <td>55,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <td>Senior Level</td>--}}
                                    {{--                                    <td>70,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <!-- Senior -->--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <th scope="row" rowspan="3">Senior</th>--}}
                                    {{--                                    <td>Entry Level</td>--}}
                                    {{--                                    <td>40,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <td>Mid Level</td>--}}
                                    {{--                                    <td>55,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <td>Senior Level</td>--}}
                                    {{--                                    <td>70,000</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                </tbody>--}}
                                    {{--                            </table>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Present Man Power -->
                    {{--            <div class="row mb-4">--}}
                    {{--                <div class="col-12">--}}
                    {{--                    <h3 class="h3">Present Man Power</h3>--}}
                    {{--                    <div class="card">--}}
                    {{--                        <div class="card-header text-end text-muted">--}}
                    {{--                            <strong>Last Updated:</strong> August 17, 2024--}}
                    {{--                        </div>--}}
                    {{--                        <div class="card-body bg-white">--}}
                    {{--                            <div class="row">--}}
                    {{--                                <!-- Bed Capacity -->--}}
                    {{--                                <div class="col-md-4 mb-3">--}}
                    {{--                                    <div class="card">--}}
                    {{--                                        <div class="card-body text-white bg-primary">--}}
                    {{--                                            <h5 class="card-title">Bed Capacity</h5>--}}
                    {{--                                            <h2 class="card-text">250</h2>--}}
                    {{--                                            <p class="card-text">--}}
                    {{--                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. At, error.--}}
                    {{--                                            </p>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}

                    {{--                                <!-- Doctor -->--}}
                    {{--                                <div class="col-md-4 mb-3">--}}
                    {{--                                    <div class="card">--}}
                    {{--                                        <div class="card-body text-white bg-success">--}}
                    {{--                                            <h5 class="card-title">Doctor</h5>--}}
                    {{--                                            <h2 class="card-text">138</h2>--}}
                    {{--                                            <p class="card-text">--}}
                    {{--                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. At, error.--}}
                    {{--                                            </p>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}

                    {{--                                <!-- Staff -->--}}
                    {{--                                <div class="col-md-4 mb-3">--}}
                    {{--                                    <div class="card">--}}
                    {{--                                        <div class="card-body text-white bg-info">--}}
                    {{--                                            <h5 class="card-title">Total Staff</h5>--}}
                    {{--                                            <h2 class="card-text">388</h2>--}}
                    {{--                                            <p class="card-text">--}}
                    {{--                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. At, error.--}}
                    {{--                                            </p>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                    {{--            </div>--}}


                    <!-- Merit Points History -->
                    <div class="card mt-4">
                        <div class="card-header bg-info text-white">
                            Employee Logs
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Remark</th>
                                    <th>Document</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($history as $item)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at )->format('d-m-Y')}}</td>
                                        <td>{{ $item->history }} </td>
                                        <td>
                                            @if($item->document)
                                                <a href="{{ asset('img/history/'.$item->document) }}"
                                                   target="_blank" class="btn btn-info btn-sm">Download</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
                "filter": false,
                "order": [[0, "desc"]],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    {{--    <script>--}}
    {{--        function updateValue(value) {--}}
    {{--            document.getElementById('sliderValue').textContent = value + ' Points';--}}
    {{--        }--}}
    {{--    </script>--}}
@endpush

