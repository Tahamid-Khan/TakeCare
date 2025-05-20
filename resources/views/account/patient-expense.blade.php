@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Patient Expense</h2>

                <div class="p-4">
                    <table class="table table-bordered table-striped" id="classList">
                        <thead>
                        <th>SL</th>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Board</th>
                        <th>Lab</th>
                        <th>Total</th>
                        </thead>

                        <tbody>
                        @foreach($patients as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->patient_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td><span
                                        class="taka-small">&#2547;</span>{{  number_format($item->patientInvoice->where('fundDepartment.fund_id', 1)->sum('final_price'), 2) }}
                                </td>
                                <td><span
                                        class="taka-small">&#2547;</span>{{ number_format($item->patientInvoice->where('fundDepartment.fund_id', 2)->sum('final_price'), 2) }}
                                </td>
                                <td><span
                                        class="taka-small">&#2547;</span>{{ number_format($item->patientInvoice->sum('final_price'), 2) }}
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
