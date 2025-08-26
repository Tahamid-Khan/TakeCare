<div class="table-responsive p-4">
    <h2 class="h2">Previous Patient</h2>
    <table class="table table-bordered table-striped" id="classList2">
        <thead>
        <th>Patient ID</th>
        <th>Patient Name</th>
        <th>Gender</th>
        <th>Assigned Doctor</th>
        <th>ICU/HDU</th>
        <th>Bed No</th>
        <th>Discharge Date</th>
        </thead>

        <tbody>
        @foreach ($previousPatientsData as $item)
            <tr>
                <td>{{ $item->patient->patient_id }}</td>
                <td>{{ $item->patient->name }}</td>
                <td>{{ $item->patient->gender }}</td>
                <td>{{ $item->doctor->name }}</td>
                <td>{{ $item->isICU == 1 ? "ICU" : "HDU" }}</td>
                <td>{{ $item->bed->bed_number }}</td>
                <td>{{ $item->updated_at->format('Y-m-d H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
