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
                                <h3 class="h3">OPD Management - {{ $doctor->name }}'s Patients</h3>
                                <div class="card-tools">
                                    <a href="{{ route('opd.management') }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-arrow-left"></i> Back to Doctor List
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="text-dark font-bold">Doctor: {{ $doctor->name }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="text-dark font-bold">Total Pending: <span>{{ $totalPatient }}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-bordered table-striped" id="patientList">
                                    <thead>
                                        <th>SL.Number</th>
                                        <th>Date</th>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Mobile</th>
                                        <th>Patient Type</th>
                                        <th>Actions</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($patientLists as $item)
                                            <tr>
                                                <td>{{ $item->serial }}</td>
                                                <td>
                                                    {{ $item->date }}
                                                    @if($item->date < date('Y-m-d'))
                                                        <span class="badge badge-warning">Past</span>
                                                    @elseif($item->date == date('Y-m-d'))
                                                        <span class="badge badge-success">Today</span>
                                                    @else
                                                        <span class="badge badge-info">Future</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->patient->patient_id }}</td>
                                                <td>{{ $item->patient->name }}</td>
                                                <td>{{ $item->patient->age }}</td>
                                                <td>{{ $item->patient->mobile }}</td>
                                                <td>{{ $item->patient->patient_type }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('opd.view', ['id' => $item->id]) }}"
                                                           class="btn btn-sm btn-info" title="View Details">
                                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="{{ route('opd.management.edit-patient', ['doctorId' => $doctor->id, 'patientId' => $item->id]) }}"
                                                           class="btn btn-sm btn-warning" title="Edit Patient">
                                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger delete-patient" 
                                                                data-patient-id="{{ $item->id }}" 
                                                                data-patient-name="{{ $item->patient->name }}"
                                                                title="Delete Patient">
                                                            <i class="fas fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
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
            $("#patientList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false
            });

            // Delete patient confirmation
            $('.delete-patient').on('click', function() {
                const patientId = $(this).data('patient-id');
                const patientName = $(this).data('patient-name');
                
                if (confirm(`Are you sure you want to delete patient "${patientName}"? This action cannot be undone.`)) {
                    // Create a form and submit it
                    const form = $('<form>', {
                        'method': 'POST',
                        'action': '{{ route("opd.management.delete-patient", ["doctorId" => $doctor->id, "patientId" => "__PATIENT_ID__"]) }}'.replace('__PATIENT_ID__', patientId)
                    });
                    
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': '{{ csrf_token() }}'
                    }));
                    
                    form.append($('<input>', {
                        'type': 'hidden',
                        'name': '_method',
                        'value': 'DELETE'
                    }));
                    
                    $('body').append(form);
                    form.submit();
                }
            });
        });
    </script>
@endpush