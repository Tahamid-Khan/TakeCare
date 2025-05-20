@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Ride Share Details</h2>
                <div class="">
                    <div class="col-12 p-4">
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>SL</th>
                            <th>Ambulance No</th>
                            <th>Category</th>
                            <th>Driver</th>
                            <th>Pickup Location</th>
                            <th>Destination</th>
                            <th>Patient Name</th>
                            <th>Patient Mobile</th>
                            <th>Patient Summary</th>
                            <th>Charge</th>
                            <th>Action</th>
                            </thead>
                            @php
                                $rideShare = [
                                    (object)[
                                        'id' => 1,
                                        'ambulance_no' => 'AMB-001',
                                        'category' => 'basic',
                                        'type' => 'internal',
                                        'driver' => '1',
                                        'driver_number' => '01700000000',
                                        'pickup_location' => 'Mirpur 10',
                                        'destination' => 'Dhanmondi',
                                        'patient_name' => 'Mr. Y',
                                        'patient_mobile' => '01700000000',
                                        'patient_summary' => 'Emergency',
                                        'charge' => '500',
                                    ],
                                    (object)[
                                        'id' => 2,
                                        'ambulance_no' => 'AMB-002',
                                        'category' => 'basic_o2',
                                        'type' => 'external',
                                        'driver' => '2',
                                        'driver_number' => '01700000000',
                                        'pickup_location' => 'Mirpur 10',
                                        'destination' => 'Dhanmondi',
                                        'patient_name' => 'Mr. A',
                                        'patient_mobile' => '01700000000',
                                        'patient_summary' => 'Emergency',
                                        'charge' => '500',
                                    ],
                                ];
                            @endphp
                            <tbody>
                            @foreach($trips as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->ambulance->car_number ?? '---'  }}</td>
                                    <td class="capitalize">{{ $item->ambulance->category ?? '---'  }}</td>
                                    <td>{{ $item->driver->name ?? '---'  }}</td>
                                    <td>{{ $item->pickup_location ?? '---'  }}</td>
                                    <td>{{ $item->destination ?? '---'  }}</td>
                                    <td>{{ $item->patient_name ?? '---'  }}</td>
                                    <td>{{ $item->patient_phone ?? '---'  }}</td>
                                    <td>{{ $item->patient_summary ?? '---' }}</td>
                                    <td>{{ $item->charge ?? '---' }}</td>
                                    <td>
                                        @if($item->status == 'completed')
                                            {{--view Button--}}
                                            <button class="btn btn-sm btn-info"
                                                    data-toggle="modal"
                                                    data-target="#viewRideShareModal"
                                                    data-id="{{ $item->id }}"
                                                    data-ambulance_no="{{ $item->ambulance->car_number }}"
                                                    data-category="{{ $item->ambulance->category  }}"
                                                    data-type="{{ $item->ambulance->type }}"
                                                    data-driver="{{ $item->driver->name }}"
                                                    data-driver_number="{{ $item->driver->phone }}"
                                                    data-pickup_location="{{ $item->pickup_location }}"
                                                    data-destination="{{ $item->destination }}"
                                                    data-patient_name="{{ $item->patient_name }}"
                                                    data-patient_mobile="{{ $item->patient_phone }}"
                                                    data-patient_summary="{{ $item->patient_summary }}"
                                                    data-charge="{{ number_format($item->charge , 2)}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        @else
                                            {{--Edit Button--}}
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#editRideShareModal"
                                                    data-id="{{ $item->id }}"
                                                    data-ambulance_no="{{ $item->ambulance->car_number }}"
                                                    data-category="{{ $item->ambulance->category }}"
                                                    data-driver="{{ $item->driver->name }}"
                                                    data-pickup_location="{{ $item->pickup_location }}"
                                                    data-destination="{{ $item->destination }}"
                                                    data-patient_name="{{ $item->patient_name }}"
                                                    data-patient_mobile="{{ $item->patient_phone }}"
                                                    data-patient_summary="{{ $item->patient_summary }}"
                                                    data-charge="{{ $item->charge }}"
                                            >
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <style>
                        .screen {
                            min-width: 800px;
                        }

                        .w-160px {
                            width: 160px;
                        }

                        /* add media query */
                        @media (max-width: 768px) {
                            .screen {
                                min-width: 355px;
                            }
                        }
                    </style>


                    <!-- View Ambulance Modal -->
                    <div class="modal fade" id="viewRideShareModal" tabindex="-1" role="dialog"
                         aria-labelledby="viewRideShareModalLabel" aria-hidden="true">
                        <div class="modal-dialog screen" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="h3" id="viewRideShareModalLabel">View Details</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="mb-4">
                                            <h5 class="h5 bg-info p-2">Ambulance Info</h5>
                                            <div class="form-group">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td class="w-160px"><strong>Ambulance No</strong></td>
                                                        <td id="ambulance-no"><strong>:</strong> test</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Category</strong></td>
                                                        <td id="category" class="capitalize"><strong>:</strong> test
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong>Type</strong></td>
                                                        <td id="type" class="capitalize"><strong>:</strong> test</td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong>Driver</strong></td>
                                                        <td id="driver"><strong>:</strong> test</td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong>Driver Number</strong></td>
                                                        <td id="driver-number"><strong>:</strong> test</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <h5 class="h5 bg-info p-2">Patient Info</h5>
                                            <div class="form-group">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td class="w-160px"><strong>Patient Name</strong></td>
                                                        <td id="patient-name"><strong>:</strong> test</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Patient Mobile</strong></td>
                                                        <td id="patient-mobile"><strong>:</strong> test</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Patient Summary</strong></td>
                                                        <td id="patient-summary"><strong>:</strong> test</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <h5 class="h5 bg-info p-2">Other Info</h5>
                                            <div class="form-group">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td class="w-160px"><strong>Pickup Location</strong></td>
                                                        <td id="pickup-location"><strong>:</strong> test</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Destination</strong></td>
                                                        <td id="destination"><strong>:</strong> test</td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong>Charge</strong></td>
                                                        <td id="charge"><strong>:</strong> test</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Ambulance Modal -->
                    <div class="modal fade" id="editRideShareModal" tabindex="-1" role="dialog"
                         aria-labelledby="editRideShareModalLabel" aria-hidden="true">
                        <div class="modal-dialog screen" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="h3" id="editRideShareModalLabel">Edit Ride Share</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ambulance-trips.update', 'update') }}"
                                          method="POST">@csrf @method('PUT')
                                        <input type="hidden" id="id" name="id">
                                        <div class="row mb-4">
                                            <div class="col-md-4 form-group">
                                                <label for="ambulance_no" class="form-label">Ambulance No</label>
                                                <input type="text" class="form-control" id="ambulance_no"
                                                       readonly>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="category" class="form-label">Category</label>
                                                <input type="text" class="form-control" id="category" readonly>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="driver" class="form-label">Driver</label>

                                                <input type="text" class="form-control" id="driver"
                                                       readonly>
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label for="pickup_location" class="form-label">Pickup Location</label>
                                                <textarea class="form-control" id="pickup_location"
                                                          readonly></textarea>
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label for="destination" class="form-label">Destination</label>
                                                <textarea class="form-control" id="destination" name="destination"
                                                ></textarea>
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="patient_name" class="form-label">Patient Name</label>
                                                <input type="text" class="form-control" id="patient_name"
                                                       name="name">
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="patient_mobile" class="form-label">Patient Mobile</label>
                                                <input type="text" class="form-control" id="patient_mobile"
                                                       name="phone">
                                            </div>

                                            <div class="col-md-4 form-group">
                                                <label for="charge" class="form-label">Charge</label>
                                                <input type="text" class="form-control" id="charge" name="charge"
                                                       required>
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label for="patient_summary" class="form-label">Patient Summary</label>
                                                <textarea class="form-control" id="patient_summary"
                                                          name="patient_summary" required></textarea>
                                            </div>

                                            <div class="col-auto md:mt-4 d-flex align-items-center">
                                                <button type="button" id="update-submit-button" class="btn btn-primary">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        $('#editRideShareModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let ambulance_no = button.data('ambulance_no');
            let driver = button.data('driver');
            let category = button.data('category');
            let pickup_location = button.data('pickup_location');
            let destination = button.data('destination');
            let patient_name = button.data('patient_name');
            let patient_mobile = button.data('patient_mobile');
            let patient_summary = button.data('patient_summary');
            let charge = button.data('charge');

            let modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #ambulance_no').val(ambulance_no);
            modal.find('.modal-body #driver').val(driver);
            modal.find('.modal-body #category').val(category);
            modal.find('.modal-body #pickup_location').val(pickup_location);
            modal.find('.modal-body #destination').val(destination);
            modal.find('.modal-body #patient_name').val(patient_name);
            modal.find('.modal-body #patient_mobile').val(patient_mobile);
            modal.find('.modal-body #patient_summary').val(patient_summary);
            modal.find('.modal-body #charge').val(charge);


        });

        // onclick update submit button, replace the form action parameter only then submit the form
        $('#update-submit-button').on('click', function () {
            let id = $('#id').val();
            let form = $('#editRideShareModal form');
            let action = form.attr('action');
            form.attr('action', action.replace('update', id));
            form.submit();
        });

        $('#viewRideShareModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let ambulance_no = button.data('ambulance_no');
            let category = button.data('category');
            let type = button.data('type');
            let driver = button.data('driver');
            let driver_number = button.data('driver_number');
            let pickup_location = button.data('pickup_location');
            let destination = button.data('destination');
            let patient_name = button.data('patient_name');
            let patient_mobile = button.data('patient_mobile');
            let patient_summary = button.data('patient_summary');
            let charge = button.data('charge');

            let modal = $(this);
            modal.find('.modal-body #ambulance-no').html('<strong>:</strong> ' + ambulance_no);
            modal.find('.modal-body #category').html('<strong>:</strong> ' + category);
            modal.find('.modal-body #type').html('<strong>:</strong> ' + type);
            modal.find('.modal-body #driver').html('<strong>:</strong> ' + driver);
            modal.find('.modal-body #driver-number').html('<strong>:</strong> ' + driver_number);
            modal.find('.modal-body #pickup-location').html('<strong>:</strong> ' + pickup_location);
            modal.find('.modal-body #destination').html('<strong>:</strong> ' + destination);
            modal.find('.modal-body #patient-name').html('<strong>:</strong> ' + patient_name);
            modal.find('.modal-body #patient-mobile').html('<strong>:</strong> ' + patient_mobile);
            modal.find('.modal-body #patient-summary').html('<strong>:</strong> ' + patient_summary);
            modal.find('.modal-body #charge').html('<strong>:</strong> ' + charge);
        });
    </script>
@endpush
