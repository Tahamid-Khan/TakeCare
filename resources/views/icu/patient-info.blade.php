@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <style>
                .bg-light {
                    background-color: #F3F4F6 !important;
                }

                .status-font {
                    color: black;
                    font-size: 1.125rem;
                    line-height: 1.75rem;
                    font-weight: 600;
                }

                .recent-box {
                    max-height: 203px;
                    overflow-y: auto;
                }
            </style>

            {{-- Refer Patient Popup Model --}}
            <div class="modal fade" id="referPatientModal" tabindex="-1" role="dialog"
                 aria-labelledby="referPatientModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('dashboard.refer-patient') }}" method="POST">@csrf
                            <input type="hidden" name="patient_id" value="{{ $patientData->patient_id }}">
                            <input type="hidden" name="hospital_id" value="" id="hospital-id">
                            <div class="modal-header">
                                <h5 class="h5" id="referPatientModalLabel">Refer Patient to Other Hospital</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-danger">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="patient_id" value="{{ $patientData->patient_id }}">
                                <input type="hidden" id="hospital-id" name="hospital_id">
                                <div class="form-group">
                                    <label for="hospital-name">Hospital</label>
                                    <input type="text" class="form-control" id="hospital-name" name="hospitalName">
                                    <div class="autocomplete-results"></div>
                                </div>

                                <div class="form-group">
                                    <label for="remark">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark" rows="3"
                                              required></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Refer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Release Patient Popup Model --}}
            <div class="modal fade" id="releasePatientModal" tabindex="-1" role="dialog"
                 aria-labelledby="releasePatientModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('icu.release-patient-to-pow') }}" method="POST">@csrf
                            <div class="modal-header">
                                <h5 class="h5" id="releasePatientModalLabel">Release Patient to Ward/Cabin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-danger">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="patient_id" value="{{ $patientData->patient_id }}">
                                <div class="form-group">
                                    <label for="ward_id">Ward</label>
                                    <select class="form-control" id="ward_id" name="ward_id" required>
                                        <option value="">Select Ward</option>
                                        @foreach ($wards as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="bed_id">Bed</label>
                                    <select class="form-control" id="bed_id" name="bed_id" required>
                                        <option value="">Select Bed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="doctor-id">Assign Doctor</label>
                                    <select class="form-control" id="doctor-id" name="doctor_id" required>
                                        <option value="">Select Doctor</option>
                                        @foreach ($doctors as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Release</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Current Status Part Start --}}
            <div class="card-header">
            <div class="d-flex justify-content-between">
                <h2 class=" h2">Patient Information</h2>
                <div class="d-flex">
                    <div>
                        <button class="btn btn-success mb-2 mr-4" data-toggle="modal" data-target="#releasePatientModal">
                            Release Patient
                        </button>
                    </div>
                    @if(!isset($alreadyReferred))
                        <div>
                            <button class="btn btn-success mb-2" data-toggle="modal" data-target="#referPatientModal">
                                Refer Patient
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="text-lg font-semibold">Patient Current Status</h2>
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <p class="text-muted mb-1">Patient Name:</p>
                            <p class="h6 status-font"> {{ $patientData->patient->name }} </p>
                        </div>
                        <div class="row">
                            <div class="mr-4">
                                <p class="text-muted mb-1">Location:</p>
                                <p class="h6 text-danger font-semibold"> {{ $patientData->isICU == 1 ? 'ICU' : 'HDU' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-muted mb-1">Bed no:</p>
                                <p class="h6 status-font"> {{ $patientData->bed->bed_number }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="p-2 bg-light rounded">
                                <p class="text-muted mb-1">Temperature</p>
                                <div class="h6 status-font">
                                    @if ($patientStatus['temperature'] == 0)
                                        <p class="text-danger"> Not Updated </p>
                                    @else
                                        <p>{{ $patientStatus['temperature'] }} °F</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="p-2 bg-light rounded">
                                <p class="text-muted mb-1">Blood Pressure</p>
                                <div class="h6 status-font">
                                    @if ($patientStatus['blood_pressure'] == 0)
                                        <p class="text-danger"> Not Updated </p>
                                    @else
                                        <p>{{ $patientStatus['blood_pressure'] }} mmHg</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="p-2 bg-light rounded">
                                <p class="text-muted mb-1">Pulse</p>
                                <div class="h6 status-font">
                                    @if ($patientStatus['pulse_rate'] == 0)
                                        <p class="text-danger"> Not Updated </p>
                                    @else
                                        <p>{{ $patientStatus['pulse_rate'] }} BPM</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mb-4">
                        <p class="text-muted mb-1">Recent Updates:</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, est.</p>
                    </div> --}}
                </div>
            </div>
            {{-- Current Status Part End --}}


            <!-- Doctor Advice Part Start -->
            <div class="shadow-md rounded-lg bg-white p-4">
                <h3 class="text-lg font-semibold border-bottom pb-2">Patient Summary & Update</h3>
                <ul class="list-unstyled px-3 py-2 recent-box">
                    @foreach ($patientSummary as $item)
                        <li class="mb-2">&rarr; {{ $item->summary }}</li>
                    @endforeach
                </ul>
            </div>
            <!-- Doctor Advice Part End -->

            {{-- Medicine List Part Start --}}
            <div class="shadow-md rounded-lg bg-white p-4 mt-4">
                <h3 class="text-lg font-semibold border-bottom pb-2">Medicine List</h3>


                <div class="table-responsive">
                    <table class="table status-table">
                        <div id="status-heading" class="text-center">
                            <tr>
                                <th>Name</th>
                                <th>Schedule</th>
                                <th>Taking time</th>
                                <th>Dose</th>
                                <th>Duration</th>

                            </tr>
                        </div>
                        @foreach ($patientActiveMedicines as $item)
                            @php
                                $schedule = json_decode($item->schedule);
                            @endphp


                            <tr class="border-bottom mr-3 text-capitalize">
                                <td>{{ $item->medicine_name }}</td>

                                <td>
                                    <small>
                                        {{ in_array('morning', $schedule) ? '1+' : '0+' }}
                                        {{ in_array('afternoon', $schedule) ? '1+' : '0+' }}
                                        {{ in_array('evening', $schedule) ? '1' : '0' }}

                                    </small>
                                </td>
                                <td>
                                    <small>{{ $item->taking_time }} Meal</small>
                                </td>
                                <td>
                                    <small>{{ $item->dose }}</small>
                                </td>
                                <td>
                                    <small>{{ $item->duration }}</small>
                                </td>

                            </tr>
                        @endforeach


                    </table>
                </div>
            </div>
            {{-- Medicine List Part End --}}







            {{-- ICU Information Update Start --}}
            @include('icu.icu-info-update')
            {{-- ICU Information Update End --}}

        </section>
    </div>
@endsection
@push('custom_js')

    <script>




        function attachAutocompleteHandlerForHospitalSearch() {
            document.getElementById('hospital-name').addEventListener('input', function () {
                let query = this.value;
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('get-hospitals') }}",  // Update this to your actual route for hospital search
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function (data) {
                            const resultsContainer = document.querySelector('.autocomplete-results');
                            resultsContainer.innerHTML = '';  // Clear previous results
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block';  // Show the results box
                                data.forEach(function (item) {
                                    const resultItem = document.createElement('a');
                                    resultItem.classList.add('list-group-item', 'list-group-item-action');
                                    resultItem.textContent = item.name + ' - ' + item.address;
                                    resultItem.dataset.id = item.id;
                                    resultItem.href = '#';
                                    resultItem.addEventListener('click', function (e) {
                                        e.preventDefault();
                                        document.getElementById('hospital-name').value = item.name;
                                        document.getElementById('hospital-id').value = item.id;
                                        resultsContainer.style.display = 'none';  // Hide the results box
                                    });
                                    resultsContainer.appendChild(resultItem);
                                });
                            } else {
                                resultsContainer.style.display = 'none';  // Hide the results box if no results
                            }
                        }
                    });
                } else {
                    const resultsContainer = document.querySelector('.autocomplete-results');
                    resultsContainer.style.display = 'none';
                    resultsContainer.innerHTML = '';
                }
            });
        }

        // Attach the handler after the document is ready
        document.addEventListener('DOMContentLoaded', function () {
            attachAutocompleteHandlerForHospitalSearch();
        });

    </script>
    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');

            $('#doctor-id').select2({
                placeholder: 'Select Doctor',
                dropdownParent: $('#releasePatientModal')
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            $('#ward_id').on('change', function () {
                let wardId = $(this).val();

                if (wardId) {
                    $.ajax({
                        url: '{{ route('get.beds.by.ward') }}',
                        type: 'GET',
                        data: {
                            ward_id: wardId
                        },
                        success: function (data) {
                            $('#bed_id').empty();
                            $('#bed_id').append('<option value="">Select Bed</option>');
                            $.each(data, function (key, bed) {
                                $('#bed_id').append('<option value="' + bed.id + '">' +
                                    bed.bed_number + '</option>');
                            });
                        }
                    });
                } else {
                    $('#bed_id').empty();
                    $('#bed_id').append('<option value="">Select Bed</option>');
                }
            });
        });
    </script>
@endpush
