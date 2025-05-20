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
                                    <h2 class="h2">Patient Lists</h2>
                                    {{--                                    <div class="align-middle">--}}
                                    {{--                                        <a class="btn btn-sm btn-secondary" title="Patient" href="{{route('pathology.create')}}" style="line-height: 1.5 !important;"><i class="fas fa-pus"></i> Add Patient</a>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="card-body">
                                <h3 class="h3">Pathology Reports</h3>
                                <table class="table table-bordered table-striped" id="pathology-table">
                                    <thead>
                                    <th>Invoice ID</th>
                                    <th>Patient ID</th>
                                    <th>Name</th>
                                    <th>Test Name</th>
                                    <th>Delivery Date</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>

                                    <tbody>
                                    @foreach($pathologyReports as $item)
                                        <tr>
                                            <td>{{$item->invoice->invoice_number}}</td>
                                            <td>{{ $item->patient->patient_id }}</td>
                                            <td>{{$item->patient->name}}</td>
                                            <td>{{ $item->service->name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->delivery_date)->format('d-m-Y') }}</td>
                                            <td class="capitalize">{{ $item->invoice->payment_status }}</td>
                                            <td class="capitalize">{{ $item->status }}</td>
                                            <td>
                                                @if($item->status == 'generated' && $item->invoice->payment_status == 'paid')
                                                    <form action="{{ route('pathology.mark-delivered', $item->id) }}"
                                                          method="POST">@csrf
                                                        <button type="submit" class="btn btn-sm btn-success" title="Edit">
                                                            <i class="fas fa-check" aria-hidden="true"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>


                                </table>
                            </div>
                            <div class="card-body">
                                <h3 class="h3">Radiology Reports</h3>
                                <table class="table table-bordered table-striped" id="radiology-table">
                                    <thead>
                                    <th>Invoice ID</th>
                                    <th>Patient ID</th>
                                    <th>Name</th>
                                    <th>Test Name</th>
                                    <th>Delivery Date</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </thead>

                                    <tbody>
                                    @foreach($radiologyReports as $item)
                                        <tr>
                                            <td>{{$item->invoice->invoice_number}}</td>
                                            <td>{{ $item->patient->patient_id }}</td>
                                            <td>{{$item->patient->name}}</td>
                                            <td>{{ $item->service->name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->delivery_date)->format('d-m-Y') }}</td>
                                            <td class="capitalize">{{ $item->invoice->payment_status }}</td>
                                            <td class="capitalize">{{ $item->status }}</td>
                                            <td>
                                                @if($item->status == 'generated' && $item->invoice->payment_status == 'paid')
                                                    <form action="{{ route('radiology.mark-delivered', $item->id) }}"
                                                          method="POST">@csrf
                                                        <button type="submit" class="btn btn-sm btn-success" title="Edit">
                                                            <i class="fas fa-check" aria-hidden="true"></i></button>
                                                    </form>
                                                @endif
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
        $(function () {
            $("#pathology-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "order": [[6, "desc"], [5 , "asc"]],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
        $(function () {
            $("#radiology-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // sort by 8th column
                "order": [[6, "desc"], [5, "asc"]],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        function deleteConfirm(id) {
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are you sure to delete this record!")) {
                $.ajax({
                    url: 'pathology/delete/' + id,
                    type: 'get',
                    success: function (status) {
                        if (status.status == 1) {
                            window.location.reload();
                        }
                    }
                })
            }
        }
    </script>
    <!-- Include jQuery -->



@endpush

