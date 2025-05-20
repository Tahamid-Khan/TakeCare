<div class="p-4 rounded-lg bg-white shadow-lg">
    <h1 class="mb-4 form-label h3">Discharge Request</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped classList" id="">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Doctor ID</th>
                <th>Doctor</th>
                <th>Action</th>
            </thead>



            <tbody>
            @foreach($patients as $item)
                @if (isset($item->patient->patientDischarge[0]))
                    <tr>
                        <td>{{ $item->patient->patient_id }}</td>
                        <td>{{ $item->patient->name }}</td>
                        <td>{{ $item->patient->doctor->doctor_id }}</td>
                        <td>{{ $item->patient->doctor->name }}</td>
                        <td>
                            @if($item->patient->patientDischarge[0]->status == 'pending')
                            <a href="{{ route('nurse.discharge-letter', $item->patient->patientDischarge[0]->id) }}" class="btn btn-sm btn-info my-2"
                               title="Generate Discharge Letter">
                                Generate
                            </a>
                            @elseif($item->patient->patientDischarge[0]->status == 'generated')
                            <a href="{{ route('duty-doctor.view-discharge-letter',$item->patient->patientDischarge[0]->id) }}" class="btn btn-sm btn-info my-2"
                               title="View Discharge Letter">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>

        </table>
    </div>
</div>
