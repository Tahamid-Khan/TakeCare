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
                                <h3 class="h3">OPD Patient Registration</h3>
                            </div>


                            <div class="p-4 mt-4">
                                <form action="{{ route('reception.opd-registration.store') }} " method="POST">@csrf
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
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" id="age" name="age">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option selected disabled>Please Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="p-Number">Phone Number</label>
                                            <input type="number" pattern="[0-9]*" class="form-control" id="p-Number"
                                                name="mobile">
                                        </div>
                                        <script>
                                            document.getElementById('p-Number ').addEventListener('input', function(e) {
                                                let value = e.target.value;
                                                e.target.value = value.replace(/[^0-9]/g, '');
                                            });
                                        </script>
                                        {{-- <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="department">Department</label>
                                            <select class="form-control" id="department" name="department_id">
                                                <option selected disabled>Please Select</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> --}}
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
                                            <label for="patient_type">Patient Type</label>
                                            <select class="form-control" id="patient_type" name="patient_type">
                                                <option selected disabled>Please Select</option>
                                                <option value="General">General</option>
                                                <option value="C Board">C Board</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount" >
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <button type="submit" class="btn btn-primary">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-body">
                                {{-- <div class="col-md-3">
                                    <div class="form-group row bg-white">
                                        <label for="total" class="col-form-label">Today's Total: <span>{{$totalPatient}}</span></label>
                                    </div>
                                </div> --}}

                                <div class="col-md-3">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="text-dark font-bold">Today's Total: <span>{{$totalPatient}}</span></h3>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                        <th>Date</th>
                                        <th>SL.Number</th>
                                        <th>Patient Name</th>
                                        <th>Mobile</th>
                                        <th>Patient Type</th>
                                        <th>Action</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($patientLists as $item)
                                            <tr>
                                                <td>{{ $item->date }}</td>
                                                <td>{{ $item->serial }}</td>
                                                <td>{{ $item->patient->name }}</td>
                                                <td>{{ $item->patient->mobile }}</td>
                                                <td>{{ $item->patient->patient_type }}</td>
                                                <td>
                                                    {{-- <a  href="{{ route('opd.view', ['id' => $item->id]) }}"
                                                        class="btn btn-sm btn-info my-2" title="View">
                                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a> --}}

                                                    <a href="{{ route('reception.opd-slip-pdf', ['id' => $item->id]) }}" class="btn btn-sm btn-info my-2" title="Print">Print Token</a>
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

        $(document).ready(function() {
            $('#doctor_id').select2();

            $('#patient_type').change(function() {
                let patient_type = $(this).val();
                if (patient_type === 'C Board') {
                    $('#amount').val(10);
                    // $('#amount').attr('readonly', 'readonly');
                } else if (patient_type === 'General') {
                    $('#amount').val('20');
                    // $('#amount').removeAttr('readonly');
                }
            });
        });
    </script>
@endpush
