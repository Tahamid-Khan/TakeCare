<div class="table-responsive p-4">
    <h2 class="h2">Current Patient</h2>
    <table class="table table-bordered table-striped" id="classList">
        <thead>
        <th>Patient ID</th>
        <th>Patient Name</th>
        <th>Gender</th>
        <th>Assigned Doctor</th>
        <th>ICU/HDU</th>
        <th>Bed No</th>
        <th>Action</th>
        </thead>

        <tbody>
        @foreach ($patientsData as $item)
            <tr>
                <td>{{ $item->patient->patient_id }}</td>
                <td>{{ $item->patient->name }}</td>
                <td>{{ $item->patient->gender }}</td>
                <td>{{ $item->doctor->name }}</td>
                <td>{{ $item->isICU == 1 ? "ICU" : "HDU" }}</td>
                <td>{{ $item->bed->bed_number }}</td>
                <td>
                    <a href="{{ route('icu.patientInfo', ['id'=>$item->id]) }}" class="btn btn-sm btn-info my-2" title="View">
                        <i class="fas fa-eye" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
