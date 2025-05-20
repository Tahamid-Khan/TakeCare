@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Previous Test List</h2>
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>SL</th>
                            <th>Patient ID</th>
                            <th>Test Name</th>
                            <th>Delivery Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            </thead>

                            <tbody>
                            @foreach ($tests as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->patient->patient_id }}</td>
                                    <td>{{ $item->service->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->delivery_date)->format('d-m-Y') }}</td>
                                    <td class="capitalize">{{ $item->status }}</td>
                                    <td>
                                        @if($item->status == 'delivered' || $item->status == 'generated')
                                        <a href="{{ route('radiology.testReport', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        @elseif($item->status == 'completed')
                                        <a href="{{ route('radiology.report-generate', $item->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-file"></i>
                                        </a>
                                        @endif
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
        $(function() {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
