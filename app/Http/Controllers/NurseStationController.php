<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Doctor;
use App\Models\MedicineServeLog;
use App\Models\Patient;
use App\Models\PatientDischarge;
use App\Models\Ward;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use function PHPUnit\Framework\isEmpty;

class NurseStationController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->user_type == 'nurse') {
            // Check if nurse record exists
            $nurse = auth()->user()->nurse;
            if (!$nurse) {
                \Log::error('Nurse record not found for user: ' . auth()->user()->id);
                Alert::toast('Nurse profile not found. Please contact administrator.', 'error')->width('375px');
                return view('nurse_station.dashboard', [
                    'patients' => collect(), 
                    'ward' => null,
                    'totalPowPatients' => 0,
                    'pendingDischarge' => 0
                ]);
            }

            $wardNo = $nurse->ward_id;
            if (!$wardNo) {
                \Log::error('Ward not assigned to nurse: ' . auth()->user()->id);
                Alert::toast('Ward not assigned to your profile. Please contact administrator.', 'error')->width('375px');
                return view('nurse_station.dashboard', [
                    'patients' => collect(), 
                    'ward' => null,
                    'totalPowPatients' => 0,
                    'pendingDischarge' => 0
                ]);
            }

            \Log::info('Nurse dashboard - Ward ID: ' . $wardNo . ', User ID: ' . auth()->user()->id);

            $data['patients'] = Bed::where('bed_status', '=', 'occupied')
                ->where('ward_id', $wardNo)
                ->whereNotNull('patient_id')
                ->with([
                    'patient' => function ($query) {
                        $query->with([
                            'doctor',
                            'patientDischarge' => function ($subQuery) {
                                $subQuery->where('status', 'pending')
                                    ->orWhere('status', 'generated');
                            }
                        ]);
                    },
                    'Ward'
                ])
                ->get();

            \Log::info('Found ' . $data['patients']->count() . ' occupied beds in ward ' . $wardNo);

            $data['ward'] = Ward::findOrFail($wardNo);
            
            // Calculate statistics for nurse's ward only
            $data['totalPowPatients'] = $data['patients']->count();
            $data['pendingDischarge'] = $data['patients']->filter(function($bed) {
                return $bed->patient && $bed->patient->patientDischarge->isNotEmpty();
            })->count();
            
        } else {
            // For admin users, show all occupied beds
            $data['patients'] = Bed::where('bed_status', '=', 'occupied')
                ->whereNotNull('patient_id')
                ->with([
                    'patient' => function ($query) {
                        $query->with([
                            'doctor',
                            'patientDischarge' => function ($subQuery) {
                                $subQuery->where('status', 'pending')
                                    ->orWhere('status', 'generated');
                            }
                        ]);
                    },
                    'Ward'
                ])
                ->get();

            \Log::info('Admin view - Found ' . $data['patients']->count() . ' total occupied beds');
            $data['ward'] = null;
            
            // Calculate statistics for all wards
            $data['totalPowPatients'] = $data['patients']->count();
            $data['pendingDischarge'] = $data['patients']->filter(function($bed) {
                return $bed->patient && $bed->patient->patientDischarge->isNotEmpty();
            })->count();
        }

        return view('nurse_station.dashboard', $data);
    }

    public function patientList($id)
    {
        $data['doctor'] = Doctor::with('patientDoctorAssignment.patient')->find($id);

        $data['patients'] = $data['doctor']->patientDoctorAssignment->map(function ($assignment) {
            return $assignment->patient;
        });
        //         dd($data['doctor']);
        return view('nurse_station.patient-list', $data);
    }

    public function patientDetails($id)
    {
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
        ])->find($id);
        $data['schedules'] = MedicineServeLog::whereDate('date', Carbon::now()->format('Y-m-d'))
            ->where('patient_id', $id)
            ->pluck('schedule')
            ->toArray();
        $data['getDischargeInfo'] = PatientDischarge::where('patient_id', $id)
            ->where('status', 'pending')
            ->first();

        //         dd($data['patient']);
        return view('nurse_station.patient-details', $data);
    }

    public function medicineStatusUpdate(Request $request)
    {
        //        dd($request->all());
        try {
            $medicineServeLog = new MedicineServeLog();
            $medicineServeLog->patient_id = $request->patient_id;
            $medicineServeLog->date = Carbon::now();
            $medicineServeLog->status = "served";
            $medicineServeLog->schedule = $request->schedule;
            $medicineServeLog->save();
            Alert::toast('Medicine status updated successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error');
            return redirect()->back();
        }
    }

    public function dischargeLetter($id)
    {
        $getDischargeInfo = PatientDischarge::where('patient_id', $id)->first();
        if ($getDischargeInfo->status !== 'pending') {
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
        ])->findOrFail($patientID);

        return view('nurse_station.discharge-letter', $data);
    }

    public function dischargeLetterStore(Request $request)
    {
        //        dd($request->all());
        try {
            $data = $request->only(['reason_for_admission', 'medical_summary', 'investigation', 'risk_factor', 'case_summary', 'discharge_instructions', 'recommendation', 'follow_up', 'next_follow_up']);
            $updateDischargeInfo = PatientDischarge::findOrFail($request->id);
            $updateDischargeInfo->status = 'generated';
            $updateDischargeInfo->details = json_encode($data);
            $updateDischargeInfo->save();
            Alert::toast('Discharge letter generated successfully', 'success');
            return redirect()->route('nurse.dashboard');
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error');
            return redirect()->back();
        }

    }

    public function patientMedicineList(Request $request)
    {
        $id = $request->patient_id;
        $patient = Patient::with([
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
        ])->find($id);

        // dd($patient);

        $data['patient'] = $patient;

        // dd($data);

        $pdfFileName = 'patient-medicine-' . Carbon::now()->format('YmdHis') . '.pdf';
        $pdf = PDF::loadView('nurse_station.patient-medicine-list-pdf', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream($pdfFileName);
    }

    public function patientTestList(Request $request)
    {
        $id = $request->patient_id;
        $patient = Patient::with([
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
        ])->find($id);

        // dd($patient);

        $data['patient'] = $patient;

        // dd($data);

        $pdfFileName = 'patient-test-' . Carbon::now()->format('YmdHis') . '.pdf';
        $pdf = PDF::loadView('nurse_station.patient-test-list-pdf', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream($pdfFileName);
    }
}
