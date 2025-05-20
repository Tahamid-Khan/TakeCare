<div class="p-4 rounded-lg bg-white shadow-lg">
    <h1 class="mb-4 form-label h3">POW Info</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped classList" id=''>
            <thead>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Bed No</th>
                <th>Assigned Doctor</th>
                <th>Actions</th>
            </thead>

            @php
                $patients = collect([
                    (object) [
                        'id' => '1',
                        'patient_id' => 'P001',
                        'name' => 'John Doe',
                        'bed_no' => 'B001',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '2',
                        'patient_id' => 'P002',
                        'name' => 'Jane Doe',
                        'bed_no' => 'B002',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '3',
                        'patient_id' => 'P003',
                        'name' => 'John Doe',
                        'bed_no' => 'B001',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '4',
                        'patient_id' => 'P004',
                        'name' => 'Jane Doe',
                        'bed_no' => 'B002',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '5',
                        'patient_id' => 'P005',
                        'name' => 'John Doe',
                        'bed_no' => 'B001',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '6',
                        'patient_id' => 'P006',
                        'name' => 'Jane Doe',
                        'bed_no' => 'B002',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '7',
                        'patient_id' => 'P007',
                        'name' => 'John Doe',
                        'bed_no' => 'B001',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '8',
                        'patient_id' => 'P008',
                        'name' => 'Jane Doe',
                        'bed_no' => 'B002',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '9',
                        'patient_id' => 'P009',
                        'name' => 'John Doe',
                        'bed_no' => 'B001',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '10',
                        'patient_id' => 'P010',
                        'name' => 'Jane Doe',
                        'bed_no' => 'B002',
                        'doctor' => 'Dr. Smith',
                    ],
                    (object) [
                        'id' => '11',
                        'patient_id' => 'P011',
                        'name' => 'Jane Doe',
                        'bed_no' => 'B002',
                        'doctor' => 'Dr. Smith',
                    ],
                ]);
            @endphp

            <tbody>
                @foreach ($patients as $item)
                    <tr>
                        <td>{{ $item->patient_id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->bed_no }}</td>
                        <td>{{ $item->doctor }}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">View</a>
                            {{-- <button class="btn btn-danger btn-sm"
                                onclick="dischargePatient('{{ $item->id }}')">Discharge</button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
