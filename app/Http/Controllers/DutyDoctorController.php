<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicineServeLog;
use App\Models\Operation;
use App\Models\PathologyModel;
use App\Models\Patient;
use App\Models\PatientDailySummary;
use App\Models\PatientDischarge;
use App\Models\PatientRefer;
use App\Models\PreviousHistory;
use App\Models\PatientMedicine;
use App\Models\PatientStatus;
use App\Models\Service;
use Carbon\Carbon;

// use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DutyDoctorController extends Controller
{
    public function index()
    {
        //        TODO: change the module as per updated models
        $data['patientLists'] = Patient::with(['doctor.department',
            'patientDischarge' => function ($query) {
                $query->where('status', 'generated')
                    ->orWhere('status', 'doctor_approved');
            },
        ])
            ->whereHas('doctor', function ($query) {
                $query->where('type', 'duty_doctor');
            })
            ->get();
        //        dd($data['patientLists']);

        return view('duty_doctor.doctor_dashboard', $data);
    }

    public function view($id)
    {
        $data['patientLists'] = Patient::findOrFail($id);

        $patientId = $data['patientLists']->id;
        $docId = $data['patientLists']->doctor_id;
        $data['doctor'] = Doctor::where('id', $docId)->first();
        $data['pathologyList'] = PathologyModel::where('patient_id', $patientId)->get();
        $data['dutyDoctors'] = Doctor::where('type', 'duty_doctor')->get();
        $data['doctors'] = Doctor::get();
        $data['patientActiveMedicines'] = PatientMedicine::where('patient_id', $patientId)->where('status', 'active')->orderBy('date', 'desc')->get();
        $data['patientStatus'] = PatientStatus::where('patient_id', $id)->latest()->first();

        $patientInactiveMedicines = PatientMedicine::where('patient_id', $patientId)->where('status', 'inactive')->with('doctor')->orderBy('date', 'desc')->get();
        $groupedPatientInactiveMedicines = $patientInactiveMedicines->groupBy(function ($item) {
            return $item->doctor->name; // Assuming 'name' is the doctor's name column
        });
        $data['patientInactiveMedicines'] = [];
        foreach ($groupedPatientInactiveMedicines as $doctorName => $medicines) {
            $data['patientInactiveMedicines'][$doctorName] = $medicines->toArray();
        }
        // dd($data['patientInactiveMedicines']);

        $patientPreviousHistory = PreviousHistory::where('patient_id', $patientId)->orderBy('date', 'desc')->get();
        $groupedPatientPreviousHistory = $patientPreviousHistory->groupBy(function ($item) {
            return $item->doctor_name; // Assuming 'name' is the doctor's name column
        });
        $data['patientPreviousHistory'] = [];
        foreach ($groupedPatientPreviousHistory as $doctorName => $history) {
            $data['patientPreviousHistory'][$doctorName] = $history->toArray();
        }
        // according to seeder, department_id = 2 is for OT
        $data['operations'] = Service::where('department_id', '=', '2')->get();

        $medicineLogs = Patient::find($id)->medicineServeLog()
            ->get()
            ->groupBy('date');

        $formattedLogs = [];

        foreach ($medicineLogs as $date => $logs) {
            $formattedLogs[$date] = [
                'morning' => $logs->contains('schedule', 'morning') ? 'Yes' : 'No',
                'afternoon' => $logs->contains('schedule', 'afternoon') ? 'Yes' : 'No',
                'evening' => $logs->contains('schedule', 'evening') ? 'Yes' : 'No',
            ];
        }

        $formattedLogs = collect($formattedLogs)->sortKeysDesc()->toArray();
        $data['medicineServeLogs'] = $formattedLogs;
        $data['today'] = Carbon::now()->format('Y-m-d');
        $data['alreadyReferred'] = PatientRefer::where('patient_id', $id)->where('status', 0)->first();
        $data['alreadyDischargeRequested'] = Patient::where('id', $id)->with('patientDischargeNew')->first();
        $data['tests'] = Service::where('department_id', 6)->get();
        return view('duty_doctor.view', $data);
    }

    public function addPreviousHistory(Request $request, $id)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            PreviousHistory::create([
                'patient_id' => $id,
                'doctor_name' => $request->doctor_name,
                'condition' => $request->condition,
                'treatment' => $request->treatment,
                'date' => $request->date,

            ]);
            DB::commit();
            Alert::toast('Previous History Added Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            //            dd($e);
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function addCurrentStatus(Request $request, $id)
    {
        // dd($request->all());
        try {

            DB::beginTransaction();
            if (isset($request->medicine)) {
                foreach ($request->medicine as $key => $value) {
                    if ($value == null) {
                        continue;
                    }

                    PatientMedicine::create([
                        'patient_id' => $id,
                        'doctor_id' => 1,
                        'medicine_name' => $value,
                        'schedule' => json_encode($request->schedule[$key]),
                        'taking_time' => $request->taking_time[$key],
                        'dose' => $request->dose[$key],
                        'duration' => $request->duration[$key],
                        'date' => Carbon::now(),
                        'status' => 'active',
                    ]);
                }
            }

            if ($request->summary != null) {
                PatientDailySummary::create([
                    'patient_id' => $id,
                    'doctor_id' => 1,
                    'summary' => $request->summary,
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

            DB::commit();
            Alert::toast('Current Status Added Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            // dd($e);
            return response()->json(['error' => $e->getMessage()]);
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function updateMedicineStatus(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            foreach ($request->status as $value) {
                $medicine = PatientMedicine::find($value);
                $medicine->status = "inactive";
                $medicine->save();
            }
            DB::commit();
            Alert::toast('Medicine Status Updated Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            // dd($e);
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    // public function deleteMedicine(Request $request)
    // {
    //     // dd($request->all());
    //     Alert::toast('Medicine Deleted Successfully.', 'success')->width('375px');
    //     return response()->json(['success' => 'Deleted', 'id' => $request->id]);
    // }

    public function dischargeRequest(Request $request)
    {
        //        dd($request->all());
        try {
            $approveDischarge = PatientDischarge::findOrFail($request->id);
            $approveDischarge->status = 'doctor_approved';
            $approveDischarge->save();
            Alert::toast('Discharge Requested Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (Exception $e) {
            //             dd($e->getMessage());
            Alert::toast('Something Went Wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function viewDischarge($id)
    {
        $getDischargeInfo = PatientDischarge::findOrFail($id);
        if (!($getDischargeInfo->status == 'generated' || $getDischargeInfo->status == 'doctor_approved')) {

            return redirect()->route('nurse.dashboard');
        }
        $patientID = $getDischargeInfo->patient_id;
        $data['dischargeInfo'] = $getDischargeInfo;

        $data['patient'] = Patient::with([
            'patientMedicine' => function ($query) {
                $query->where('status', 'active');
            },
            'patientStatus' => function ($query) {
                $query->latest()->first();
            },
            'patientDailySummary' => function ($query) {
                $query->latest()->first();
            },
            'patientDoctorAssignment.doctor',
            'previousHistory'
        ])->find($patientID);
        $data['dischargeDetails'] = json_decode($getDischargeInfo->details);
        return view('duty_doctor.view-discharge-letter', $data);
    }

    public function regOT($id, Request $request)
    {
        //        dd($request->all());

        try {
            $newOt = new Operation();
            $newOt->patient_id = $request->patient_id;
            $newOt->doctor_id = $request->duty_doctor_id;
            $newOt->service_id = $request->service_id;
            $newOt->operation_date = $request->ot_date;
            $newOt->operation_time = $request->ot_time;
            $newOt->isRequested = 1;
            $newOt->requestedBy = auth()->user()->doctor->id;
            $newOt->save();
            Alert::toast('Operation Requested Successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (Exception $e) {
            //            return $e->getMessage();
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
