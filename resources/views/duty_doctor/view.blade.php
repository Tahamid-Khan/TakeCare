@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h2 class="card-header h2 p-3">Patient Details</h2>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>ID : </strong>{{ $patientLists->patient_id }} </p>
                                        <p class="my-2"><strong>Name : </strong>{{ $patientLists->name }} </p>
                                        <p class="my-2"><strong>Gender : </strong>{{ $patientLists->gender }} </p>
                                        <p class="my-2"><strong>Age : </strong>{{ $patientLists->age }} </p>
                                        <p class="my-2"><strong>Address : </strong>{{ $patientLists->address }} </p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>Blood Group : </strong>{{ $patientLists->blood_group }}
                                        </p>
                                        <p class="my-2"><strong>Mobile : </strong>{{ $patientLists->mobile }} </p>
                                        <p class="my-2"><strong>Guardian No
                                                :</strong>{{ $patientLists->guardian_mobile }} </p>
                                        <p class="my-2"><strong>Summary : </strong>{{ $patientLists->patient_summary }}
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>Doctor : </strong>{{ $doctor->name }} </p>
                                        <p class="my-2"><strong>Type : </strong>{{ $patientLists->patient_type }} </p>
                                        <p class="my-2"><strong>Reference : </strong>{{ $patientLists->reference }} </p>
                                    </div>
                                </div>


                                <div class="">
                                    @include('components.tab-item')
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
