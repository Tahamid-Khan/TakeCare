{{-- <div class="p-4 rounded-lg bg-white shadow-lg">
    <h1 class="mb-4 form-label h3">Duty Doctor</h1>


    <form action="" method="GET">
        <div class="row">
            <div class="form-group col-12 col-md-4 col-xl-3">
                <label for="available" class="form-label">Available Doctor</label>
                <select name="available" id="available" class="form-control">
                    <option >Select</option>
                    <option {{ isset($available) ? $available == 'all' ? 'selected' : '' : '' }} value="all">All</option>
                    <option {{ isset($available) ? $available == 'available' ? 'selected' : '' : '' }} value="available">Available</option>
                </select>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped classList" id="">
            <thead>
                <th>Doctor ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Total Assigned Patients</th>
                <th>Available</th>
                <th>Actions</th>
            </thead>

            <tbody>
                @foreach ($dutyDoctors as $item)
                    <tr>
                        <td>{{ $item->doctor_id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->contactNumber }}</td>
                        <td>{{ $item->patient_doctor_assignment_count }}</td>
                        <td>
                            @if ($item->status == '1')
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('nurse.patientList', ['id' => $item->id]) }}" class="btn btn-sm btn-info my-2"
                                title="View">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@push('custom_js')
    <script>
        $('#available').on('change', function() {
            this.form.submit();
        });
    </script>
@endpush --}}

<div class="rounded border p-4 shadow-lg bg-white">
    <style>
        .display-4 {
            font-size: 2rem;
            font-weight: normal;
        }
    </style>

    @userType('nurse')
    <h2 class="py-3 display-4">Patient List - Ward No:
        <span class="font-weight-bold">{{  $ward->name }}</span>
    </h2>
    @enduserType
    @userType('admin')
    <h2 class="py-3 display-4">Patient Lists</h2>
    @enduserType

    <div class="table-responsive">
        <table id="" class="table table-bordered table-striped classList">
            <thead>
            <th>Patient ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Mobile</th>
            <th>Department</th>
            <th>Bed No</th>
            <th>Action</th>
            </thead>


            <tbody>
            @foreach ($patients as $item)
                @if ($item->patient->doctor->employee_status != 'permanent')
                    @continue
                @endif
                <tr>
                    <td>{{ $item->patient->patient_id }}</td>
                    <td>{{ $item->patient->name }}</td>
                    <td>{{ $item->patient->gender }} </td>
                    <td>{{ $item->patient->mobile }}</td>
                    <td>{{ $item->ward->location }}</td>
                    <td>{{ $item->bed_number }}</td>
                    <td>
                        <a href="{{ route('nurse.patientDetails', $item->patient->id) }}" class="btn btn-sm btn-info my-2" title="View">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
