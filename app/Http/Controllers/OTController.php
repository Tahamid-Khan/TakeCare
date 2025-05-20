<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\CavinWard;
use App\Models\Doctor;
use App\Models\Operation;
use App\Models\PathologyModel;
use App\Models\Patient;
use App\Models\PatientInvoice;
use App\Models\PatientMedicine;
use App\Models\PatientStatus;
use App\Models\PreviousHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class OTController extends Controller
{
    public function dashboard()
    {
        // $data['patients'] = Patient::where('status', 'ot')->get();
        $data['previousOTPatients'] = Operation::where('iscomplete', 1)->with('patient', 'doctor', 'service')->get();
        $data['upcomingOTPatients'] = Operation::where('iscomplete', 0)->with('service')->get();
        // dd($data);
        return view('ot_section.dashboard', $data);
    }

    public function view($id)
    {
        $data['operationData'] = Operation::where('id', $id)->first();
        $patientId = $data['operationData']->patient_id;
        $data['patientLists'] = Patient::findOrFail($patientId);
        $docId = $data['patientLists']->doctor_id;
        $data['doctor'] = Doctor::where('id', $docId)->first();
        $data['pathologyList'] = PathologyModel::where('patient_id', $patientId)->get();
        $data['dutyDoctors'] = Doctor::where('type', 'duty_doctor')->get();
        $data['doctors'] = Doctor::get();
        $data['patientActiveMedicines'] = PatientMedicine::where('patient_id', $patientId)->where('status', 'active')->orderBy('date', 'desc')->get();
        $data['patientStatus'] = PatientStatus::where('patient_id', $patientId)->latest()->first();
        $data['bed'] = Bed::where('patient_id', $patientId)->first();
        $patientInactiveMedicines = PatientMedicine::where('patient_id', $patientId)->where('status', 'inactive')->with('doctor')->orderBy('date', 'desc')->get();
        $groupedPatientInactiveMedicines = $patientInactiveMedicines->groupBy(function ($item) {
            return $item->doctor->name;
        });
        $data['patientInactiveMedicines'] = [];
        foreach ($groupedPatientInactiveMedicines as $doctorName => $medicines) {
            $data['patientInactiveMedicines'][$doctorName] = $medicines->toArray();
        }
        // dd($data['patientInactiveMedicines']);

        $patientPreviousHistory = PreviousHistory::where('patient_id', $patientId)->orderBy('date', 'desc')->get();
        $groupedPatientPreviousHistory = $patientPreviousHistory->groupBy(function ($item) {
            return $item->doctor_name;
        });
        $data['patientPreviousHistory'] = [];
        foreach ($groupedPatientPreviousHistory as $doctorName => $history) {
            $data['patientPreviousHistory'][$doctorName] = $history->toArray();
        }
        $data['previousOperation'] = Operation::where('patient_id', $patientId)->where('iscomplete', 1)->with('doctor', 'service')->get();
        $data['nextOperation'] = Operation::where('patient_id', $patientId)->where('iscomplete', 0)->with('doctor', 'service')->get();


        return view('ot_section.view', $data);
    }

    public function doctorList()
    {
        $data['doctors'] = Operation::with('doctor')->selectRaw('doctor_id, COUNT(*) as total_operation ')->groupBy('doctor_id')->get();
        return view('ot_section.doctor-list', $data);
    }

    public function otList($id)
    {
        $data['previousOTPatients'] = Operation::where('iscomplete', 1)->where('doctor_id', $id)->with('patient', 'doctor', 'service','invoice')->get();
        $data['upcomingOTPatients'] = Operation::where('iscomplete', 0)->where('doctor_id', $id)->with('service','invoice')->get();
        return view('ot_section.singleDocOperations', $data);
    }

    public function otListAll()
    {
        $data['previousOTPatients'] = Operation::where('iscomplete', 1)->with('patient', 'doctor', 'service')->get();
        $data['upcomingOTPatients'] = Operation::where('iscomplete', 0)->with('service')->get();
        return view('ot_section.singleDocOperations', $data);
    }

    public function add()
    {
        return view('ot_section.add-new-patient');
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

        $data['doctors'] = Doctor::where('type', '=', 'ot_doctor')->get();
//        dd($data['patientData']);
        return view('ot_section.add-patient-form', $data);
    }

    public function addPatient(Request $request)
    {
        //    dd($request->all());
        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'patient_id' => 'required',
                'operation_date' => 'required',
                'operation_time' => 'required',
                'operation_name' => 'required',
                'operation_type' => 'required',
                'doctor_id' => 'required'
            ]);
            if ($validator->fails()) {
                Alert::toast('Fill in the required fields', 'error')->width('375px');
                return redirect()->back();
            } else {
                $currentDate = Carbon::today()->toDateString();
//                dd($currentDate);
                $createNewData = new Operation();
                $createNewData->patient_id = $request->patient_id;
                $createNewData->doctor_id = $request->doctor_id;
                $createNewData->operation_date = $request->operation_date;
                $createNewData->operation_time = $request->operation_time;
                $createNewData->save();

                DB::commit();
                Alert::toast('New patient added successfully.', 'success')->width('375px');
                return redirect()->route('ot.dashboard');
            }
        } catch (Throwable $e) {
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }

    }

    public function startOT($id)
    {
//        dd($request->all(), $id);
        $operationData = Operation::where('id', $id)->first();
        $operationData->operation_start_time = Carbon::now();
        $operationData->save();
        return redirect()->route('ot.start-ot', ['id' => $id]);
    }

    public function endOT($id, Request $request)
    {
//        dd($request->all(), $id);

        $request->validate([
            'start_time' => 'required',
            'anesthesia_time' => 'required | after:start_time',

        ]);

        try {

//            dd($total);

            DB::beginTransaction();
            $operationData = Operation::where('id', $id)->first();
            $operationData->operation_start_time = $request->start_time;
            $operationData->anesthesia_given_time = $request->anesthesia_time;
            $operationData->operation_end_time = Carbon::now();
            $operationData->remarks = $request->remarks;
            $operationData->materials_used = json_encode($request->material_used);
            $operationData->iscomplete = 1;
            $operationData->save();

            $total = 0;
            foreach ($request->manual_services as $item) {
                $total += $item['amount'];
            }
            PatientInvoice::create([
                'patient_id' => $request->patient_id,
                'fund_department_id' => 2,
                'service_name' => "Operation Items",
                'total_price' => $total,
                'discount' => 0,
                'final_price' => $total,
                'due_amount' => $total,
                'payment_status' => 'unpaid'
            ]);
            DB::commit();
            Alert::toast('Operation Ended Successfully.', 'success')->width('375px');
            return redirect()->route('ot.view', ['id' => $id]);
        } catch (Throwable $e) {
            DB::rollBack();
            dd($e->getMessage());
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function startOTView($id)
    {
        $data['operationData'] = Operation::with('patient')->where('id', '=', $id)->first();
        if (!$data['operationData'] || !$data['operationData']->operation_start_time || $data['operationData']->iscomplete == 1) {

            return redirect()->route('ot.dashboard');
        }

        return view('ot_section.start-ot', $data);
    }

    public function charges()
    {
        return view('ot_section.charges');
    }

    public function addCharges(Request $request)
    {
        dd($request->all());
    }

    public function editCharges(Request $request)
    {
        dd($request->all());
    }

    public function deleteCharges(Request $request)
    {
        dd($request->all());
    }
}
