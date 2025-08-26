@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h3 class="card-header h2">Patient Information</h3>

                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>ID
                                                : </strong>{{ $patientData->operation->patient->patient_id }} </p>
                                        <p class="my-2"><strong>Name
                                                : </strong>{{ $patientData->operation->patient->name }} </p>
                                        <p class="my-2"><strong>Gender
                                                : </strong>{{ $patientData->operation->patient->gender }} </p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>Age
                                                : </strong>{{ $patientData->operation->patient->age }} </p>
                                        <p class="my-2"><strong>Address
                                                : </strong>{{ $patientData->operation->patient->address }} </p>
                                        <p class="my-2"><strong>Blood Group
                                                : </strong>{{ $patientData->operation->patient->blood_group }} </p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>Mobile
                                                : </strong>{{ $patientData->operation->patient->mobile }} </p>
                                        <p class="my-2"><strong>Guardian No
                                                : </strong>{{ $patientData->operation->patient->guardian_mobile }} </p>
                                        <p class="my-2"><strong>Summary
                                                : </strong>{{ $patientData->operation->patient->patient_summary ?? 'No summary available' }} </p>
                                    </div>
                                    {{--<div class="col-4">--}}
                                    {{--  <p>Doctor : {{ $doctor->name }} </p>--}}
                                    {{--  <p>Cabin/Ward : {{ $cavin->name }} </p>--}}
                                    {{--  <p>Type : {{ $patientLists->patient_type }} </p>--}}
                                    {{--  <p>Department : {{ $patientLists->department }} </p>--}}
                                    {{--  <p>Reference : {{ $patientLists->reference }} </p>--}}
                                    {{--</div>--}}
                                </div>


                                <div class="">
                                    @include('pow.pow-tab-item')
                                </div>
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
    </script>
@endpush
