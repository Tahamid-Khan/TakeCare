@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Admit Patient for Operation</h3>
                            </div>


                            <div class="container mt-4">
                                <form action="{{ route('ot.add-patient') }}" method="POST">@csrf
                                    <div class="row">
                                        <input type="text" hidden value="{{ $patientData->id }}" name="patient_id">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="patient-id">Patient ID</label>
                                            <input type="text" disabled class="form-control" id="patient-id"
                                                   value="{{ $patientData->patient_id }}">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="assign-doctor">Doctor*</label>
                                            <select class="form-control" id="assign-doctor" name="doctor_id">
                                                <option selected disabled>Please Select</option>
                                                @foreach($doctors as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="date">Operation Date*</label>
                                            <input type="date" class="form-control" id="date" name="operation_date">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="time">Operation Time*</label>
                                            <input type="time" class="form-control" id="time" name="operation_time">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="name">Operation Name*</label>
                                            <input type="text" class="form-control" id="name" name="operation_name">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="type">Operation Type*</label>
                                            <input type="text" class="form-control" id="type" name="operation_type">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
{{-- @push('custom_js')
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
@endpush --}}
