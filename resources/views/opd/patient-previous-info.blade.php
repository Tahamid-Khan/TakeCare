@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="">
                    <div class="">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">Create new appointment</h3>
                            </div>


                            <div class="container mt-4">
                                <form action="" method="POST">@csrf
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control"
                                                value="{{ \Carbon\Carbon::now()->toDateString() }}" id="date"
                                                name="date">
                                        </div>
                                        {{-- <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="sNumber">Serial Number</label>
                                            <input type="number" class="form-control" id="sNumber" name="sNumber">
                                        </div> --}}
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="name">Name</label>
                                            <input value="{{ $patientData->name }}" type="text" class="form-control"
                                                id="name" disabled>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="age">Age</label>
                                            <input value="{{ $patientData->age }}" type="number" class="form-control"
                                                id="age" disabled>
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" disabled>
                                                <option>Please Select</option>
                                                <option {{ $patientData->gender == 'Male' ? 'selected' : '' }}
                                                    value="Male">Male</option>
                                                <option {{ $patientData->gender == 'Female' ? 'selected' : '' }}
                                                    value="Female">Female</option>
                                                <option {{ $patientData->gender == 'Other' ? 'selected' : '' }}
                                                    value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="p-Number">Phone Number</label>
                                            <input value="{{ $patientData->mobile }}" type="text" pattern="[0-9]*"
                                                class="form-control" id="p-Number" disabled>
                                        </div>
                                        <script>
                                            document.getElementById('p-Number ').addEventListener('input', function(e) {
                                                var value = e.target.value;
                                                e.target.value = value.replace(/[^0-9]/g, '');
                                            });
                                        </script>
                                        {{-- <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="address">Address</label>
                                            <input value="{{ $patientData->address }}" type="text" class="form-control" id="address" disabled>
                                        </div>
{{--                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">--}}
{{--                                            <label for="department">Department</label>--}}
{{--                                            <select class="form-control" id="department" name="department_id">--}}
{{--                                                <option selected disabled>Please Select</option>--}}
{{--                                                @foreach ($departments as $department)--}}
{{--                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="doctor">Assign Doctor</label>
                                            <select class="form-control" id="doctor_id" name="doctor_id">
                                                <option selected disabled>Please Select</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Room Number --}}
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="room">Room Number</label>
                                            <input type="text" class="form-control" id="room" name="room_number">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="cluster">Patient Type</label>
                                            <select class="form-control" id="cluster" name="cluster" disabled>
                                                <option {{ $patientData->patient_type == 'General' ? 'selected' : '' }} value="General">General</option>
                                                <option {{ $patientData->patient_type == 'C Board' ? 'selected' : '' }} value="C Board">C Board</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount">
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            {{-- Previous History --}}
                            <div class="card-header">
                                <h3 class="h3">Patient Previous Info</h3>
                            </div>
                            <div class="p-4">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                        <th>Date</th>
                                        <th>Doctor ID</th>
                                        <th>Doctor</th>
                                    </thead>

                                    <tbody>

                                        @foreach ($previousSerial as $item)
                                            <tr>
                                                <td>{{ $item->date }}</td>
                                                <td>{{ $item->doctor->doctor_id }}</td>
                                                <td>{{ $item->doctor->name }}</td>
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

        $(document).ready(function() {
            $('#doctor_id').select2();

            let cluster = $('#cluster');
            if (cluster.val() === 'C Board') {
                $('#amount').val(10);
                // $('#amount').attr('readonly', 'readonly');
            } else {
                $('#amount').val(20);
                // $('#amount').removeAttr('readonly');
            }
            cluster.change(function() {
                let cluster = $(this).val();
                if (cluster === 'C Board') {
                    $('#amount').val(10);
                    // $('#amount').attr('readonly', 'readonly');
                } else {
                    $('#amount').val(20);
                    // $('#amount').removeAttr('readonly');
                }
            });
        });
    </script>
@endpush
