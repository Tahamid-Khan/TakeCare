@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .bg-danger-light {
            background-color: #f8d7da;
        }

        .bg-warning-light {
            background-color: #fff3cd;
        }

        .font-semibold {
            font-weight: 600;
        }

        .display-4 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .shadow-md {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>


    <div class="content-wrapper">
        <section class="content">
            <h2 class="card-header h2">ICU Dashboard</h2>
            <div class="mb-4 rounded-lg bg-white p-4 shadow-md">

                <div class="row mb-4">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                    <h3 class="mb-2 h5">Patients in ICU</h3>
                                    <p class="h3 font-weight-bold text-danger">{{ $icuPatientsCount }}</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-warning-light p-3 shadow">
                                    <h3 class="mb-2 h5">Patients in HDU</h3>
                                    <p class="h3 font-weight-bold text-warning">{{ $hduPatientsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-secondary active" id="custom-content-below-current-patients-tab" data-toggle="pill"
                           href="#custom-content-below-current-patients" role="tab"
                           aria-controls="custom-content-below-current-patients" aria-selected="true">Current Patients</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" id="custom-content-below-previous-patient-tab"
                           data-toggle="pill" href="#custom-content-below-previous-patient" role="tab"
                           aria-controls="custom-content-below-previous-patient" aria-selected="true">Previous Patient</a>
                    </li>
                </ul>


                <div class="tab-content card " id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="custom-content-below-current-patients" role="tabpanel"
                         aria-labelledby="custom-content-below-current-patients-tab">
                        @include('icu.current-patient')
                    </div>

                    <div class="tab-pane fade" id="custom-content-below-previous-patient" role="tabpanel"
                         aria-labelledby="custom-content-below-previous-patient-tab">
                        @include('icu.previous-patient')
                    </div>
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

            $("#classList2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
