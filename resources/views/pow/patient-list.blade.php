@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .bg-danger-light {
            background-color: #f8d7da;
        }

        .bg-primary-light {
            background-color: #d1ecf1;
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">POW Patient Lists</h2>
                <div class="p-4 rounded-lg">

                    <div class="row mb-4">
                        <!-- Card 1 -->
                        <div class="col-12 col-md-3 mb-4">
                            <div class="rounded-lg bg-danger-light p-3 shadow">
                                <h3 class="mb-2 h5">Total POW Patients</h3>
                                <p class="h3 font-weight-bold text-danger">{{ count($patientsData) }}</p>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12 col-md-3 mb-4">
                            <div class="rounded-lg bg-primary-light p-3 shadow">
                                <h3 class="mb-2 h5">Empty Beds</h3>
                                <p class="h3 font-weight-bold text-primary">{{ $emptyBeds }}</p>
                            </div>
                        </div>
                    </div>


                    <div class="">
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Gender</th>
                            <th>Assigned Doctor</th>
                            <th>OT Doctor</th>
                            <th>POW Bed No</th>
                            <th>Action</th>
                            </thead>

                            <tbody>

                            @foreach ($patientsData as $item)
                                <tr>
                                    <td>{{ $item->operation->patient->patient_id }}</td>
                                    <td>{{ $item->operation->patient->name }}</td>
                                    <td>{{ $item->operation->patient->gender }}</td>
                                    <td>{{ $item->doctor->name }}</td>
                                    <td>{{ $item->operation->doctor->name }}</td>
                                    <td>{{ $item->bed->bed_number }}</td>
                                    <td>
                                        <a href="{{ route('pow.patientInfo', ['id' => $item->id]) }}"
                                           class="btn btn-sm btn-info my-2" title="View">
                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
