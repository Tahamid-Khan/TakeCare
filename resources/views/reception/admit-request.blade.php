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
                                <h2 class="h2">Patient Admit to Ward/Cabin</h2>
                            </div>


                            <div class="card-body">
                                <div class="row my-2">
                                    <div class="col-md-12">
                                        <a href="{{ route('reception.create') }}" class="btn btn-primary">Manual Admit</a>
                                    </div>
                                </div>

                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Doctor ID</th>
                                        <th>Requested By</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($patientLists as  $item)
                                        <tr>
                                            <td>{{ $item->patient->patient_id }}</td>
                                            <td>{{ $item->patient->name }}</td>
                                            <td>{{ $item->doctor->doctor_id }}</td>
                                            <td>{{ $item->doctor->name }}</td>
                                            <td>
                                                <form action=" {{ route('reception.create') }}" method="GET">
                                                    <input type="hidden" name="request_patient_id" value="{{ $item->patient->id }}">
                                                    <button type="submit" class="btn btn-sm bg-info rounded-circle" value="Admit" title="Admit Patient">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </form>
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
      $("#classList").DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "order": [[0, "desc"]],
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
}).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');

    </script>
@endpush
