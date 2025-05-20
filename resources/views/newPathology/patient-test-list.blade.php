@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <h3 class="card-header h3">Test Wise Patient List</h3>
            <div class="p-3 bg-white">
                <div class="col-12">

                    <div class="my-4">
                        <form action="" method="GET">
                            <div class="row">
                                <!--Start Date-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="start-date">From</label>
                                        <input type="date" name="start_date" id="start-date" class="form-control"
                                               value="{{ request()->start_date }}">
                                    </div>
                                </div>

                                <!--End Date-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="end-date">To</label>
                                        <input type="date" name="end_date" id="end-date" class="form-control"
                                               value="{{ request()->end_date }}">
                                    </div>
                                </div>

                                <!--Test Name-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="test">Test Name</label>
                                        <select name="test" id="test" class="form-control">
                                            <option disabled selected>Select</option>
                                            @foreach($testNames as $item)
                                                <option
                                                    value="{{ $item->id }}" {{ request()->test == $item->id ? 'selected' : ''}}>{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!--Doctor Name-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="doctor">Doctor Name</label>
                                        <select name="doctor" id="doctor" class="form-control">
                                            <option disabled selected>Select Doctor</option>
                                            @foreach($doctors as $item)
                                                <option
                                                    value="{{ $item->id }}" {{ request()->doctor == $item->id ? 'selected' : ''}}>{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{url()->current()}}" class="btn btn-danger">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div><h4 class="h4">Total: {{ $tests->count() }}</h4></div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>SL</th>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Test Name</th>
                            <th>Sample Taken</th>
                            <th>Status</th>
                            </thead>


                            <tbody>
                            @foreach ($tests as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->patient->patient_id }}</td>
                                    <td>{{ $item->patient->name }}</td>
                                    <td>{{ $item->service->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->test_date)->format('d-m-Y') }}</td>
                                    <td class="capitalize">{{ $item->status }}</td>
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
