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
        <section class="content ">
            <div class="card">
                <div class="p-4">
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="row">
                                <!-- Card 1 -->
                                <div class="col-12 col-md-3 mb-4">
                                    <div class="rounded-lg bg-danger-light p-3 shadow">
                                        <h3 class="mb-2 h5">Total Test</h3>
                                        <p class="h3 font-weight-bold text-danger">15</p>
                                    </div>
                                </div>

                                <!-- Card 2 -->
                                <div class="col-12 col-md-3 mb-4">
                                    <div class="rounded-lg bg-primary-light p-3 shadow">
                                        <h3 class="mb-2 h5">Schedule Test</h3>
                                        <p class="h3 font-weight-bold text-primary">23</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <div class="col-12">
                        <h3 class="mb-4 h3">Scheduled Test List</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>Patient ID</th>
                                <th>Test Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                </thead>


                                <tbody>
                                @foreach ($tests as $item)
                                    <tr>
                                        <td>{{ $item->patient->patient_id }}</td>
                                        <td>{{ $item->service->name }}</td>
                                        <td class="capitalize">{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ route('radiology.viewTest', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
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
