@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="p-4 rounded-lg bg-white shadow-lg">
                <h1 class="mb-4 form-label h3">Operation List</h1>

                <table class="table table-bordered table-striped" id="upcoming-ot-table">
                    <thead>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Operation Name</th>
                        <th>Date</th>
                        <th>Doctor</th>
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
                        <tr>
                            <td>P001</td>
                            <td>xyz</td>
                            <td>Appendix</td>
                            <td>2021-09-01</td>
                            <td>Dr. John Doe</td>
                            <td>
                                <a href="{{ route('ot.view', ['id'=>1]) }}"
                                    class="btn btn-sm btn-info my-2" title="View">
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        {{-- @foreach ($patients as $item)
                            <tr>
                                <td>{{ $item->patient_id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->bed_no }}</td>
                                <td>{{ $item->doctor }}</td>
                                <td>
                                    <a href="{{ route('nurse.patientList', ['id'=>$item->id]) }}"
                                        class="btn btn-sm btn-info my-2" title="View">
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>

                </table>
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
    </script>
@endpush
