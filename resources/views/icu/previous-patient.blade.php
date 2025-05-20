@php
    $patientLists = [
        (object) [
            'id' => 'P0453',
            'name' => 'John Doe',
            'gender' => 'male',
            'assigned_doctor' => 'Dr. Smith',
            'icu_hdu' => 'ICU',
            'bed_no' => 'A-101',
        ],
        (object) [
            'id' => 'P0454',
            'name' => 'Jane Doe',
            'gender' => 'female',
            'assigned_doctor' => 'Dr. Smith',
            'icu_hdu' => 'HDU',
            'bed_no' => 'A-102',
        ],
        (object) [
            'id' => 'P0455',
            'name' => 'John Doe',
            'gender' => 'male',
            'assigned_doctor' => 'Dr. Smith',
            'icu_hdu' => 'ICU',
            'bed_no' => 'A-101',
        ],
    ];
@endphp

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
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
