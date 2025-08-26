<div class="rounded border p-4 shadow-lg bg-white">
    <style>
        .display-4 {
            font-size: 2rem;
            font-weight: normal;
        }
    </style>
{{--@php(dd($patients))--}}
    @userType('nurse')
    <h2 class="py-3 display-4">Patient List - Ward No: <span
            class="font-weight-bold">{{ $ward ? $ward->name : 'Not Assigned' }}</span></h2>
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
                    <tr>
                        <td>{{ $item->patient ? $item->patient->patient_id : 'N/A' }}</td>
                        <td>{{ $item->patient ? $item->patient->name : 'N/A' }}</td>
                        <td>{{ $item->patient ? $item->patient->gender : 'N/A' }} </td>
                        <td>{{ $item->patient ? $item->patient->mobile : 'N/A' }}</td>
                        <td>{{ $item->ward ? $item->ward->location : 'N/A' }}</td>
                        <td>{{ $item->bed_number }}</td>
                        <td>
                            @if($item->patient)
                                <a href="{{ route('nurse.patientDetails', $item->patient->id) }}"
                                    class="btn btn-sm btn-info my-2" title="View">
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
                                @userType('nurse')
                                    No patients currently admitted in your assigned ward.
                                @enduserType
                                @userType('admin')
                                    No patients currently admitted in any ward.
                                @enduserType
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
