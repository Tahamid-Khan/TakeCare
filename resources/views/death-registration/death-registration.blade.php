@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Death Registration</h2>
                <div class="card-body">
                    <form action="{{ route('death-registration.store') }}" method="POST">@csrf
                        <!-- Deceased Information -->
                        <legend>Deceased Information</legend>
                        <fieldset class="row">
                            <!-- Full Name -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="patientName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="patientName" name="patient_name" required>
                            </div>

                            <!-- Patient ID -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="patientId" class="form-label">Patient ID</label>
                                <input type="text" class="form-control" id="patientId" name="patient_id" required>
                            </div>

                            <!-- Age -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age">
                            </div>

                            <!-- Father's Name -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="fatherName" class="form-label">Father's Name</label>
                                <input type="text" class="form-control" id="fatherName" name="father_name">
                            </div>

                            <!-- Mother's Name -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="motherName" class="form-label">Mother's Name</label>
                                <input type="text" class="form-control" id="motherName" name="mother_name">
                            </div>

                            <!-- Spouse's Name -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="spouseName" class="form-label">Spouse's Name</label>
                                <input type="text" class="form-control" id="spouseName" name="spouse_name">
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>

                            <!-- Gender -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Religion -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="religion" class="form-label">Religion</label>
                                <input type="text" class="form-control" id="religion" name="religion">
                            </div>

                            <!-- Nationality -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="national" class="form-label">Nationality</label>
                                <input type="text" class="form-control" id="national" name="national">
                            </div>

                            <!-- Address -->
                            <div class="col-12 col-md-4 col-lg-3 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3"
                                          placeholder="Enter address..."></textarea>
                            </div>
                        </fieldset>

                        <!-- Death Details -->
                        <fieldset class="mt-4">
                            <legend>Death Details</legend>
                            <div class="row">
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="deathDate" class="form-label">Date of Death</label>
                                    <input type="date" class="form-control" id="deathDate" name="death_date" required>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="timeOfDeath" class="form-label">Time of Death</label>
                                    <input type="time" class="form-control" id="timeOfDeath" name="time_of_death">
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="deathCause" class="form-label">Cause of Death</label>
                                    <select class="form-control" id="deathCause" name="death_cause" required>
                                        <option value="" selected disabled>Select Cause of Death</option>
                                        <option value="natural">Natural</option>
                                        <option value="unnatural">Unnatural</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Natural Death Section -->
                            <div id="naturalDeathSection" class="d-none">
                                <div class="mb-3">
                                    <label for="deathDetails" class="form-label">Death Details</label>
                                    <textarea class="form-control" id="deathDetails" name="death_details" rows="3"
                                              placeholder="Enter death details..."></textarea>
                                </div>
                            </div>

                            <!-- Unnatural Death Section -->
                            <div id="unnaturalDeathSection" class="card-body d-none">

                                <div class="alert alert-warning">
                                    <strong>Unnatural Death:</strong> This case will be flagged for law enforcement
                                    authorities.
                                </div>

                                <div class="mb-3">
                                    <label for="unnaturalDetails" class="form-label">Details of Unnatural Death</label>
                                    <textarea class="form-control" id="unnaturalDetails"
                                              name="unnatural_details"></textarea>
                                </div>

                                <div class="mb-3">
                                    <legend>Law Enforcement Details</legend>
                                    <fieldset class="row">
                                        <div class="col-12 col-md-3 mb-3">
                                            <label for="caseNumber" class="form-label">Case Number</label>
                                            <input type="text" class="form-control" id="caseNumber" name="case_number">
                                        </div>

                                        <div class="col-12 col-md-3 mb-3">
                                            <label for="policeStation" class="form-label">Police Station</label>
                                            <input type="text" class="form-control" id="policeStation" name="police_station">
                                        </div>

                                        <div class="col-12 col-md-3 mb-3">
                                            <label for="reportingOfficer" class="form-label">Reporting Officer's
                                                Name</label>
                                            <input type="text" class="form-control" id="reportingOfficer"
                                                   name="reporting_officer">
                                        </div>
                                        <div class="col-12 col-md-3 mb-3">
                                            <label for="officerContact" class="form-label">Officer's Contact
                                                Number</label>
                                            <input type="tel" class="form-control" id="officerContact"
                                                   name="officer_contact">
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Next of Kin Details  -->
                        <fieldset class="mt-4">
                            <legend>Next of Kin Details</legend>
                            <div class="row">
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           required>
                                </div>

                                <div class="col-12 col-md-4 mb-3">
                                    <label for="nid" class="form-label">National ID Number</label>
                                    <input type="text" class="form-control" id="nid" name="nid">
                                </div>

                                <div class="col-12 col-md-4 mb-3">
                                    <label for="relationship" class="form-label">Relationship to Deceased</label>
                                    <input type="text" class="form-control" id="relationship" name="relationship" required>
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="contactNumber" class="form-label">Contact Number</label>
                                    <input type="tel" class="form-control" id="contactNumber" name="contact_number">
                                </div>
                                <div class="col-12 col-md-4 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address_" rows="3"
                                              placeholder="Enter address..."></textarea>
                                </div>
                            </div>
                        </fieldset>

                        <!-- Additional Information -->
                        <fieldset class="mt-4">
                            <legend>Additional Information</legend>
                            <div class="row">
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="doctorName" class="form-label">Doctor's Name</label>
                                    <input type="text" class="form-control" id="doctorName" name="doctor_name">
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="hospitalName" class="form-label">Hospital Name</label>
                                    <input type="text" class="form-control" id="hospitalName" name="hospital_name">
                                </div>
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        document.getElementById('deathCause').addEventListener('change', function () {
            const selectedCause = this.value;
            const naturalDeathSection = document.getElementById('naturalDeathSection');
            const unnaturalDeathSection = document.getElementById('unnaturalDeathSection');

            if (selectedCause === 'unnatural') {
                naturalDeathSection.classList.add('d-none');
                unnaturalDeathSection.classList.remove('d-none');
            } else if (selectedCause === 'natural') {
                naturalDeathSection.classList.remove('d-none');
                unnaturalDeathSection.classList.add('d-none');
            } else {
                naturalDeathSection.classList.add('d-none');
                unnaturalDeathSection.classList.add('d-none');
            }
        });
    </script>
@endpush
