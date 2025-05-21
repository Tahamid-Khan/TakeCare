@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                @if (!isset($request_patient_id))
                    <div class="mx-auto rounded border p-4 shadow-lg bg-white">
                        <h2 class="py-3 h2">Search Existing Patient</h2>

                        {{-- <form action="{{ route('reception.create') }}" method="GET"> --}}
                        <div class="row mb-4">
                            <div class="col-md-9 mb-3">
                                <label for="patient_info" class="form-label">Search by Patient Name/ID/Phone</label>
                                <input type="text" name="patient_info" id="patient_info" class="form-control"
                                    placeholder="Patient Name/ID/Phone" />
                                <div class="autocomplete-results list-group"></div>
                            </div>

                            {{-- <div class="col-auto md:mt-4 d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div> --}}
                        </div>
                        {{-- </form> --}}
                    </div>
                @endif
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">Patient Info</h3>
                            </div>


                            <form action="{{ route('reception.store') }}" class="p-2" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="patient_id" id="id"
                                    value="{{ isset($patientData) ? $patientData->id : '' }}">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content shampan-heading">
                                                <div class="active tab-pane" id="general-information">
                                                    <!-- Post -->
                                                    <div class="col-md-12">
                                                        <div class="row">


                                                            <div class="col-4 form-group">
                                                                <p class="p-tag">Name <span class="text-danger">*</span>
                                                                </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('name') is-invalid @enderror"
                                                                    placeholder="" id="name" name="name"
                                                                    type="text"
                                                                    value="{{ isset($patientData) ? $patientData->name : old('name') }}"
                                                                    required>
                                                                <!-- </div> -->
                                                                @error('name')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-2 form-group">
                                                                <p class="p-tag">Gender <span class="text-danger">*</span>
                                                                </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="gender" name="gender"
                                                                    required>
                                                                    <option value="">----</option>
                                                                    <option value="Male"
                                                                        {{ isset($patientData) && $patientData->gender == 'Male' ? 'selected' : (old('gender') == 'Male' ? 'selected' : '') }}>
                                                                        Male
                                                                    </option>
                                                                    <option value="Female"
                                                                        {{ isset($patientData) && $patientData->gender == 'Female' ? 'selected' : (old('gender') == 'Female' ? 'selected' : '') }}>
                                                                        Female
                                                                    </option>
                                                                    <option value="Other"
                                                                        {{ old('gender') == 'Other' ? 'selected' : '' }}>
                                                                        Other
                                                                    </option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('gender')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-2 form-group">
                                                                <p class="p-tag">Age <span class="text-danger">*</span>
                                                                </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus" placeholder=""
                                                                    id="age" name="age" type="number"
                                                                    value="{{ isset($patientData) ? $patientData->age : old('age') }}"
                                                                    required>
                                                                <!-- </div> -->
                                                            </div>


                                                            <div class="col-2 form-group">
                                                                <p class="p-tag">Blood Group</p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="blood_group"
                                                                    name="blood_group">
                                                                    <option value="">----</option>
                                                                    <option
                                                                        {{ isset($patientData) && $patientData->blood_group == 'A+' ? 'selected' : '' }}
                                                                        value="A+">
                                                                        A+
                                                                    </option>
                                                                    <option
                                                                        {{ isset($patientData) && $patientData->blood_group == 'A-' ? 'selected' : '' }}
                                                                        value="A-">
                                                                        A-
                                                                    </option>
                                                                    <option
                                                                        {{ isset($patientData) && $patientData->blood_group == 'B+' ? 'selected' : '' }}
                                                                        value="B+">
                                                                        B+
                                                                    </option>
                                                                    <option
                                                                        {{ isset($patientData) && $patientData->blood_group == 'B-' ? 'selected' : '' }}
                                                                        value="B-">
                                                                        B-
                                                                    </option>
                                                                    <option
                                                                        {{ isset($patientData) && $patientData->blood_group == 'AB+' ? 'selected' : '' }}
                                                                        value="AB+">
                                                                        AB+
                                                                    </option>
                                                                    <option
                                                                        {{ isset($patientData) && $patientData->blood_group == 'AB-' ? 'selected' : '' }}
                                                                        value="AB-">
                                                                        AB-
                                                                    </option>
                                                                    <option
                                                                        {{ isset($patientData) && $patientData->blood_group == 'O+' ? 'selected' : '' }}
                                                                        value="O+">
                                                                        O+
                                                                    </option>
                                                                    <option
                                                                        {{ isset($patientData) && $patientData->blood_group == 'O-' ? 'selected' : '' }}
                                                                        value="O-">
                                                                        O-
                                                                    </option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('blood_group')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Mobile <span class="text-danger">*</span>
                                                                </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('mobile') is-invalid @enderror"
                                                                    placeholder="" id="mobile" name="mobile"
                                                                    type="text"
                                                                    value="{{ isset($patientData) ? $patientData->mobile : '' }}"
                                                                    required>
                                                                <!-- </div> -->
                                                                @error('mobile')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Guardian Mobile</p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('guardian_mobile') is-invalid @enderror"
                                                                    placeholder="" id="guardian_mobile"
                                                                    name="guardian_mobile" type="text"
                                                                    value="{{ isset($patientData) ? $patientData->guardian_mobile : '' }}">
                                                                <!-- </div> -->
                                                                @error('guardian_mobile')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Address </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('address') is-invalid @enderror"
                                                                    placeholder="" id="address" name="address"
                                                                    type="text"
                                                                    value="{{ isset($patientData) ? $patientData->address : '' }}">
                                                                <!-- </div> -->
                                                                @error('address')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-12 form-group">
                                                                <p class="p-tag">Patient Summary </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <textarea class="form-control custom-focus @error('patient_summary') is-invalid @enderror" placeholder=""
                                                                    id="patient_summary" name="patient_summary" type="text">{{ isset($patientData) ? $patientData->patient_summary : '' }}</textarea>
                                                                <!-- </div> -->
                                                                @error('patient_summary')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-2 form-group">
                                                                <p class="p-tag">Patient Type <span
                                                                        class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="patient_type"
                                                                    name="patient_type" required>
                                                                    <option value="">----</option>
                                                                    <option value="General"
                                                                        {{ isset($patientData) && $patientData->patient_type == 'General' ? 'selected' : '' }}>
                                                                        General
                                                                    </option>
                                                                    <option value="CBD"
                                                                        {{ isset($patientData) && $patientData->patient_type == 'CBD' ? 'selected' : '' }}>
                                                                        CBD
                                                                    </option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('patient_type')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Assign Doctor <span
                                                                        class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="doctor_id"
                                                                    name="doctor_id" required autofocus>
                                                                    <option value="">----</option>
                                                                    @foreach ($doctor as $list)
                                                                        <option value="{{ $list->id }}"
                                                                            {{ old('doctor_id') == $list->id ? 'selected' : '' }}>
                                                                            {{ $list->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                                <!-- </div> -->
                                                                @error('doctor_id')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Ward
                                                                    <span class="text-danger">*</span>
                                                                </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="ward_id"
                                                                    name="ward_id" required>
                                                                    <option value="">Select Ward</option>
                                                                    @foreach ($wards as $list)
                                                                        <option value="{{ $list->id }}"
                                                                            {{ old('ward_id') == $list->id ? 'selected' : '' }}>
                                                                            {{ $list->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('ward_id')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Bed
                                                                    <span class="text-danger">*</span>
                                                                </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="bed_id"
                                                                    name="bed_id" required>
                                                                    <option value="">Select Ward First</option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('bed_id')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Reference </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="reference"
                                                                    name="reference">
                                                                    <option value="">----</option>
                                                                    <option value="GENERAL"
                                                                        {{ isset($patientData) && $patientData->reference == 'GENERAL' ? 'selected' : '' }}>
                                                                        GENERAL
                                                                    </option>
                                                                    <option value="DMSC"
                                                                        {{ isset($patientData) && $patientData->reference == 'DMSC' ? 'selected' : '' }}>
                                                                        DMSC
                                                                    </option>
                                                                    <option value="MOD"
                                                                        {{ isset($patientData) && $patientData->reference == 'MOD' ? 'selected' : '' }}>
                                                                        MOD
                                                                    </option>
                                                                    <option value="MED"
                                                                        {{ isset($patientData) && $patientData->reference == 'MED' ? 'selected' : '' }}>
                                                                        MED
                                                                    </option>
                                                                    <option value="CBD"
                                                                        {{ isset($patientData) && $patientData->reference == 'CBD' ? 'selected' : '' }}>
                                                                        CBD
                                                                    </option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('voucher')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mt-3 mb-2 text-right">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(document).ready(function() {
            $('#doctor_id').select2({
                placeholder: "Select Doctor",
                allowClear: true
            });
        });
    </script>
    <script>
        $(function() {
            $("#teamList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>


    <script>
        function attachAutocompleteHandlerForPatientSearch() {
            document.getElementById('patient_info').addEventListener('input', function() {
                let query = this.value;
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('get-patients') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            const resultsContainer = document.querySelector('.autocomplete-results');
                            resultsContainer.innerHTML = '';
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block'; // Show the results box
                                data.forEach(function(item) {
                                    const resultItem = document.createElement('a');
                                    resultItem.classList.add('list-group-item',
                                        'list-group-item-action');
                                    resultItem.textContent = item.name;
                                    resultItem.dataset.id = item.id;
                                    resultItem.dataset.phone = item.phone;
                                    resultItem.href = '#';
                                    resultItem.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        fillPatientDetails(item.id, item.phone);
                                        resultsContainer.style.display =
                                            'none'; // Hide the results box
                                    });
                                    resultsContainer.appendChild(resultItem);
                                });
                            } else {
                                resultsContainer.style.display =
                                    'none'; // Hide the results box if no results
                            }
                        }
                    });
                } else {
                    const resultsContainer = document.querySelector('.autocomplete-results');
                    resultsContainer.style.display =
                        'none'; // Hide the results box if query is less than 3 characters
                    resultsContainer.innerHTML = '';
                }
            });
        }

        function fillPatientDetails(id, phone) {
            $.ajax({
                url: `/get-patient-details/${id}`,
                type: "GET",
                success: function(data) {
                    document.getElementById('patient_info').value = data.id;


                    let fields = [
                        'id', 'name', 'gender', 'age', 'blood_group', 'mobile',
                        'guardian_mobile', 'address', 'patient_summary',
                        'patient_type', 'reference'
                    ];

                    // reset all fields
                    fields.forEach(function(field) {
                        let element = document.getElementById(field);
                        element.value = data[field];

                    });

                }
            });
        }

        attachAutocompleteHandlerForPatientSearch();
    </script>

    <script>
   $('#ward_id').on('change', function() {
    let wardId = $(this).val();
    
    $('#bed_id').empty();
    
    if (wardId) {
        $('#bed_id').append('<option value="">Loading beds...</option>');
        
        $.ajax({
            url: "{{ route('get.beds.by.ward') }}",
            type: "GET",
            data: { ward_id: wardId },
            dataType: "json",
            success: function(response) {
                $('#bed_id').empty();
                
                // Check if response is an array and has items
                if (Array.isArray(response) && response.length > 0) {
                    $('#bed_id').append('<option value="">Select Bed</option>');
                    $.each(response, function(key, bed) {
                        $('#bed_id').append('<option value="' + bed.id + '">Bed ' + bed.bed_number + '</option>');
                    });
                } 
                // Check if it's a status message
                else if (response.status === 'no_beds') {
                    $('#bed_id').append('<option value="">' + response.message + '</option>');
                }
                // Default empty case
                else {
                    $('#bed_id').append('<option value="">No available beds in this ward</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
                $('#bed_id').empty();
                $('#bed_id').append('<option value="">Error loading beds</option>');
            }
        });
    } else {
        $('#bed_id').append('<option value="">Select Ward First</option>');
    }
});


    </script>
@endpush
