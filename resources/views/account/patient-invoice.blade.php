@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Invoice</h2>

                <div class="p-4">
                    <table class="table table-bordered table-striped" id="classList">
                        <thead>
                        <th>Invoice Number</th>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Status</th>
                        <th>View</th>
                        </thead>

                        <tbody>
                        @foreach($invoices as $item)
                            <tr>
                                <td>{{ $item->invoice_number }}</td>
                                <td>{{ $item->patient->patient_id }}</td>
                                <td>{{ $item->patient->name }}</td>
                                <td class="capitalize">{{ $item->payment_status }}</td>
                                <td>
                                    <a href="{{ route('invoice', ['print_id' => $item->id]) }}"
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
                "filter": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
