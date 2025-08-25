<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\OPDPatientSerial;
use App\Models\OPDPrescription;
use App\Models\Operation;
use App\Models\Patient;
use App\Models\PatientAdmitRequest;
use App\Models\Service;
use App\Models\TestList;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OPDController extends Controller
{
    public function list($id)
    {
        $today = date('Y-m-d');
        $query = OPDPatientSerial::where('doctor_id', $id)
            ->where('status', 'pending')
            ->where('date', '>=', $today)
            ->orderBy('date', 'asc')
            ->orderBy('id', 'desc')
            ->with('patient');
        $data['patientLists'] = $query->get();
        $data['totalPatient'] = $query->count();
        return view('opd.patient-list', $data);
    }

    public function view($id)
    {

        $data['patientData'] = OPDPatientSerial::with(['patient'])->find($id);

//        according to seeder, department_id = 2 is for OT
        $data['operations'] = Service::where('department_id', '=', '2')->get();

        $data['doctors'] = Doctor::where('type', 'ot_doctor')->orderBy('name')->get();
//        if prescription already exist then return back
        $checkPrescription = OPDPrescription::where('opd_patient_serial_id', $id)->first();
        if ($checkPrescription) {
            Alert::toast('Prescription already exist', 'error')->width('375px');
            $doctorId = auth()->user()->doctor->id;
            return redirect()->route('opd.list', $doctorId);
        }

        $data['previousSerials'] = OPDPatientSerial::where('patient_id', $data['patientData']->patient_id)->with('doctor')->where('status', 'completed')->get();
        $data['testLists'] = TestList::all();
        $data['medicineLists'] = Medicine::all();
        return view('opd.patient-view', $data);
    }

    public function store(Request $request, $id)
    {
    //    dd($request->all(), $id);
        try {
            DB::beginTransaction();
            // $data = $request->only(['cc', 'ho', 'rf', 'oe', 'inv', 'adv', 'dx']);
            $data = $request->only(['cc', 'ho', 'rf', 'inv', 'adv', 'dx', 'advice']);
            $oeData = $request->only(['anemia', 'jaundice', 'edema', 'knock', 'bp', 'temp', 'heart', 'lung', 'liver', 'spleen']);
            $invData = $request->only(['hb', 'hbsAg', 'tc', 'dc', 'esr', 'urineRE', 'bloodSugar', 'bloodUrea', 'serumCreatinine', 'rbs']);
            $itemData = $request->items;
            $data['oe'] = $oeData;
            $data['inv'] = $invData;
            $data['items'] = $itemData;
            $data['tests'] = $request->tests;
            if ($request->need_admit == "1") {
                $data['adv'] = $data['adv']."<div><strong>• This patient needs to be admitted</strong></div>";
            }
            if ($request->need_ot == "1") {
                $data['adv'] = $data['adv']."<div><strong>• This patient needs to be operated</strong></div>";
            }
            if ($request->tests) {
                foreach ($request->tests as $test) {
                    $data['adv'] = $data['adv']."<div><strong>• Required Tests:</strong></div><ul>". "<li>" . htmlspecialchars($test, ENT_QUOTES, 'UTF-8') . "</li></ul>";
                }
            }
            $prescriptionDetails = json_encode($data);
            // dd($prescriptionDetails);

            $prescription = new OPDPrescription();
            $prescription->patient_id = $request->patient_id;
            $prescription->opd_patient_serial_id = $id;
            $prescription->prescription = $prescriptionDetails;
            $prescription->save();

            if ($request->need_admit){
            $admitRequest = new PatientAdmitRequest();
            $admitRequest->patient_id = $request->patient_id;
            $admitRequest->doctor_id = auth()->user()->doctor->id;
            $admitRequest->remarks = $request->admit_remark;
            $admitRequest->save();
            }

            if($request->need_ot){
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

//            dd($newOt, $admitRequest);
            $opdSerial = OPDPatientSerial::find($id);
            $opdSerial->status = 'completed';
            $opdSerial->save();

            DB::commit();
            Alert::toast('Patient status updated successfully', 'success')->width('375px');
            $doctorId = auth()->user()->doctor->id;
            return redirect()->route('opd.list', $doctorId);
        } catch (Exception $e) {
            DB::rollBack();
//             return $e->getMessage();
            Alert::toast('Something went wrong', 'error')->width('375px');
            $doctorId = auth()->user()->doctor->id;
            return redirect()->route('opd.list', $doctorId);
        }
    }

    public function update(Request $request, $id)
    {
//        dd($request->all(), $id);
        $validator = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'mobile' => 'required',
        ]);
        if ($validator) {
            try {
                $patient = Patient::find($id);
//                dd($patient);
                $patient->name = $request->name;
                $patient->gender = $request->gender;
                $patient->age = $request->age;
                $patient->address = $request->address;
                $patient->mobile = $request->mobile;
                $patient->save();
                Alert::toast('Patient information updated successfully', 'success')->width('375px');
                return redirect()->back();
            } catch (Exception $e) {
                return $e->getMessage();
                Alert::toast('Something went wrong', 'error')->width('375px');
                return redirect()->back();

            }
        } else {
            Alert::toast('Fill in all the required form', 'error')->width('375px');
            return redirect()->back();
        }


    }

    public function opdPatient($id)
    {
        $data['patientData'] = Patient::find($id);
        $data['departments'] = Department::all();
        $data['doctors'] = Doctor::where('type', 'opd_doctor')->orderBy('name')->get();
        $data['previousSerial'] = OPDPatientSerial::where('patient_id', $id)->orderBy('id', 'desc')->with('doctor')->get();
        return view('opd.patient-previous-info', $data);
    }

    public function opdPatientNewSerial(Request $request, $id)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $patientSerial = new OPDPatientSerial();
            $patientSerial->patient_id = $id;
            $patientSerial->doctor_id = $request->doctor_id;
            $patientSerial->date = $request->date;
            $patientSerial->amount = $request->amount;
            $patientSerial->save();
            DB::commit();
            Alert::toast('New serial added successfully', 'success')->width('375px');
            return redirect()->route('reception.opd-registration');
        } catch (Exception $e) {
            DB::rollBack();
//             return $e->getMessage();
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->route('opd.patient-previous-info', $id);
        }
    }

    public function prescription($id)
    {
        $data['patientData'] = OPDPatientSerial::with(['patient'])->with('doctor')->with('opdPrescription')->find($id);
        // dd($data['patientData']);

        $pdfFileName = 'Prescription-' . Carbon::now()->format('YmdHis') . '.pdf';
        $pdf = PDF::loadView('components.prescription', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream($pdfFileName);

        // return view('components.prescription', $data);
    }
}
