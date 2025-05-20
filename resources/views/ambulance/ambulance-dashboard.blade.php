@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content">
            <div class="card ">
                <div class="p-4">
                    <h2 class="h2 font-weight-bold">Daily Number of Trips</h2>
                    <div class="mt-4">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-4 col-xl-3 mb-4">
                                <div class="rounded-lg bg-primary p-3 shadow-md">
                                    <h4 class="mb-2 h5">Basic</h4>
                                    <h4 class="h3 font-weight-bold">236</h4>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-4 col-xl-3 mb-4">
                                <div class="rounded-lg bg-info p-3 shadow-md">
                                    <h4 class="mb-2 h5">Basic O2</h4>
                                    <h4 class="h3 font-weight-bold">2</h4>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-12 col-md-4 col-xl-3 mb-4">
                                <div class="rounded-lg bg-success p-3 shadow-md">
                                    <h4 class="mb-2 h5">ICU</h4>
                                    <h4 class="h3 font-weight-bold">2</h4>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-12 col-md-4 col-xl-3 mb-4">
                                <div class="rounded-lg bg-warning p-3 shadow-md">
                                    <h4 class="mb-2 h5 text-white">Freezer</h4>
                                    <h4 class="h3 font-weight-bold text-white">50</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3 class="card-header h3">Assign Ambulance to New Trip</h3>
                    <div class="card-body">
                        <form action="{{ route('ambulance-trips.store') }}" method="post">@csrf
                            <div class="row">
                                <div class="col-12 col-md-3 form-group">
                                    <label for="type">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option selected disabled>Select Category</option>
                                        <option value="basic">Basic</option>
                                        <option value="basic_o2">Basic O2</option>
                                        <option value="icu">ICU</option>
                                        <option value="freezer">Freezer</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-3 form-group">
                                    <label for="car_number">Ambulance No</label>
                                    <select name="car_number" id="car_number" class="form-control">
                                        <option disabled selected>Select category first</option>
                                    </select>
                                </div>


                                <div class="col-12 col-md-3 form-group">
                                    <label for="patient_name">Patient Name</label>
                                    <input type="text" name="name" id="patient_name" class="form-control">
                                </div>

                                <div class="col-12 col-md-3 form-group">
                                    <label for="patient_phone">Patient Phone</label>
                                    <input type="text" name="phone" id="patient_phone" class="form-control">
                                </div>

                                <div class="col-12 col-md-4 form-group">
                                    <label for="pickup_location">Pickup Location</label>
                                    <textarea name="pickup_location" id="pickup_location"
                                              class="form-control"></textarea>
                                </div>

                                <div class="col-12 col-md-4 form-group">
                                    <label for="destination">Destination</label>
                                    <textarea name="destination" id="destination" class="form-control"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-6 p-4">
                        <h3 class="py-3 h3">Available Ambulance</h3>
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>SL</th>
                            <th>Ambulance No</th>
                            <th>Contact No</th>
                            <th>Driver</th>
                            <th>Category</th>
                            <th>Type</th>
                            </thead>

                            <tbody>
                            @foreach($availableAmbulances as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->car_number }}</td>
                                    <td>{{ $item->contact_number }}</td>
                                    <td>{{ $item->driver->name }}</td>
                                    <td class="capitalize">{{ $item->category }}</td>
                                    <td class="capitalize">{{ $item->type }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 col-xl-6 p-4">
                        <h3 class="py-3 h3">Ambulance On Route</h3>
                        <table class="table table-bordered table-striped" id="classList2">
                            <thead>
                            <th>Ambulance No</th>
                            <th>Contact No</th>
                            <th>Driver</th>
                            <th>Category</th>
                            <th>Type</th>
                            </thead>

                            <tbody>
                            @foreach($onRouteAmbulances as $item)
                                <tr>
                                    <td>{{ $item->car_number }}</td>
                                    <td>{{ $item->contact_number }}</td>
                                    <td>{{ $item->driver->name }}</td>
                                    <td class="capitalize">{{ $item->category }}</td>
                                    <td class="capitalize">{{ $item->type }}</td>
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
        $(document).ready(function () {
            $('#category').on('change', function () {
                let category = $(this).val();
                if (category) {
                    let data = @json($availableAmbulances);
                    let result = data.filter(function (item) {
                        return item.category === category;
                    });

                    $('#car_number').empty();
                    $('#car_number').append('<option selected disabled>Select Ambulance</option>');
                    $.each(result, function (key, value) {
                        $('#car_number').append('<option value="' + value.id + '">' + value.car_number + '</option>');
                    });
                } else {
                    $('#car_number').empty();
                }
            });
        });
    </script>
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
