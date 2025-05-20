@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <style>
                .bg-danger-light {
                    background-color: #f8d7da;
                }

                .bg-primary-light {
                    background-color: #d1ecf1;
                }

                .display-4 {
                    font-size: 2rem;
                    font-weight: 700;
                }
            </style>
            <div class="card">
                <div class="">
                    <div class="p-4">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                    <h3 class="mb-2 h5">Natural Death</h3>
                                    <p class="h3 font-weight-bold text-danger">15</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-primary-light p-3 shadow">
                                    <h3 class="mb-2 h5">Unnatural Death</h3>
                                    <p class="h3 font-weight-bold text-primary">23</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="p-4">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h3 class="mb-4 h3">Natural Deceased List</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                    </thead>

                                    <tbody>
                                    @foreach ($naturalDeaths as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->age }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('death-report-view', $item->id) }}"
                                                   class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <h3 class="mb-4 h3">Unnatural Deceased List</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="classList2">
                                    <thead>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                    </thead>

                                    <tbody>
                                    @foreach ($unnaturalDeaths as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->age }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{ route('death-report-view', $item->id) }}"
                                                   class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
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
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "filter": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');

            $("#classList2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "filter": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
