<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    @media print {
        /* style sheet for print goes here */
        .hide-from-printer {
            display: none;
        }
    }
</style>
<body>
{{-- Print Button --}}
<div class="text-right">
    <button class="hide-from-printer" onclick="printpage()">Print</button>
</div>

<script>
    function printpage() {
        window.print();
    }
</script>
<div class="content-wrapper">
    <section class="content">
        <div class="">
            <div class="">
                <div class="">
                    <h2 class="text-center mb-4"><strong>Patient Information</strong></h2>

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>Patient ID:</th>
                            <td>{{ ($patient->patient_id) ? $patient->patient_id : 'N/A' }}</td>
                            <th>Name:</th>
                            <td>{{ $patient->name }}</td>
                        </tr>
                        <tr>
                            <th>Age:</th>
                            <td>{{ $patient->age }}</td>
                            <th>Gender:</th>
                            <td>{{ $patient->gender }}</td>
                        </tr>
                        <tr>
                            <th>Admission Date:</th>
                            <td>{{ $patient->created_at }}</td>
                            <th>Discharge Date:</th>
                            <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <th>Doctor:</th>
                            <td>
                                {{ optional($patient->patientDoctorAssignment->first())->doctor->name ?? 'N/A' }}
                            </td>
                            <th>Department:</th>
                            <td>
                                {{ optional($patient->patientDoctorAssignment->first())->doctor->department->name ?? 'N/A' }}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <h3 class="text-center mt-5"><strong>Discharge Summary</strong></h3>

                    <div class="card my-4">
                        <div class="card-header h5">Reason for Admission:</div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->reason_for_admission }}</p>
                        </div>
                    </div>

                    <div class="card my-4">
                        <div class="card-header h5">Final Primary Diagnosis: <span class="small text-muted">At the conclusion of the hospital stay, state the primary diagnosis/reason
                  for the hospitalization.</span></div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->reason_for_admission }}</p>
                        </div>
                    </div>

                    <div class="card my-4">
                        <div class="card-header h5">Investigation:</div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->investigation }}</p>
                        </div>
                    </div>

                    <div class="card my-4">
                        <div class="card-header h5">Risk Factor:</div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->risk_factor }}</p>
                        </div>
                    </div>

                    <div class="card my-4">
                        <div class="card-header h5">Case Summary:</div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->case_summary }}</p>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="medications" class="h5">Medications</label>
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

                    <div class="card my-4">
                        <div class="card-header h5">Discharge Instructions:</div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->discharge_instructions }}</p>
                        </div>
                    </div>


                    <div class="card my-4">
                        <div class="card-header h5">Recommendation:</div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->recommendation }}</p>
                        </div>
                    </div>


                    <div class="card my-4">
                        <div class="card-header h5">Follow Up:</div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->follow_up }}</p>
                        </div>
                    </div>


                    <div class="card my-4">
                        <div class="card-header h5">Next Follow Up:</div>
                        <div class="card-body">
                            <p class="card-text">{{ $dischargeDetails->next_follow_up }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <h5 class="text-primary"><i>Thank you for choosing our hospital. We wish you a speedy
                                recovery!</i></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

</body>

</html>
