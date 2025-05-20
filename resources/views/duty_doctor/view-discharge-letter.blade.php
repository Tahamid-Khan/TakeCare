@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="card">
                    @if($dischargeInfo->status == 'generated')
                        @userType('doctor', 'admin')
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary my-2" data-toggle="modal" data-target="#dischargeApproveModal">Approve Discharge Letter
                            </button>
                        </div>
                        @enduserType
                    @endif
                    <div class="modal fade" id="dischargeApproveModal" tabindex="-1" aria-labelledby="dischargeApproveModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="h5" id="dischargeApproveModalLabel">Discharge Approval</h5>
                                    {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to approve this discharge letter?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <form action="{{ route('patient.discharge-request') }}" method="POST">@csrf
                                        <input type="hidden" name="id" value="{{ $dischargeInfo->id }}">
                                        <input type="hidden" name="doctor_id" value="{{ $patient->patientDoctorAssignment[0]->doctor->id ?? '' }}">
                                        <input type="checkbox" name="approve" checked hidden>
                                        <button type="submit" class="btn btn-primary">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="card-header h2">
                        <strong>Patient Information</strong>
                    </h2>
                    <div class="p-4">
                        <div class="row card-body">
                            <div class="col-12 col-md-4 col-xl-3 py-2">
                                <div>
                                    <strong>Patient ID:</strong> {{ $patient->patient_id }}
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-xl-3 py-2">
                                <div>
                                    <strong>Name:</strong> {{ $patient->name }}
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-xl-3 py-2">
                                <div>
                                    <strong>Age:</strong> {{ $patient->age }}
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-xl-3 py-2">
                                <div>
                                    <strong>Gender:</strong> {{ $patient->gender }}
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-3 py-2">
                                <div>
                                    <strong>Admission Date:</strong> {{ $patient->created_at }}
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-3 py-2">
                                <div>
                                    <strong>Discharge Date:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-3 py-2">
                                <div>
                                    <strong>Doctor:</strong>
                                    {{ $patient->patientDoctorAssignment[0]->doctor->name ?? '' }}
                                </div>
                            </div>

                            <div class="col-12 col-md-4 col-xl-3 py-2">
                                <div>
                                    <strong>Department:</strong>
                                    {{ $patient->patientDoctorAssignment[0]->doctor->department->name  ?? '' }}
                                </div>
                            </div>
                        </div>


                        <h3 class="text-center mt-4 h3">
                            <strong>Discharge Summary</strong>
                        </h3>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="reason-for-admission">Reason for Admission</label>
                                <div>{{ $dischargeDetails->reason_for_admission }}</div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="medical-summary">Final Primary Diagnosis </label>
                                <p class="small text-primary">At the conclusion of the hospital stay, state the primary diagnosis/reason for the hospitalization.</p>
                                <div>{{ $dischargeDetails->reason_for_admission }}</div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="investigation">Investigation</label>
                                <div>{{ $dischargeDetails->investigation }}</div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="risk-factor">Risk Factor</label>
                                <div>{{ $dischargeDetails->risk_factor }}</div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="case-summary">Case Summary</label>
                                <div>{{ $dischargeDetails->case_summary }}</div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="medications">Medications</label>
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
                                <div>{{ $dischargeDetails->discharge_instructions }}</div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="recommendation">Recommendation</label>
                                <div>{{ $dischargeDetails->recommendation }}</div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="follow-up">Follow Up</label>
                                <div>{{ $dischargeDetails->follow_up }}</div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-12 col-md-4">
                                <label for="next-follow-up">Next Follow Up</label>
                                <div>{{ $dischargeDetails->next_follow_up }}</div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12 text-center">
                            <h5 class="h5 text-primary">
                                <i>Thank you for choosing our hospital. We wish you a speedy recovery!</i>
                            </h5>
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
