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
                                <h3 class="h3">Patient Lists</h3>
                            </div>


                            <div class="card-body">

                                {{-- <div class="col-md-4">
                                    <div class="form-group row">
                                        <label for="total" class="col-form-label col-md-4">Today's Total: <span>{{$totalPatient}}</span></label>
                                    </div>
                                </div> --}}
                                <div class="col-md-3">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="text-dark font-bold">Today's Total: <span>{{$totalPatient}}</span></h3>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form action="">@csrf
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="date" class="col-form-label col-md-4">Date</label>
                                            <div class="col-md-8">
                                                <input type="date" name="date" id="date" class="form-control"
                                                    value="{{ request()->date }}">
                                            </div>
                                        </div>
                                    </div>
                                </form> --}}



                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                        <th>SL.Number</th>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Mobile</th>
                                        <th>Patient Type</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>

                                        @foreach ($patientLists as $item)
                                            <tr>
                                                <td>{{ $item->serial }}</td>
                                                <td>{{ $item->patient->patient_id }}</td>
                                                <td>{{ $item->patient->name }}</td>
                                                <td>{{ $item->patient->age }}</td>
                                                <td>{{ $item->patient->mobile }}</td>
                                                <td>{{ $item->patient->patient_type }}</td>
                                                <td>
                                                    {{-- <a href="{{ url('/opd-list/view', [1]) }}"
                                                        class="btn btn-sm btn-info my-2" title="View">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a> --}}

                                                    <a  href="{{ route('opd.view', ['id' => $item->id]) }}"
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
