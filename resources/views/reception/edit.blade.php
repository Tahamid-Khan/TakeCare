@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">Update Patient</h3>
                            </div>
                            <form action="{{ route('reception.update') }}" class="p-2" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $patientLists->id }}">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content shampan-heading">
                                                <div class="active tab-pane" id="general-information">
                                                    <!-- Post -->
                                                    <div class="col-md-12">
                                                        <div class="row">

                                                            <div class="col-2 form-group">
                                                                <p class="p-tag">Patient ID</p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('patient_id') is-invalid @enderror"
                                                                    placeholder="" id="patient_id" name="patient_id"
                                                                    type="text"
                                                                    value="{{ old('patient_id') ? old('patient_id') : $patientLists->patient_id }}"
                                                                    required disabled>
                                                                <!-- </div> -->
                                                                @error('patient_id')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-4 form-group">
                                                                <p class="p-tag">Name <span class="text-danger">*</span>
                                                                </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('name') is-invalid @enderror"
                                                                    placeholder="" id="name" name="name"
                                                                    type="text"
                                                                    value="{{ old('name') ? old('name') : $patientLists->name }}"
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
                                                                        {{ (old('gender') ? old('gender') : $patientLists->gender == 'Male') ? 'selected' : '' }}>
                                                                        Male</option>
                                                                    <option value="Female"
                                                                        {{ (old('gender') ? old('gender') : $patientLists->gender == 'Female') ? 'selected' : '' }}>
                                                                        Female</option>
                                                                    <option value="Other"
                                                                        {{ (old('gender') ? old('gender') : $patientLists->gender == 'Other') ? 'selected' : '' }}>
                                                                        Other</option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('gender')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-2 form-group">
                                                                <p class="p-tag">Age <span class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('age') is-invalid @enderror"
                                                                    placeholder="" id="age" name="age"
                                                                    type="number"
                                                                    value="{{ old('age') ? old('age') : $patientLists->age }}"
                                                                    required>
                                                                <!-- </div> -->
                                                            </div>


                                                            <div class="col-2 form-group">
                                                                <p class="p-tag">Blood Group</p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="blood_group"
                                                                    name="blood_group">
                                                                    <option value="">----</option>
                                                                    <option value="A+"
                                                                        {{ (old('blood_group') ? old('blood_group') : $patientLists->blood_group == 'A+') ? 'selected' : '' }}>
                                                                        A+</option>
                                                                    <option value="A-"
                                                                        {{ (old('blood_group') ? old('blood_group') : $patientLists->blood_group == 'A-') ? 'selected' : '' }}>
                                                                        A-</option>
                                                                    <option value="B+"
                                                                        {{ (old('blood_group') ? old('blood_group') : $patientLists->blood_group == 'B+') ? 'selected' : '' }}>
                                                                        B+</option>
                                                                    <option value="B-"
                                                                        {{ (old('blood_group') ? old('blood_group') : $patientLists->blood_group == 'B-') ? 'selected' : '' }}>
                                                                        B-</option>
                                                                    <option value="AB+"
                                                                        {{ (old('blood_group') ? old('blood_group') : $patientLists->blood_group == 'AB+') ? 'selected' : '' }}>
                                                                        AB+</option>
                                                                    <option value="AB-"
                                                                        {{ (old('blood_group') ? old('blood_group') : $patientLists->blood_group == 'AB-') ? 'selected' : '' }}>
                                                                        AB-</option>
                                                                    <option value="O+"
                                                                        {{ (old('blood_group') ? old('blood_group') : $patientLists->blood_group == 'O+') ? 'selected' : '' }}>
                                                                        O+</option>
                                                                    <option value="O-"
                                                                        {{ (old('blood_group') ? old('blood_group') : $patientLists->blood_group == 'O-') ? 'selected' : '' }}>
                                                                        O-</option>
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
                                                                    type="phone"
                                                                    value="{{ old('mobile') ? old('mobile') : $patientLists->mobile }}"
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
                                                                    name="guardian_mobile" type="phone"
                                                                    value="{{ old('guardian_mobile') ? old('guardian_mobile') : $patientLists->guardian_mobile }}">
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
                                                                    value="{{ old('address') ? old('address') : $patientLists->address }}">
                                                                <!-- </div> -->
                                                                @error('address')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-12 form-group">
                                                                <p class="p-tag">Patient Summary <span
                                                                        class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <textarea class="form-control custom-focus @error('patient_summary') is-invalid @enderror" placeholder=""
                                                                    id="patient_summary" name="patient_summary" type="text">{{ old('patient_summary') ? old('patient_summary') : $patientLists->patient_summary }}</textarea>
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
                                                                        {{ (old('patient_type') ? old('patient_type') : $patientLists->patient_type == 'General') ? 'selected' : '' }}>
                                                                        General</option>
                                                                    <option value="CBD"
                                                                        {{ (old('patient_type') ? old('patient_type') : $patientLists->patient_type == 'CBD') ? 'selected' : '' }}>
                                                                        CBD</option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('patient_type')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Assign Doctor </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="doctor_id"
                                                                    name="doctor_id" >
                                                                    <option value="">----</option>
                                                                    @foreach ($doctor as $list)
                                                                        <option class="capitalize" value="{{ $list->id }}"
                                                                            {{ (old('doctor_id') ? old('doctor_id') : $list->id) ? 'selected' : '' }}>
                                                                            {{ $list->name . ' - '. $list->type }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('doctor_id')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            {{-- <div class="col-3 form-group">
                                                                <p class="p-tag">Ward </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="ward_id"
                                                                    name="ward_id">
                                                                    <option value="">Select Ward</option>
                                                                    @foreach ($wards as $list)
                                                                        <option value="{{ $list->id }}"
                                                                            {{ (old('ward_id') ? old('ward_id') : $list->id) ? 'selected' : '' }}>
                                                                            {{ $list->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('ward_id')
                                                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>


                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Bed</p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="bed_id"
                                                                    name="bed_id">
                                                                    <option value="">Select Bed</option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('bed_id')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div> --}}


                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Reference </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="reference"
                                                                    name="reference">
                                                                    <option value="">----</option>
                                                                    <option value="GENERAL"
                                                                        {{ (old('reference') ? old('voucher') : $patientLists->reference == 'GENERAL') ? 'selected' : '' }}>
                                                                        GENERAL</option>
                                                                    <option value="DMSC"
                                                                        {{ (old('reference') ? old('voucher') : $patientLists->reference == 'DMSC') ? 'selected' : '' }}>
                                                                        DMSC</option>
                                                                    <option value="MOD"
                                                                        {{ (old('reference') ? old('voucher') : $patientLists->reference == 'MOD') ? 'selected' : '' }}>
                                                                        MOD</option>
                                                                    <option value="MED"
                                                                        {{ (old('reference') ? old('voucher') : $patientLists->reference == 'MED') ? 'selected' : '' }}>
                                                                        MED</option>
                                                                    <option value="CBD"
                                                                        {{ (old('reference') ? old('voucher') : $patientLists->reference == 'CBD') ? 'selected' : '' }}>
                                                                        CBD</option>

                                                                </select>
                                                                <!-- </div> -->
                                                                @error('voucher')
                                                                    <span
                                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-3 form-group">
                                                                <p class="p-tag">Room Number </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('room_number') is-invalid @enderror"
                                                                    placeholder="" id="room_number" name="room_number"
                                                                    type="text"
                                                                    value="{{ old('room_number') ? old('room_number') : $patientLists->room_number }}">
                                                                <!-- </div> -->
                                                                @error('room_number')
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
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
        $(document).ready(function() {
            $('#ward_id').on('change', function() {
                var wardId = $(this).val();

                if (wardId) {
                    $.ajax({
                        url: '{{ route('get.beds.by.ward') }}',
                        type: 'GET',
                        data: {
                            ward_id: wardId
                        },
                        success: function(data) {
                            $('#bed_id').empty();
                            $('#bed_id').append('<option value="">Select Bed</option>');
                            $.each(data, function(key, bed) {
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
