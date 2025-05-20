@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <style>
                                .bg-danger-light {
                                    background-color: #f8d7da;
                                }
                            </style>
                            <h2 class="card-header h2 font-weight-bold">Patient Lists</h2>
                            <div class="rounded-lg p-4 " style="background-color: #f8f9fa">

                                <div class="row mb-4">
                                    <div class="col-12 col-lg-12">
                                        <div class="row">
                                            <!-- Card 1 -->
                                            <div class="col-12 col-md-3 mb-4">
                                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                                    <h3 class="mb-2 h5">Total Patients</h3>
                                                    <p class="h3 font-weight-bold text-danger">154</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="text-right">
                                    <a class="btn btn-sm btn-secondary" title="Patient"
                                        href="{{ route('reception.create') }}" style="line-height: 1.5 !important;">
                                        <i class="fas fa-pus"></i> Add Patient
                                    </a>
                                </div> --}}
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                    <th>Patient ID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Mobile</th>
                                    {{-- <th>Department</th> --}}
                                    <th>Assigned Doctor</th>
                                    {{--                                        <th>Cabin/Ward</th>--}}
                                    <th>View Patient</th>
                                    <th>Discharge Letter</th>
                                    </thead>

                                    <tbody>

                                    @foreach ($patientLists as $k => $patientList)
                                        <tr>
                                            <td>{{ $patientList->patient_id }}</td>
                                            <td>{{ $patientList->name }}</td>
                                            <td>{{ $patientList->gender }}</td>
                                            <td>{{ $patientList->mobile }}</td>
                                            {{-- <td>{{ $patientList->department }}</td> --}}
                                            <td>{{ $patientList->doctor->name }}</td>
                                            {{--                                                <td>{{ $patientList->cavin->name }}</td>--}}
                                            <td>
                                                <a href="{{ route('duty-doctor.view', $patientList->id) }}"
                                                   class="btn btn-sm btn-info my-2" title="View Patient">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                </a>
                                                {{-- <a href=""
                                                    class="btn btn-sm btn-success my-2" title="Edit">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <a onclick="deleteConfirm({{ $patientList->id }})"
                                                    class="btn btn-sm btn-danger my-2" title="Delete">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </a> --}}
                                            </td>
                                            <td>
                                                @if(isset($patientList->patientDischarge[0]))
                                                    {{--                                                    <a href="{{ route('duty-doctor.view-discharge-letter', $patientList->id) }}"--}}
                                                    {{--                                                       class="btn btn-sm btn-info my-2" title="View Discharge Letter">--}}
                                                    {{--                                                        <i class="fas fa-eye" aria-hidden="true"></i>--}}
                                                    {{--                                                    </a>--}}
                                                    @if($patientList->patientDischarge[0]->status == 'generated')
                                                        <a href="{{ route('duty-doctor.view-discharge-letter', $patientList->patientDischarge[0]->id) }}"
                                                           class="btn btn-sm btn-primary my-2"
                                                           title="Generate Discharge Letter">
                                                            Approve
                                                        </a>
                                                    @elseif($patientList->patientDischarge[0]->status == 'doctor_approved')
                                                        <a href="{{ route('duty-doctor.view-discharge-letter',$patientList->patientDischarge[0]->id) }}"
                                                           class="btn btn-sm btn-info my-2"
                                                           title="View Discharge Letter"><i class="fas fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <p>----</p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {{-- <div class="card-body">
                                @include('components.tab-item')
                            </div> --}}

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
                "order": [[6, "asc"]],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        // function deleteConfirm(id) {
        //     var token = $("meta[name='csrf-token']").attr("content");
        //     if (confirm("Are you sure to delete this record!")) {
        //         $.ajax({
        //             url: ,
        //             type: 'get',
        //             success: function(status) {
        //                 if (status.status == 1) {
        //                     window.location.reload();
        //                 }
        //             }
        //         })
        //     }
        // }
    </script>
@endpush
