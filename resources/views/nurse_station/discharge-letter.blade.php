@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="card p-4">
                    <form action="{{ route('nurse.discharge-letter-store') }}" method="POST">@csrf
                        <input type="hidden" name="id" value="{{ $dischargeInfo->id }}">
                        <div class="container">
                            <h2 class="h2"><strong>Patient Information</strong></h2>
                            <div class="row">
                                <div class="col-12 col-md-4 col-xl-3 py-2">
                                    <div><strong>Patient ID:</strong> {{ $patient->patient_id }}</div>
                                </div>
                                <div class="col-12 col-md-4 col-xl-3 py-2">
                                    <div><strong>Name:</strong> {{ $patient->name }}</div>
                                </div>
                                <div class="col-12 col-md-4 col-xl-3 py-2">
                                    <div><strong>Age:</strong> {{ $patient->age }}</div>
                                </div>
                                <div class="col-12 col-md-4 col-xl-3 py-2">
                                    <div><strong>Gender:</strong> {{ $patient->gender }}</div>
                                </div>

                                <div class="col-12 col-md-4 col-xl-3 py-2">
                                    <div><strong>Admission Date:</strong> {{ $patient->created_at }}</div>
                                </div>

                                <div class="col-12 col-md-4 col-xl-3 py-2">
                                    <div><strong>Discharge Date:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}</div>
                                </div>

                                <div class="col-12 col-md-4 col-xl-3 py-2">
                                    <div><strong>Doctor:</strong>
                                        {{ $patient->patientDoctorAssignment[0]->doctor->name ?? '' }}</div>
                                </div>

                                <div class="col-12 col-md-4 col-xl-3 py-2">
                                    <div><strong>Department:</strong>
                                        {{ $patient->patientDoctorAssignment[0]->doctor->department->name ?? '' }}
                                    </div>
                                </div>
                            </div>



                            <h3 class="text-center mt-4 h3"><strong>Discharge Summary</strong></h3>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="reason-for-admission">Reason for Admission</label>
                                    <textarea class="form-control" id="reason-for-admission" name="reason_for_admission" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="medical-summary">Final Primary Diagnosis <span class="small text-primary">At the conclusion of the hospital stay, state the primary diagnosis/reason for the hospitalization.</span></label>
                                    <textarea class="form-control" id="medical-summary" name="medical_summary" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="investigation">Investigation</label>
                                    <textarea class="form-control" id="investigation" name="investigation" rows="3"></textarea>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="risk-factor">Risk Factor</label>
                                    <textarea class="form-control" id="risk-factor" name="risk_factor" rows="2"></textarea>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="case-summary">Case Summary</label>
                                    <textarea class="form-control" id="case-summary" name="case_summary" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="medications">Medications</label>
                                    {{-- <textarea class="form-control" id="medications" name="medications" rows="3"></textarea> --}}

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

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="discharge-instructions">Discharge Instructions</label>
                                    <textarea class="form-control" id="discharge-instructions" name="discharge_instructions" rows="3"></textarea>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="recommendation">Recommendation</label>
                                    <textarea class="form-control" id="recommendation" name="recommendation" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label for="follow-up">Follow Up</label>
                                    <textarea class="form-control" id="follow-up" name="follow_up" rows="3"></textarea>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-12 col-md-4">
                                    <label for="next-follow-up">Next Follow Up</label>
                                    <input type="date" class="form-control" id="next-follow-up" name="next_follow_up">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-success mt-5">Generate</button>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <h5 class="h5 text-primary"><i>Thank you for choosing our hospital. We wish you a speedy recovery!</i></h5>
                            </div>
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
        });
    </script>
@endpush
