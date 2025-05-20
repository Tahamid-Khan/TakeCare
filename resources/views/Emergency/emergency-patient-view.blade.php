@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .card-title {
            background-color: #007bff;
            color: white;
            padding: 10px;
            margin: 0;
            border-radius: 5px 5px 0 0;
        }

        .update-btn {
            margin: 10px 0;
        }

        .info-section h5 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
            color: #007bff;
        }

        .info-section p {
            margin-bottom: 10px;
        }

        @media (max-width: 767px) {
            .info-section {
                margin-bottom: 20px;
            }
        }

        .dataTables_filter {
            display: none;
        }
    </style>

    <div class="content-wrapper">
        <section class="content ">
            <div class="container px-4">
                <div class="card">
                    <div class="card-title text-center">
                        <h3>Emergency Patient Information</h3>
                    </div>
                    <div class="d-flex justify-content-end update-btn">
                        <div class="pr-2">
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPatient">Update
                                <i class="fas fa-edit ms-1" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-header">
                        <div class="row info-section">
                            <div class="col-md-4">
                                <h5>Personal Details</h5>
                                <p><strong>ID: {{ $patientData->patient->patient_id }} </strong></p>
                                <p><strong>Name:</strong> {{ $patientData->patient->name }}</p>
                                <p><strong>Gender:</strong> {{ $patientData->patient->gender }}</p>
                                <p><strong>Age:</strong> {{ $patientData->patient->age }} old</p>
                                <p><strong>Address:</strong> {{ $patientData->patient->address }}</p>
                                <p><strong>Mobile:</strong> {{ $patientData->patient->mobile }}</p>
                            </div>
                            @if ($patientData->mlc !== null)
                                @php
                                    $mlc = json_decode($patientData->mlc);
                                @endphp
                                <div class="col-md-4">
                                    <h5>MLC Details</h5>
                                    <p><strong>Case ID:</strong> {{ $mlc->case_id }}
                                    <p>
                                    <p><strong>Police Station:</strong> {{ $mlc->police_station }}
                                    <p>
                                    <p><strong>Officer Name:</strong> {{ $mlc->officer_name }}
                                    <p>
                                    <p><strong>Officer Contact:</strong> {{ $mlc->officer_name }}
                                    <p>
                                </div>
                                <div class="col-md-4">
                                    <h5>Other Details</h5>
                                    <div>
                                        <div><strong>Document:</strong></div>
                                        @if (isset($mlc->document))
                                            <div>
                                                {{-- <a href="{{ asset('uploads/emergency/' . $mlc->document ) }}"
                                                   target="_blank"
                                                   class="btn btn-sm btn-info">Download</a> --}}

                                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                                    data-target="#viewDocument">View Document
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if ($patientData->mlc !== null)
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="h5">MLC Case Details:</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $mlc->case_details ?? '' }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- view document popup --}}
                    <div class="modal fade" id="viewDocument" tabindex="-1" aria-labelledby="viewDocumentLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="h3" id="viewDocumentLabel">View Document</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <embed src="{{ asset('uploads/emergency/' . $mlc->document) }}" type="application/pdf"
                                           width="100%" height="600px">
                                </div>
                            </div>
                        </div>
                    </div>




                    {{-- edit popup --}}
                    <div class="modal fade" id="editPatient" tabindex="-1" aria-labelledby="editPatientLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('opd.update', ['id' => $patientData->patient->id]) }}"
                                    method="POST">@csrf
                                    <div class="modal-header">
                                        <h3 class="h3" id="editPatientLabel">Edit Patient Information</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class=" form-group">
                                            <label for="patient_id">ID</label>
                                            <input type="text" class="form-control" id="patient_id" name="patient_id"
                                                value="{{ $patientData->patient->patient_id }}" readonly>
                                        </div>
                                        <div class=" form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $patientData->patient->name }}">
                                        </div>
                                        <div class=" form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="male"
                                                    {{ $patientData->patient->gender == 'male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="female"
                                                    {{ $patientData->patient->gender == 'female' ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                                <option value="other"
                                                    {{ $patientData->patient->gender == 'other' ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                        </div>
                                        <div class=" form-group">
                                            <label for="age">Age</label>
                                            <input type="text" class="form-control" id="age" name="age"
                                                value="{{ $patientData->patient->age }}">
                                        </div>
                                        <div class=" form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $patientData->patient->address }}">
                                        </div>
                                        <div class=" form-group">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                value="{{ $patientData->patient->mobile }}">
                                        </div>

                                        <!-- Update Button -->
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-4">
                        <button class="btn btn-sm btn-primary my-2" id="admit-patient-btn">Admit Patient</button>
                        <button class="btn btn-sm btn-info my-2" id="assignOT">OT Order</button>
                        <button class="btn btn-sm btn-success my-2" data-toggle="modal"
                            data-target="#medicalTest">Pathological Test
                        </button>
                    </div>
                    <form id="test-id" action="{{ route('emergency.store', ['id' => $patientData->id]) }}"
                        method="POST">@csrf

                        {{-- Admit Patient --}}
                        <div class="d-none" id="admit-patient">
                            <div class="modal-header">
                                <h2 class="h2">Admit Patient</h2>
                                <button type="button" class="close" id="close-admit"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>

                            <input type="number" hidden name="need_admit" id="need-admit" value="0">

                            <div class="row modal-body px-4">
                                <div class="col-12 form-group">
                                    <label for="otDate">Remark:</label>
                                    <textarea class="form-control" name="admit_remark" rows="4"></textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Medical Test Popup --}}
                        <div class="modal fade" id="medicalTest" tabindex="-1" aria-labelledby="medicalTestLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="medicalTestLabel">Medical Test</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="testList">Available Tests:</label>
                                            <div id="testList" class="form-check">
                                                <div class="row">
                                                    @foreach ($testLists as $item)
                                                        <div class="form-check col-md-4">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="tests[{{ $item->id }}]"
                                                                value="{{ $item->name }}"
                                                                id="test{{ $item->id }}">
                                                            <label class="form-check-label"
                                                                for="test{{ $item->id }}">{{ $item->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- OT Order --}}
                        <div class="d-none" id="ot-order">
                            <div class="modal-header">
                                <h2 class="h2">Create OT Order</h2>
                                <button type="button" class="close" id="close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>

                            <input type="number" hidden name="need_ot" id="need-ot" value="0">

                            <div class="row modal-body px-4">
                                <div class="col-md-3 form-group">
                                    <label for="otDate">Date</label>
                                    <input type="date" class="form-control" id="otDate" name="ot_date">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="otTime">Time</label>
                                    <input type="time" class="form-control" id="otTime" name="ot_time">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="otDoctor">Assign OT Doctor</label>
                                    <select class="form-control" id="otDoctor" name="doctor_id">
                                        <option>Select Doctor</option>
                                        @foreach ($doctors as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                    <label for="ot-name">Operation Name</label>
                                    <select class="form-control" id="ot-name" name="service_id">
                                        <option>Select Operation</option>
                                        @foreach ($operations as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>

                                </div>


                            </div>
                        </div>


                        <div class="card-body">
                            @include('components.generate-prescription')
                        </div>
                    </form>
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

            // otDoctor select2
            $("#otDoctor").select2({
                placeholder: "Select Doctor",
            });
            $("#ot-name").select2({
                placeholder: "Select Operation",
            });
        });
    </script>

    <script>
        $(function() {
            $("#assignOT").click(function() {
                $("#ot-order").removeClass("d-none");
                $("#need-ot").val(1);
            });
            $("#close").click(function() {
                $("#ot-order").addClass("d-none");
                $("#need-ot").val(0);
                // reset form
                $("#otDate").val("");
                $("#otTime").val("");
                $("#otDoctor").val("").trigger("change");
                $("#ot-name").val("");
                $("#type").val("");
            });
        });

        $(function() {
            $("#admit-patient-btn").click(function() {
                $("#admit-patient").removeClass("d-none");
                // $("#need-admit").
                // need-admit value set to 1
                $("#need-admit").val(1);
            });
            $("#close-admit").click(function() {
                $("#admit-patient").addClass("d-none");
                $("#need-admit").val(0);
                // reset form
                $("#admit_remark").val("");
            });
        });
    </script>
@endpush
