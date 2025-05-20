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
                                <h3 class="h3">Emergency Patient Registration</h3>
                            </div>


                            <div class="p-4 mt-4">
                                    {{--                                    hidden field--}}
                                <form action="{{ route('reception.emergency-registration.store') }}" method="post"
                                      enctype="multipart/form-data">@csrf
                                    <input type="text" hidden name="patient_id" value="{{ $patientData->id ?? '' }}">
                                    <div class="row">
                                        <!--Name-->
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="{{ $patientData->name ?? '' }}">
                                        </div>

                                        <!--Age-->
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" id="age" name="age"
                                                   value="{{ $patientData->age ?? '' }}">
                                        </div>

                                        <!--Gender-->
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option disabled>Please Select</option>
                                                <option
                                                    {{ isset($patientData->gender) && $patientData->gender == 'Male' ? 'Selected' : '' }} value="Male">
                                                    Male
                                                </option>
                                                <option
                                                    {{ isset($patientData->gender) && $patientData->gender == 'Female' ? 'Selected' : '' }} value="Female">
                                                    Female
                                                </option>
                                                <option
                                                    {{ isset($patientData->gender) && $patientData->gender == 'Other' ? 'Selected' : '' }} value="Other">
                                                    Other
                                                </option>
                                            </select>
                                        </div>

                                        <!--Mobile-->
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="p-Number">Phone Number</label>
                                            <input type="text" class="form-control" id="p-Number"
                                                   name="mobile" value="{{ $patientData->mobile ?? '' }}">
                                        </div>


                                        <!--Assign Doctor-->
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="doctor">Assign Doctor</label>
                                            <select class="form-control" id="doctor_id" name="doctor_id">
                                                <option selected disabled>Please Select</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!--Patient Type-->
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="patient_type">Patient Type</label>
                                            <select class="form-control" id="patient_type" name="patient_type">
                                                <option disabled>Please Select</option>
                                                <option
                                                    {{ isset($patientData->patient_type) && $patientData->patient_type == 'General' ? 'Selected' : '' }} value="General">
                                                    General
                                                </option>
                                                <option
                                                    {{ isset($patientData->patient_type) && $patientData->patient_type == 'CBD' ? 'Selected' : '' }} value="C Board">
                                                    C Board
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="my-2 text-right">
                                        <button type="button" id="legal-case-btn" class="btn btn-primary">Legal Case
                                        </button>
                                        <input type="number" hidden name="need_case" id="need-case" value="0">
                                    </div>

                                    <div class="card-body my-2 d-none" id="legal-case-div">
                                        <div class="row justify-content-between">
                                            <h3 class="h3 pl-4">Medico Legal Case</h3>
                                            <!--Close button-->
                                            <div class="text-right">
                                                <button type="button" class="btn btn-danger btn-close">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row card-body">
                                            <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                                <label for="case-id">Case ID</label>
                                                <input type="text" class="form-control" id="case-id" name="case_id">
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                                <label for="police-station">Police Station</label>
                                                <input type="text" class="form-control" id="police-station"
                                                       name="police_station">
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                                <label for="officer-name">Officer Name</label>
                                                <input type="text" class="form-control" id="officer-name"
                                                       name="officer_name">
                                            </div>

                                            <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                                <label for="officer-contact">Officer Contact</label>
                                                <input type="text" class="form-control" id="officer-contact"
                                                       name="officer_contact">
                                            </div>

                                            <div class="col-12 form-group">
                                                <label for="case-details">Case Details</label>
                                                <textarea class="form-control" id="case-details"
                                                          name="case_details"></textarea>
                                            </div>

                                            <!--File Upload-->
                                            <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                                <label for="documents">Document</label>
                                                <input type="file" class="form-control" id="documents" name="document">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <button type="submit" class="btn btn-success">Register</button>
                                        </div>
                                    </div>
                                </form>
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
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        $(document).ready(function () {
            $('#doctor_id').select2();

            $('#patient_type').change(function () {
                let patient_type = $(this).val();
                if (patient_type === 'C Board') {
                    $('#amount').val(10);
                    // $('#amount').attr('readonly', 'readonly');
                } else if (patient_type === 'General') {
                    $('#amount').val('20');
                    // $('#amount').removeAttr('readonly');
                }
            });
        });

        let needCase = $('#need-case');
        $('#legal-case-btn').click(function () {
            $('#legal-case-div').removeClass('d-none');
            $(this).addClass('d-none');
            needCase.val('1');
        });

        $('.btn-close').click(function () {
            $('#legal-case-div').addClass('d-none');
            $('#legal-case-btn').removeClass('d-none');
            needCase.val('0');
        });

    </script>
@endpush
