@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="d-flex justify-content-between p-3">
                                <h3 class="h3"><strong>Patient Details</strong></h3>
                                <div class="">{!! DNS1D::getBarcodeSVG ("$patientLists->patient_id", 'C39', 1) !!}</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>ID :</strong> {{ $patientLists->patient_id }} </p>
                                        <p class="my-2"><strong>Name :</strong> {{ $patientLists->name }} </p>
                                        <p class="my-2"><strong>Gender :</strong> {{ $patientLists->gender }} </p>
                                        <p class="my-2"><strong>Age :</strong> {{ $patientLists->age }} </p>
                                        <p class="my-2"><strong>Address :</strong> {{ $patientLists->address }} </p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>Blood Group :</strong>{{ $patientLists->blood_group }} </p>
                                        <p class="my-2"><strong>Mobile : </strong>{{ $patientLists->mobile }} </p>
                                        <p class="my-2"><strong>Guardian No :</strong>{{ $patientLists->guardian_mobile }} </p>
                                        <p class="my-2"><strong>Summary : </strong>{{ $patientLists->patient_summary }} </p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        @if ($doctor)
                                        <p class="my-2"><strong>Doctor : </strong>{{ $doctor->name }} </p>
                                        @endif
                                        <p class="my-2"><strong>Type : </strong>{{ $patientLists->patient_type }} </p>
                                        <p class="my-2"><strong>Reference : </strong>{{ $patientLists->reference }} </p>
                                    </div>
                                </div>
                            </div>

                            @if ($pathologyList->isNotEmpty())
                                <div class="card-body">
                                    <h3 class="h3"><strong>Pathological Test</strong></h3>
                                    <table class="table table-bordered table-striped" id="classList">
                                        <thead>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Delivery</th>
                                            <th>Test Details</th>
                                            <th>Account</th>
                                            <th>Discount</th>
                                            <th>Total Paid</th>
                                            <th>Due</th>
                                            <th>Status</th>
                                        </thead>

                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($pathologyList as $k => $testList)
                                                <tr>
                                                    <td>{{ $testList->pathology_id }}</td>
                                                    <td>
                                                        @if ($testList->type == 0)
                                                            OPD
                                                        @else
                                                            IPD
                                                        @endif
                                                    <td>{{ $testList->delivery_date }}
                                                        Time: {{ $testList->delivery_time }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $testListDetails = json_decode(
                                                                $testList->test_list_details,
                                                            );
                                                        @endphp

                                                        @foreach ($testListDetails as $test)
                                                            <p>{{ $test->name }},
                                                                {{ $test->price }}TK, {{ $test->days }}Days</p>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if ($testList->account == 1)
                                                            Cash
                                                        @else
                                                            Bkash
                                                        @endif
                                                    </td>
                                                    <td>{{ $testList->discount }} %</td>
                                                    <td>{{ $testList->paid }} TK</td>
                                                    <td>{{ $testList->due }} TK</td>

                                                    <td>
                                                        @if ($testList->status == 0)
                                                            <span class="btn btn-danger">Pending</span>
                                                        @elseif($testList->status == 1)
                                                            <span class="btn btn-warning">Processing</span>
                                                        @elseif($testList->status == 2)
                                                            <span class="btn btn-info">Ready for Delivery</span>
                                                        @else
                                                            <span class="btn btn-success">Delivery</span>
                                                        @endif
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
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
    </script>
@endpush
