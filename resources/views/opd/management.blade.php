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
                                <h3 class="h3">OPD Management - Doctor List</h3>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="doctorList">
                                    <thead>
                                        <th>Doctor Name</th>
                                        <th>Today's Patients</th>
                                        <th>Future Patients</th>
                                        <th>Latest Patient</th>
                                        <th>Total Pending</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($opdDoctors as $doctor)
                                            <tr>
                                                <td>
                                                    <strong>{{ $doctor->name }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success">{{ $doctor->today_patients_count }}</span>
                                                    <br>
                                                    <small class="text-muted">{{ date('Y-m-d') }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $doctor->future_patients_count }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $doctor->latest_patient_name }}</strong>
                                                    <br>
                                                    <small class="text-muted">Most recent</small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">{{ $doctor->pending_patients_count }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('opd.management.doctor-patients', $doctor->id) }}" 
                                                       class="btn btn-sm btn-success" title="View All Patients">
                                                        <i class="fas fa-users" aria-hidden="true"></i>
                                                        View Patients
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        $(function() {
            $("#doctorList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false
            });
        });
    </script>
@endpush