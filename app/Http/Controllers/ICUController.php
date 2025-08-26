<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\ICUPatient;
use App\Models\Patient;
use App\Models\PatientDailySummary;
use App\Models\PatientInvoice;
use App\Models\PatientMedicine;
use App\Models\PatientRefer;
use App\Models\PatientStatus;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ICUController extends Controller
{
    public function index()
    {
        $data['countPatients'] = ICUPatient::selectRaw('isICU, COUNT(*) as count')
            ->groupBy('isICU')
            ->where('isDischarged', 0)
            ->get();

        // To separate the counts for easier access
        $data['icuPatientsCount'] = $data['countPatients']->where('isICU', 1)->first()->count ?? 0;
        $data['hduPatientsCount'] = $data['countPatients']->where('isICU', 0)->first()->count ?? 0;
        
        // Current patients (not discharged)
        $data['patientsData'] = ICUPatient::with('patient', 'doctor', 'bed')->where('isDischarged', 0)->get();
        
        // Previous patients (discharged)
        $data['previousPatientsData'] = ICUPatient::with('patient', 'doctor', 'bed')->where('isDischarged', 1)->get();
        
        // dd($data['icuPatientsCount']);

        return view('icu.icu-dashboard', $data);
    }

    public function patientInfo($id)
    {
        $data['patientData'] = ICUPatient::with('patient', 'patient.PatientDailySummary', 'patient', 'patient.patientStatus', 'doctor', 'bed')->where('patient_id', $id)->first();
        if (isset($data['patientData']->patient_id)) {
            $patientId = $data['patientData']->patient_id;
            $data['patientActiveMedicines'] = PatientMedicine::where('patient_id', $patientId)->where('status', 'active')->orderBy('date', 'desc')->get();
            $data['patientSummary'] = PatientDailySummary::where('patient_id', $patientId)->latest()->limit(15)->get();
        }
        $data['patientStatus'] = PatientStatus::where('patient_id', $id)->latest()->first();
        $data['wards'] = Ward::all();
//        $data['hospitals'] = Hospital::all();
        $data['doctors'] = Doctor::all();
        $data['alreadyReferred'] = PatientRefer::where('patient_id', $id)->where('status', 0)->first();

        return view('icu.patient-info', $data);
    }

    public function releasePatientToPOW(Request $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            ICUPatient::where('patient_id', $request->patient_id)->update([
                'isDischarged' => 1
            ]);
            Bed::where('patient_id', $request->patient_id)->update([
                'bed_status' => 'empty',
                'patient_id' => null
            ]);
            Bed::where('id', $request->bed_id)->update([
                'bed_status' => 'occupied',
                'patient_id' => $request->patient_id
            ]);
            DB::commit();
            Alert::toast('Patient Released Successfully.', 'success')->width('375px');
            return redirect()->route('icu.dashboard');
        } catch (\Exception $e) {
            DB::rollback();
//            dd($e->getMessage());
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function store(Request $request, $id)
    {
//         dd($request->all());


        try {

            DB::beginTransaction();

            if ($request->summary != null) {
                PatientDailySummary::create([
                    'patient_id' => $id,
                    'doctor_id' => 1,
                    'summary' => $request->summary,
                ]);
            }
            // update isICU status
            ICUPatient::where('patient_id', $id)->update([
                'isICU' => $request->location,
            ]);

            // create DR Comment about the patient
            if ($request->comments != null) {
                PatientDailySummary::create([
                    'patient_id' => $id,
                    'doctor_id' => 1,
                    'summary' => $request->comments,
                ]);
            }

            if ($request->pulse_input != null || $request->bp_input != null || $request->temperature_input != null || $request->oxyzen_input != null) {
                PatientStatus::create([
                    'patient_id' => $id,
                    'user_id' => 1,
                    'pulse_rate' => $request->pulse_input == null ? 0 : $request->pulse_input,
                    'blood_pressure' => $request->bp_input == null ? 0 : $request->bp_input,
                    'temperature' => $request->temperature_input == null ? 0 : $request->temperature_input,
                    'oxygen_level' => $request->oxygen_input == null ? 0 : $request->oxygen_input,
                ]);
            }

            if ($request->has('manual_services') && $request->manual_services[0]['amount'] !== null ) {


                $total = 0;
                foreach ($request->manual_services as $item) {
                    $total += $item['amount'];
                }
                PatientInvoice::create([
                    'patient_id' => $id,
                    'fund_department_id' => 1,
                    'service_name' => "ICU Items",
                    'total_price' => $total,
                    'discount' => 0,
                    'final_price' => $total,
                    'due_amount' => $total,
                    'payment_status' => 'unpaid'
                ]);
            }

            DB::commit();
            Alert::toast('Current Status Added Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e);
//            return response()->json(['error' => $e->getMessage()]);
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function add()
    {
        return view('icu.add-new-patient');
    }

    public function addForm(Request $request)
    {
        // dd($request->all());
        if ($request->patient_id) {
            $data['patientData'] = Patient::where('patient_id', $request->patient_id)->first();
            if (!$data['patientData']) {
                Alert::toast('No patient found with this ID', 'alert')->width('375px');
                return redirect()->back();
            }
        } elseif ($request->mobile) {
            $data['patientData'] = Patient::where('mobile', $request->mobile)->first();
            if (!$data['patientData']) {
                Alert::toast('No patient found with this number.', 'alert')->width('375px');
                return redirect()->back();
            }
        } else {
            Alert::toast('No patient found.', 'alert')->width('375px');
            return redirect()->back();
        }

        $checkIfCurrentlyExistOnICU = ICUPatient::where('patient_id', $data['patientData']->id)->where('isDischarged' , 0)->first();
//        dd($checkIfCurrentlyExistOnICU, $data['patientData']->id);
        if ($checkIfCurrentlyExistOnICU)
        {
            Alert::toast('Patient already exist in ICU/HDU', 'alert')->width('375px');
            return redirect()->back();

        }
        // Get beds from both ICU (ward_id 10) and HDU (ward_id 5) wards
        $data['beds'] = Bed::whereIn('ward_id', [10, 5])->where('bed_status', 'empty')->get();
        $data['doctors'] = Doctor::where('type', '=', 'icu_doctor')->get();
//        dd($data['patientData']);
        return view('icu.add-patient-form', $data);
    }

    public function addPatient(Request $request)
    {
//        dd($request->all());
        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'patient_id' => 'required',
                'isICU' => 'required',
                'bed_no' => 'required',
                'assign_doctor' => 'required'
            ]);
            if ($validator->fails()) {
                Alert::toast('Fill in the required fields', 'error')->width('375px');
                return redirect()->back();
            } else {
                $createNewData = new ICUPatient();
                $createNewData->patient_id = $request->patient_id;
                $createNewData->isICU = $request->isICU;
                $createNewData->bed_id = $request->bed_no;
                $createNewData->doctor_id = $request->assign_doctor;
                $createNewData->save();

                // check if the patient is already in the bed
                $checkDuplicateBedBooking = Bed::where('patient_id', $request->patient_id)->first();
                if ($checkDuplicateBedBooking) {
                    Bed::findOrFail($checkDuplicateBedBooking->id)->update([
                        'bed_status' => "empty",
                        'patient_id' => null
                    ]);
                }
                Bed::findOrFail($request->bed_no)->update([
                    'bed_status' => "occupied",
                    'patient_id' => $request->patient_id
                ]);
                DB::commit();
                Alert::toast('New patient added successfully.', 'success')->width('375px');
                return redirect()->route('icu.add');
            }
        } catch (\Throwable $e) {
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }

    }

    public function hospitalInfo() {
        $data['hospitals'] = Hospital::all();
        return view('icu.hospital-info', $data);
    }
}
