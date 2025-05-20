@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .bg-light {
            background-color: #F3F4F6 !important;
        }

        .status-font {
            color: black;
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 600;
        }
    </style>

    <div class="content-wrapper">
        <div class="content">
        <div class=" py-4">
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8 mb-4">
                    <div class="d-flex justify-content-between mb-4">
                        <div class="row px-3">
                            <form action="{{ route('nurse.patient-medicine-list') }}" method="POST">@csrf
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                <button type="submit" class="btn btn-primary mb-2">Print Medicine</button>
                            </form>
                            <form action="{{ route('nurse.patient-test-list') }}" method="POST">@csrf
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                <button type="submit" class="btn btn-primary mb-2 ml-2">Print Test</button>
                            </form>

                        </div>
                        @if(isset($getDischargeInfo))
                        <div>
                            {{-- <button class="btn btn-success mb-2" data-toggle="modal" data-target="#dischargeLetterModal">Generate Discharge Letter</button> --}}
                            <a href="{{ route('nurse.discharge-letter', $patient->id) }}" class="btn btn-success mb-2">Generate
                                Discharge Letter</a>
                        </div>
                        @endif
                    </div>


                    {{-- Current Status Part Start --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="h5">Patient Current Status</h2>
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <p class="text-muted mb-1">Patient Name:</p>
                                    <p class="h6 status-font">{{ $patient->name }}</p>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Bed no:</p>
                                    <p class="h6 status-font">101</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="p-2 bg-light rounded">
                                        <p class="text-muted mb-1">Temperature</p>
                                        <p class="h6 status-font">{{ isset($patient->patientStatus[0]) ? $patient->patientStatus[0]->temperature : 'no data' }} </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="p-2 bg-light rounded">
                                        <p class="text-muted mb-1">Blood Pressure</p>
                                        <p class="h6 status-font">{{ isset($patient->patientStatus[0]) ? $patient->patientStatus[0]->blood_pressure . ' mmHg'  : 'no data'}} </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="p-2 bg-light rounded">
                                        <p class="text-muted mb-1">Heart Rate</p>
                                        <p class="h6 status-font">{{ isset($patient->patientStatus[0]) ? $patient->patientStatus[0]->pulse_rate . ' bpm' : 'no data'}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="text-muted mb-1">Recent Updates:</p>
                                <p>{{ isset($patient->PatientDailySummary[0]) ?  $patient->PatientDailySummary[0]->summary  : 'no data'}}</p>
                            </div>
                            {{-- <div>
                                <p class="text-muted mb-1">Alerts:</p>
                                <p class="font-weight-bold text-danger">No current alerts.</p>
                            </div> --}}
                        </div>
                    </div>
                    {{-- Current Status Part End --}}

                    {{-- Doctor and Treatment Part Start --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="h5">Assigned Doctor & Treatment</h2>
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <p class="text-muted mb-1">Assigned Doctor:</p>
                                    <p class="h6 status-font">{{ isset($patient->patientDoctorAssignment[0]) ? $patient->patientDoctorAssignment[0]->doctor->name  : 'no data'}}</p>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Contact:</p>
                                    <p class="h6 status-font">
                                        {{ isset($patient->patientDoctorAssignment[0]) ? $patient->patientDoctorAssignment[0]->doctor->contactNumber  : 'no data'}} </p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p class="text-muted mb-1">Patient Summary:</p>
                                <p>{{ $patient->patient_summary }}</p>
                            </div>

                            <div class="mb-4">
                                <p class="text-muted mb-3">Medications:</p>
                                {{-- <ul class="pl-4">
                                    <li>&rarr; Antibiotic A - 500mg, twice daily</li>
                                    <li>&rarr; Pain Reliever B - 200mg, as needed</li>
                                    <li>&rarr; Vitamin C - 1000mg, once daily</li>
                                </ul> --}}
                                <div class="table-responsive">
                                    <table class="table status-table">
                                        <div id="status-heading" class="d-none text-center">
                                            <tr>
                                                <th>Name</th>
                                                <th>Schedule</th>
                                                <th>Taking time</th>
                                                <th>Dose</th>
                                                <th>Duration</th>

                                            </tr>
                                        </div>
                                        @foreach ($patient->patientMedicine as $item)
                                            @php
                                                $schedule = json_decode($item->schedule);
                                            @endphp


                                            <tr class="border-bottom mr-3 text-capitalize">
                                                <td>{{ $item->medicine_name }}</td>

                                                <td>
                                                    <small>
                                                        {{ in_array('morning', $schedule) ? '1+' : '0+' }}
                                                        {{ in_array('afternoon', $schedule) ? '1+' : '0+' }}
                                                        {{ in_array('evening', $schedule) ? '1' : '0' }}

                                                    </small>
                                                </td>
                                                <td>
                                                    <small>{{ $item->taking_time }} Meal</small>
                                                </td>
                                                <td>
                                                    <small>{{ $item->dose }}</small>
                                                </td>
                                                <td>
                                                    <small>{{ $item->duration }}</small>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                    {{-- Doctor and Treatment Part End --}}


                    {{-- Summary Part Start --}}
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h5">Patient Summary</h2>
                            <div class="d-flex justify-content-between mb-4">
                                <div>
                                    <p class="text-muted mb-1">Admission Date:</p>
                                    <p class="h6 status-font">June 1, 2024</p>
                                </div>
                                {{-- <div>
                                    <p class="text-muted mb-1">Diagnosis:</p>
                                    <p class="h6 status-font">Pneumonia</p>
                                </div> --}}
                            </div>
                            <div class="mb-4">
                                <p class="text-muted mb-1">Medical History:</p>
                                <ul class="pl-4">
                                    @foreach ($patient->previousHistory as $item)
                                        <li>&rarr; {{ $item->condition }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            {{--                            <div class="mb-4">--}}
                            {{--                                <p class="text-muted mb-1">Surgical History:</p>--}}
                            {{--                                <ul class="pl-4">--}}
                            {{--                                    <li>&rarr; Appendectomy (2015)</li>--}}
                            {{--                                    <li>&rarr; Gallbladder Removal (2018)</li>--}}
                            {{--                                </ul>--}}
                            {{--                            </div>--}}

                            {{-- <div>
                                <p class="text-muted mb-1">Allergies:</p>
                                <ul class="pl-4">
                                    <li>&rarr; Penicillin</li>
                                    <li>&rarr; Peanuts</li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
                {{-- Summary Part End --}}

                <div class="col-lg-4">
                    {{-- Medicine Part Start --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="h5">Medicine Circle</h2>
                            <form action="{{ route('nurse.medicine-status-update') }}" method="POST"> @csrf
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                <button class="btn btn-secondary mt-2">Update</button>
                                <div class="mt-4">
                                    @if (!in_array('morning', $schedules))
                                        <div class="border mb-4">
                                            <div
                                                class="d-flex justify-content-between align-items-center bg-primary text-white p-2">
                                                <h3 class="h6 mb-0">Morning</h3>
                                                <input type="radio" name="schedule" value="morning">

                                            </div>
                                            <ul class="pl-4 py-2">
                                                {{-- <li>&rarr; Morning</li>
                                                <li>&rarr; Morning</li>
                                                <li>&rarr; Morning</li> --}}

                                                @foreach ($patient->patientMedicine as $item)
                                                    @php
                                                        $schedule = json_decode($item->schedule);
                                                    @endphp
                                                    @if (in_array('morning', $schedule))
                                                        <li>&rarr; {{ $item->medicine_name }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (!in_array('afternoon', $schedules))
                                        <div class="border mb-4">
                                            <div
                                                class="d-flex justify-content-between align-items-center bg-primary text-white p-2">
                                                <h3 class="h6 mb-0">Afternoon</h3>
                                                <input type="radio" name="schedule" value="afternoon">
                                            </div>
                                            <ul class="pl-4 py-2">
                                                @foreach ($patient->patientMedicine as $item)
                                                    @php
                                                        $schedule = json_decode($item->schedule);
                                                    @endphp
                                                    @if (in_array('afternoon', $schedule))
                                                        <li>&rarr; {{ $item->medicine_name }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (!in_array('evening', $schedules))
                                        <div class="border">
                                            <div
                                                class="d-flex justify-content-between align-items-center bg-primary text-white p-2">
                                                <h3 class="h6 mb-0">Evening</h3>
                                                <input type="radio" name="schedule" value="evening">
                                            </div>
                                            <ul class="pl-4 py-2">
                                                @foreach ($patient->patientMedicine as $item)
                                                    @php
                                                        $schedule = json_decode($item->schedule);
                                                    @endphp
                                                    @if (in_array('evening', $schedule))
                                                        <li>&rarr; {{ $item->medicine_name }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- Medicine Part End --}}

                    {{-- Test Part Start --}}
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h5 card-title">Test List</h2>
                            <div class="mt-4">
                                <div class="border rounded mb-4 p-4">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="text-muted mb-1">Test Name:</p>
                                            <p class="h6">Blood Test</p>
                                        </div>
                                        <p class="small font-weight-bold">2024-02-12</p>

                                    </div>
                                    <div class="mt-2">
                                        <h3 class="text-muted h6">Result Summary:</h3>
                                        <ul class="pl-2">
                                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur,
                                                molestias.
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{--                    <div class="card">--}}
                    {{--                        <div class="card-body">--}}
                    {{--                            <h2 class="h5 card-title">Test List</h2>--}}
                    {{--                            <div class="mt-4">--}}
                    {{--                                <div class="border rounded mb-4 p-4">--}}
                    {{--                                    <div class="d-flex justify-content-between">--}}
                    {{--                                        <div>--}}
                    {{--                                            <p class="text-muted mb-1">Test Name:</p>--}}
                    {{--                                            <p class="h6">Blood Test</p>--}}
                    {{--                                            <p class="small font-weight-bold">June 2, 2024, 9:00 AM</p>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div>--}}
                    {{--                                            <p class="text-muted mb-1">Status:</p>--}}
                    {{--                                            <p class="h6 text-success">Completed</p>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="mt-2">--}}
                    {{--                                        <h3 class="text-muted h6">Results Summary:</h3>--}}
                    {{--                                        <ul class="pl-4">--}}
                    {{--                                            <li>&rarr; Hemoglobin: 13.5 g/dL</li>--}}
                    {{--                                            <li>&rarr; WBC: 7.0 x10^9/L</li>--}}
                    {{--                                            <li>&rarr; Platelets: 250 x10^9/L</li>--}}
                    {{--                                        </ul>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="border rounded mb-4 p-4">--}}
                    {{--                                    <div class="d-flex justify-content-between">--}}
                    {{--                                        <div>--}}
                    {{--                                            <p class="text-muted mb-1">Test Name:</p>--}}
                    {{--                                            <p class="h6">X-Ray</p>--}}
                    {{--                                            <p class="small font-weight-bold">June 3, 2024, 1:00 PM</p>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div>--}}
                    {{--                                            <p class="text-muted mb-1">Status:</p>--}}
                    {{--                                            <p class="h6 text-warning">Pending</p>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="mt-2">--}}
                    {{--                                        <h3 class="text-muted h6">Results Summary:</h3>--}}
                    {{--                                        <p class="text-muted">-</p>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="border rounded p-4">--}}
                    {{--                                    <div class="d-flex justify-content-between">--}}
                    {{--                                        <div>--}}
                    {{--                                            <p class="text-muted mb-1">Test Name:</p>--}}
                    {{--                                            <p class="h6">MRI</p>--}}
                    {{--                                            <p class="small font-weight-bold">June 5, 2024, 3:00 PM</p>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div>--}}
                    {{--                                            <p class="text-muted mb-1">Status:</p>--}}
                    {{--                                            <p class="h6 text-danger">Scheduled</p>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="mt-2">--}}
                    {{--                                        <h3 class="text-muted h6">Results Summary:</h3>--}}
                    {{--                                        <p class="text-muted">-</p>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{-- Test Part End --}}

                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

