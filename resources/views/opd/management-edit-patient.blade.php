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
                                <h3 class="h3">Edit Patient Appointment - {{ $patient->name }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('opd.management.doctor-patients', $doctor->id) }}" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-arrow-left"></i> Back to Patient List
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="{{ route('opd.management.update-patient', ['doctorId' => $doctor->id, 'patientId' => $opdSerial->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="patient_name">Patient Name</label>
                                                        <input type="text" class="form-control" id="patient_name" value="{{ $patient->name }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="patient_id">Patient ID</label>
                                                        <input type="text" class="form-control" id="patient_id" value="{{ $patient->patient_id }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="doctor_name">Doctor</label>
                                                        <input type="text" class="form-control" id="doctor_name" value="{{ $doctor->name }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="serial">Serial Number</label>
                                                        <input type="number" class="form-control @error('serial') is-invalid @enderror" 
                                                               id="serial" name="serial" value="{{ old('serial', $opdSerial->serial) }}" min="1">
                                                        @error('serial')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="date">Appointment Date <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                                               id="date" name="date" value="{{ old('date', $opdSerial->date) }}" required>
                                                        @error('date')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                                               id="amount" name="amount" value="{{ old('amount', $opdSerial->amount) }}" 
                                                               min="0" step="0.01" required>
                                                        @error('amount')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <input type="text" class="form-control" id="status" value="{{ ucfirst($opdSerial->status) }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="created_at">Created At</label>
                                                        <input type="text" class="form-control" id="created_at" value="{{ $opdSerial->created_at->format('Y-m-d H:i:s') }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i> Update Appointment
                                                </button>
                                                <a href="{{ route('opd.management.doctor-patients', $doctor->id) }}" class="btn btn-secondary">
                                                    <i class="fas fa-times"></i> Cancel
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Patient Information</h3>
                                            </div>
                                            <div class="card-body">
                                                <p><strong>Name:</strong> {{ $patient->name }}</p>
                                                <p><strong>Age:</strong> {{ $patient->age }}</p>
                                                <p><strong>Gender:</strong> {{ $patient->gender }}</p>
                                                <p><strong>Mobile:</strong> {{ $patient->mobile }}</p>
                                                <p><strong>Address:</strong> {{ $patient->address ?? 'N/A' }}</p>
                                                <p><strong>Patient Type:</strong> {{ $patient->patient_type }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection