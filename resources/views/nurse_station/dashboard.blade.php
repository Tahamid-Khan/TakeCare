@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <style>
                    .bg-danger-light {
                        background-color: #f8d7da;
                    }

                    .bg-primary-light {
                        background-color: #d1ecf1;
                    }

                    .font-semibold {
                        font-weight: 600;
                    }

                    .display-4 {
                        font-size: 2rem;
                        font-weight: 700;
                    }
                </style>
                <h2 class="card-header h2 font-weight-bold">Patient Lists</h2>
                <div class=" rounded-lg" style="background-color: #f8f9fa">

                    <div class="row mb-4 p-4">
                        <div class="col-12 col-lg-12">
                            <div class="row">
                                <!-- Card 1 -->
                                <div class="col-12 col-md-4 col-xl-3 mb-4">
                                    <div class="rounded-lg bg-danger-light p-3 shadow">
                                        <h3 class="mb-2 h5">Total POW Patients</h3>
                                        <p class="h3 font-weight-bold text-danger">236</p>
                                    </div>
                                </div>

                                <!-- Card 2 -->
                                <div class="col-12 col-md-4 col-xl-3 mb-4">
                                    <div class="rounded-lg bg-primary-light p-3 shadow">
                                        <h3 class="mb-2 h5">Pending Discharge</h3>
                                        <p class="h3 font-weight-bold text-primary">2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-secondary active" id="custom-content-below-patients-tab" data-toggle="pill"
                            href="#custom-content-below-patients" role="tab"
                            aria-controls="custom-content-below-patients" aria-selected="true">Patients</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-secondary" id="custom-content-below-current-duty-doctor-tab"
                            data-toggle="pill" href="#custom-content-below-current-duty-doctor" role="tab"
                            aria-controls="custom-content-below-current-duty-doctor" aria-selected="true">Duty
                            Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" id="custom-content-below-temporary-doctor-tab" data-toggle="pill"
                            href="#custom-content-below-temporary-doctor" role="tab"
                            aria-controls="custom-content-below-temporary-doctor" aria-selected="false">Temporary
                            Doctors</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link text-secondary" id="custom-content-below-pow-info-tab" data-toggle="pill"
                            href="#custom-content-below-pow-info" role="tab"
                            aria-controls="custom-content-below-pow-info" aria-selected="false">POW Patients</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link text-secondary" id="custom-content-below-discharge-info-tab" data-toggle="pill"
                            href="#custom-content-below-discharge" role="tab"
                            aria-controls="custom-content-below-pow-info" aria-selected="false">Discharge Patient</a>
                    </li>

                </ul>


                <div class="tab-content card " id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="custom-content-below-patients" role="tabpanel"
                        aria-labelledby="custom-content-below-patients-tab">
                        @include('nurse_station.nurse-dashboard-patients')
                    </div>

                    <div class="tab-pane fade" id="custom-content-below-current-duty-doctor" role="tabpanel"
                        aria-labelledby="custom-content-below-current-duty-doctor-tab">
                        @include('components.current-duty-doctor')
                    </div>

                    <div class="tab-pane fade" id="custom-content-below-temporary-doctor" role="tabpanel"
                        aria-labelledby="custom-content-below-temporary-doctor-tab">
                        @include('components.temporary-doctor')
                    </div>
                    {{-- <div class="tab-pane fade" id="custom-content-below-pow-info" role="tabpanel"
                        aria-labelledby="custom-content-below-pow-info-tab">
                        @include('components.pow-info')
                    </div> --}}
                    <div class="tab-pane fade" id="custom-content-below-discharge" role="tabpanel"
                        aria-labelledby="custom-content-below-discharge-info-tab">
                        @include('components.discharge-patient')
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(function() {
            $(".classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    {{-- <script>
        $(document).ready(function () {
            // Initialize DataTables on each table in all tabs
            $('.tab-pane').each(function() {
                $(this).find('table').DataTable();
            });

            // Re-initialize DataTables when a tab is shown
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href"); // activated tab
                $(target).find('table').DataTable();
            });
        });
    </script> --}}

@endpush
