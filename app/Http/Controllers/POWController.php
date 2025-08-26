<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Doctor;
use App\Models\ICUPatient;
use App\Models\Operation;
use App\Models\Patient;
use App\Models\PatientDailySummary;
use App\Models\PatientMedicine;
use App\Models\PatientStatus;
use App\Models\POWPatient;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class POWController extends Controller
{
    public function index()
    {
        $data['patientsData'] = POWPatient::with('operation.patient', 'operation.doctor', 'doctor', 'bed')->get();
        
        // Find POW ward and count empty beds
        $powWard = Ward::where('type', 'POW')->first();
        $data['emptyBeds'] = $powWard ? Bed::where('ward_id', $powWard->id)->where('bed_status', 'empty')->count() : 0;
        
        //        dd($data['patientsData']);

        return view('pow.patient-list', $data);
    }

    public function singleDocPatientList($id)
    {
        $data['patientsData'] = POWPatient::with('operation.patient', 'operation.doctor', 'doctor', 'bed')->where('doctor_id', $id)->get();
        //        dd($data['patientsData']);

        return view('pow.single-doc-patient-list', $data);
    }

    public function patientInfo($id)
    {
        $data['patientData'] = POWPatient::with('operation.patient', 'operation.doctor', 'doctor', 'bed')->find($id);
        if (isset($data['patientData']->operation->patient_id)) {
            $patientId = $data['patientData']->operation->patient_id;
            $data['patientSummary'] = PatientDailySummary::where('patient_id', $patientId)->with('doctor')->latest()->get();
            $data['previousOperation'] = Operation::where('patient_id', $patientId)->where('iscomplete', 1)->with('doctor', 'service')->get();
            $data['nextOperation'] = Operation::where('patient_id', $patientId)->where('iscomplete', 0)->with('doctor', 'service')->get();
            //            patient_status
            $data['patientStatus'] = PatientStatus::where('patient_id', $patientId)->latest()->first();
            $data['patientActiveMedicines'] = PatientMedicine::where('patient_id', $patientId)->where('status', 'active')->orderBy('date', 'desc')->get();
        } else {
            Alert::toast('Patient data not found', 'error')->width('570px');
            return redirect()->route('pow.patientList');
        }
        return view('pow.patient-info', $data);
    }

    public function doctorList()
    {
        $data['doctorList'] = POWPatient::selectRaw('doctor_id, COUNT(*) as total_assigned_patient')
            ->groupBy('doctor_id')
            ->with('doctor')
            ->get();
        //        dd($data['doctorList']);
        return view('pow.doctor-list', $data);
    }

    public function addForm($id)
    {
        // dd($request->all());
        $data['operationData'] = Operation::with('patient')->where('id', '=', $id)->first();
        if (!$data['operationData']) {
            Alert::toast('No patient found with this ID', 'alert')->width('375px');
            return redirect()->back();
        }

        $data['beds'] = Bed::where('ward_id', 2)->where('bed_status', 'empty')->get();
        $data['doctors'] = Doctor::where('type', '=', 'pow_doctor')->get();
        //        dd($data['patientData']);
        return view('pow.add-patient-form', $data);
    }

    public function addPatient(Request $request)
    {
//                dd($request->all());
        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'operation_id' => 'required',
                'bed_no' => 'required',
                'doctor_id' => 'required'
            ]);
            if ($validator->fails()) {
                Alert::toast('Fill in the required fields', 'error')->width('375px');
                return redirect()->back();
            } else {
//                operation id look for the patient id
                $operationData = Operation::findOrFail($request->operation_id);
                $patientId = $operationData->patient_id;
                $createNewData = new POWPatient();
                $createNewData->operation_id = $request->operation_id;
                $createNewData->bed_id = $request->bed_no;
                $createNewData->doctor_id = $request->doctor_id;
                $createNewData->required_materials = json_encode($request->material);
                $createNewData->save();
                // check if the patient is already in the bed
                $checkDuplicateBedBooking = Bed::where('patient_id', $patientId)->first();
                if ($checkDuplicateBedBooking) {
                    Bed::findOrFail($checkDuplicateBedBooking->id)->update([
                        'bed_status' => "empty",
                        'patient_id' => null
                    ]);
                }
                Bed::findOrFail($request->bed_no)->update([
                    'bed_status' => "occupied",
                    'patient_id' => $patientId
                ]);

                DB::commit();
                Alert::toast('Patient Moved to POW Successfully.', 'success')->width('375px');
                return redirect()->route('pow.patientInfo', ['id' => $createNewData->id]);
            }
        } catch (\Throwable $e) {
//            dd($e->getMessage());
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
