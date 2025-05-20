<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\EmergencyPatient;
use App\Models\EmergencyPrescription;
use App\Models\Medicine;
use App\Models\Operation;
use App\Models\PatientAdmitRequest;
use App\Models\Service;
use App\Models\TestList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EmergencyController extends Controller
{
    public function emergencyList()
    {
        $data['patients'] = EmergencyPatient::where('is_active', 1)->with('patient', 'doctor')->get();
        return view('Emergency.emergency-patient-list', $data);
    }

    public function emergencyView($id)
    {

        $data['patientData'] = EmergencyPatient::where('id', $id)->with('patient', 'doctor')->first();
        if (!$data['patientData']) {
            Alert::toast('Patient not found', 'error')->width('375px');
            return redirect()->route('emergency.list');
        }
        //        dd($data['patientData']);
        $data['operations'] = Service::where('department_id', '=', '2')->get();
        $data['doctors'] = Doctor::where('type', 'ot_doctor')->orderBy('name')->get();
        $data['testLists'] = TestList::all();
        $data['medicineLists'] = Medicine::all();
//        dd($data['patientData']);
        return view('Emergency.emergency-patient-view', $data);
    }

    public function emergencyStore(Request $request, $id)
    {
        //        dd($request->all());
        try {
            DB::beginTransaction();
            $data = $request->only(['cc', 'ho', 'rf', 'inv', 'adv', 'dx', 'advice']);
            $oeData = $request->only(['anemia', 'jaundice', 'edema', 'knock', 'bp', 'temp', 'heart', 'lung', 'liver', 'spleen']);
            $invData = $request->only(['hb', 'hbsAg', 'tc', 'dc', 'esr', 'urineRE', 'bloodSugar', 'bloodUrea', 'serumCreatinine', 'rbs']);
            $itemData = $request->items;
            $data['oe'] = $oeData;
            $data['inv'] = $invData;
            $data['items'] = $itemData;
            $data['tests'] = $request->tests;
            if ($request->need_admit == "1") {
                $data['adv'] = $data['adv'] . "<div><strong>• This patient needs to be admitted</strong></div>";
            }
            if ($request->need_ot == "1") {
                $data['adv'] = $data['adv'] . "<div><strong>• This patient needs to be operated</strong></div>";
            }
            if ($request->tests) {
                foreach ($request->tests as $test) {
                    $data['adv'] = $data['adv'] . "<div><strong>• Required Tests:</strong></div><ul>" . "<li>" . htmlspecialchars($test, ENT_QUOTES, 'UTF-8') . "</li></ul>";
                }
            }
            $prescriptionDetails = json_encode($data);
            // dd($prescriptionDetails);

            $prescription = new EmergencyPrescription();
            $prescription->emergency_patient_id = $request->patient_id;
            $prescription->prescription = $prescriptionDetails;
            $prescription->save();

            $patient = EmergencyPatient::find($id);
            $patient->is_active = 0;
            $patient->save();

            if ($request->need_admit) {
                $admitRequest = new PatientAdmitRequest();
                $admitRequest->patient_id = $request->patient_id;
                $admitRequest->doctor_id = auth()->user()->doctor->id;
                $admitRequest->remarks = $request->admit_remark;
                $admitRequest->save();
            }

            if ($request->need_ot) {
                $newOt = new Operation();
                $newOt->patient_id = $request->patient_id;
                $newOt->doctor_id = $request->doctor_id;
                $newOt->service_id = $request->service_id;
                $newOt->operation_date = $request->ot_date;
                $newOt->operation_time = $request->ot_time;
                $newOt->isRequested = 1;
                $newOt->requestedBy = auth()->user()->doctor->id;
                $newOt->save();
            }

            DB::commit();
            Alert::toast('Patient status updated successfully', 'success')->width('375px');
            //            TODO: need to change the parameter value according to the user who is logged in
            return redirect()->route('emergency.list', ['id' => $patient->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            //            return $e->getMessage();
            Alert::toast('Something went wrong', 'error')->width('375px');
            //            TODO: need to change the parameter value according to the user who is logged in
            return redirect()->back();
        }
    }


    public function emergencyPrescription(Request $request, $id)
    {
        dd($request->all());
    }
}
