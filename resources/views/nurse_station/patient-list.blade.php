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
                                <h3 class="card-title">Patient Lists</h3>
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
                                        <th>Department</th>
{{--                                        <th>Assigned Doctor</th>--}}
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        @php
                                            $i = 1;
                                            // dd($patientlists);
                                        @endphp
                                        @foreach ($patients as $item)
                                            <tr>
                                                <td>{{ $item->patient_id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->gender }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->department }}</td>
{{--                                                <td>{{ $item->doctor->name }}</td>--}}
                                                <td>
                                                    <a href="{{ route('nurse.patientDetails', $item->id) }}"
                                                        class="btn btn-sm btn-info my-2" title="View">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a>

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
        $(function() {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
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
