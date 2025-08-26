{{-- <div class="p-4 rounded-lg bg-white shadow-lg">
    <h1 class="mb-4 form-label h3">Temporary Doctors</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped classList" id="">
            <thead>
                <th>Doctor ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Total Assigned Patients</th>
                <th>Actions</th>
            </thead>



            <tbody>
                @foreach ($visitingDoctors as $item)
                    <tr>
                        <td>{{ $item->doctor_id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->contactNumber }}</td>
                        <td>{{ $item->patient_doctor_assignment_count }}</td>
                        <td>
                            <a href="{{ route('nurse.patientList', ['id'=>$item->id]) }}"
                                class="btn btn-sm btn-info my-2" title="View">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div> --}}

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
            @forelse ($patients as $item)
                @if (!$item->patient || !$item->patient->doctor || $item->patient->doctor->employee_status == 'permanent')
                    @continue
                @endif
                <tr>
                    <td>{{ $item->patient->patient_id ?? 'N/A' }}</td>
                    <td>{{ $item->patient->name ?? 'N/A' }}</td>
                    <td>{{ $item->patient->gender ?? 'N/A' }} </td>
                    <td>{{ $item->patient->mobile ?? 'N/A' }}</td>
                    <td>{{ $item->ward->location ?? 'N/A' }}</td>
                    <td>{{ $item->bed_number }}</td>
                    <td>
                        @if($item->patient)
                            <a href="{{ route('nurse.patientDetails', $item->patient->id) }}" class="btn btn-sm btn-info my-2" title="View">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                        @else
                            <span class="text-muted">No Patient</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            No patients with temporary doctors found.
                        </div>
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
</div>
