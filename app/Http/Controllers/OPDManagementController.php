<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\OPDPatientSerial;
use Illuminate\Http\Request;

class OPDManagementController extends Controller
{
    public function index()
    {
        $opdDoctors = Doctor::where('type', 'opd_doctor')->orderBy('name')->get();
        
        // Get patient details for each doctor
        $today = date('Y-m-d');
        foreach ($opdDoctors as $doctor) {
            $pendingPatients = OPDPatientSerial::where('doctor_id', $doctor->id)
                ->where('status', 'pending')
                ->where('date', '>=', $today)
                ->with('patient')
                ->get();
            
            $doctor->pending_patients_count = $pendingPatients->count();
            
            // Get today's patients
            $doctor->today_patients_count = $pendingPatients->where('date', $today)->count();
            
            // Get future patients
            $doctor->future_patients_count = $pendingPatients->where('date', '>', $today)->count();
            
            // Get latest patient name (most recent appointment)
            $latestPatient = $pendingPatients->sortByDesc('created_at')->first();
            $doctor->latest_patient_name = $latestPatient ? $latestPatient->patient->name : 'No patients';
        }
        
        $data['opdDoctors'] = $opdDoctors;
        return view('opd.management', $data);
    }

    public function doctorPatients($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $today = date('Y-m-d');
        
        $query = OPDPatientSerial::where('doctor_id', $doctorId)
            ->where('status', 'pending')
            ->where('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->orderBy('id', 'desc')
            ->with('patient');
            
        $data['patientLists'] = $query->get();
        $data['totalPatient'] = $query->count();
        $data['doctor'] = $doctor;
        
        return view('opd.management-patient-list', $data);
    }

    public function editPatient($doctorId, $patientId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $opdSerial = OPDPatientSerial::with('patient')->findOrFail($patientId);
        
        // Verify this patient belongs to this doctor
        if ($opdSerial->doctor_id != $doctorId) {
            abort(403, 'Unauthorized access to patient data.');
        }
        
        $data['doctor'] = $doctor;
        $data['opdSerial'] = $opdSerial;
        $data['patient'] = $opdSerial->patient;
        
        return view('opd.management-edit-patient', $data);
    }

    public function updatePatient(Request $request, $doctorId, $patientId)
    {
        $request->validate([
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'serial' => 'nullable|integer|min:1'
        ]);

        $opdSerial = OPDPatientSerial::findOrFail($patientId);
        
        // Verify this patient belongs to this doctor
        if ($opdSerial->doctor_id != $doctorId) {
            abort(403, 'Unauthorized access to patient data.');
        }

        $opdSerial->date = $request->date;
        $opdSerial->amount = $request->amount;
        if ($request->serial) {
            $opdSerial->serial = $request->serial;
        }
        $opdSerial->save();

        return redirect()->route('opd.management.doctor-patients', $doctorId)
                        ->with('success', 'Patient information updated successfully.');
    }

    public function deletePatient($doctorId, $patientId)
    {
        $opdSerial = OPDPatientSerial::findOrFail($patientId);
        
        // Verify this patient belongs to this doctor
        if ($opdSerial->doctor_id != $doctorId) {
            abort(403, 'Unauthorized access to patient data.');
        }

        // Only allow deletion of pending appointments
        if ($opdSerial->status !== 'pending') {
            return redirect()->route('opd.management.doctor-patients', $doctorId)
                            ->with('error', 'Only pending appointments can be deleted.');
        }

        $patientName = $opdSerial->patient->name;
        $opdSerial->delete();

        return redirect()->route('opd.management.doctor-patients', $doctorId)
                        ->with('success', "Patient appointment for {$patientName} has been deleted successfully.");
    }
}