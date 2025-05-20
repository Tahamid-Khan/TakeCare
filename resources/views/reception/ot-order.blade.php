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
                                <div class="row justify-content-between">
                                    <h3 class="h3">Operation Order</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Ref. By</th>
                                        <th>OT Doctor</th>
                                        <th>Operation Date</th>
                                        <th>Operation Time</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($operations as $item)
                                            <tr>
                                                <td>{{ $item->patient->patient_id }}</td>
                                                <td>{{ $item->patient->name }}</td>
                                                <td>{{ $item->requestedByUser->name }}</td>
                                                <td>{{ $item->doctor->name }}</td>
                                                <td>{{ $item->operation_date }}</td>
                                                <td>{{ $item->operation_time }}</td>
                                                <td>
                                                    <a href="{{ route('reception.ot-order-update', $item->id) }}" class="btn btn-sm btn-success my-2" title="Edit"><i class="fas fa-edit" aria-hidden="true"></i></a>
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
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "order": [],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
