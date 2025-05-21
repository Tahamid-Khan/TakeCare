<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\Bed;
use App\Models\CrudModel;
use App\Models\DeathCertificate;
use App\Models\Department;
use App\Models\EmergencyPatient;
use App\Models\Hospital;
use App\Models\ICUPatient;
use App\Models\Medicine;
use App\Models\OPDPatient;
use App\Models\Operation;
use App\Models\Pathology;
use App\Models\Patient;
use App\Models\PatientDiscount;
use App\Models\PatientRefer;
use App\Models\Radiology;
use App\Models\Service;
use App\Models\StoreMaterialRequest;
use App\Models\StoreProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $emp = CrudModel::find('users', ['id' => auth()->user()->id]);
        // if($emp->user_type == 'admin')
        // {
        $data['emp'] = $emp;
        return view('dashboard', $data);
        // }
        // elseif($emp->user_type == 'user'){
        //     Auth::logout();
        //     Session::flush();
        //     return back()->withErrors([
        //         'email' => 'Unauthorized User',
        //     ]);
        // }
    }

    public function cmoDashboard()
    {
        $data['patientsData'] = ICUPatient::with('patient', 'doctor', 'bed')->where('isDischarged', 0)->get();
        $data['patients'] = EmergencyPatient::where('is_active', 1)->with('patient', 'doctor')->get();
        $data['doctors'] = Operation::with('doctor')->selectRaw('doctor_id, COUNT(*) as total_operation ')->groupBy('doctor_id')->get();
        $data['tests'] = Pathology::where('status', 'pending')->with('patient', 'service')->get();
        $data['radioTests'] = Radiology::where('status', 'pending')->with('patient')->get();
        $data['availableAmbulances'] = Ambulance::with('driver')->where('isOnRoute', false)->where('status', 'active')->get();
        $data['onRouteAmbulances'] = Ambulance::with('driver')->where('isOnRoute', true)->where('status', 'active')->get();
        $data['naturalDeaths'] = DeathCertificate::where('isUnnatural', 0)->get();
        $data['unnaturalDeaths'] = DeathCertificate::where('isUnnatural', 1)->get();
        $data['requests'] = StoreMaterialRequest::with('product.inventory')->where('status', '=', 'pending')->get();
        $data['hospitals'] = Hospital::all();
        return view('cmo.cmo-dashboard', $data);
    }

    public function userDashboard()
    {
        $emp = CrudModel::find('users', ['id' => auth()->user()->id]);
        $data['emp'] = $emp;
        //dd($data['emp']);
        return view('user-dashboard', $data);
    }

    public function getPatients(Request $request)
    {
        try {
            $data = $request->all();
            //            dd($data['query']);
            $result = Patient::where('patient_id', 'like', '%' . $data['query'] . '%')
                ->orWhere('name', 'like', '%' . $data['query'] . '%')
                ->orWhere('mobile', 'like', '%' . $data['query'] . '%')
                ->get();

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getServices(Request $request)
    {
        try {
            $data = $request->all();
            //            dd($data['query']);
            $result = Service::where('name', 'like', '%' . $data['query'] . '%')
                ->get();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getPatientDetails($id)
    {
        try {
            $patient = Patient::where('id', $id)->first();

            $discountData = PatientDiscount::where('patient_type', $patient->reference)->first();
            $discount = $discountData ? $discountData->discount : 0;

            $result = $patient;
            $result['discount'] = $discount;

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


// public function getPatientDetails($id)
//     {
//         try {
//             $result = Patient::where('id', $id)->first();
//             return response()->json($result);
//         } catch (\Exception $e) {
//             return response()->json($e->getMessage());
//         }
//     }

    public function getServiceDetails($id)
    {
        try {
            $result = Service::where('id', $id)->first();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    // public function getBedsByWard(Request $request)
    // {
    //     $beds = Bed::where('ward_id', $request->ward_id)
    //         ->where('bed_status', 'empty')
    //         ->get();

    //     return response()->json($beds);
    // }
public function getBedsByWard(Request $request)
{
    try {
        $wardId = $request->ward_id;
        
        // Validate input
        if (!$wardId) {
            return response()->json(['error' => 'Ward ID is required'], 400);
        }
        
        // Get beds that are empty and belong to the selected ward
        $beds = Bed::where('ward_id', $wardId)
                   ->where('bed_status', 'occupied')
                   ->get();
                   
        // Return JSON response
        return response()->json($beds);
    } catch (\Exception $e) {
        // Log the error
        \Log::error('Error fetching beds: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to load beds'], 500);
    }
}


    public function getMedicine(Request $request)
    {
        try {
            $data = $request->all();
            //            dd($data['query']);
            $result = Medicine::where('brand_name', 'like', '%' . $data['query'] . '%')
                ->orWhere('generic_name', 'like', '%' . $data['query'] . '%')
                ->get();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getHospital(Request $request)
    {
        try {
            $data = $request->all();
            $result = Hospital::where('name', 'like', '%' . $data['query'] . '%')
                ->orWhere('address', 'like', '%' . $data['query'] . '%')
                ->get();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getProduct(Request $request)
    {
        try {
            $data = $request->all();
            $result = StoreProduct::where('name', 'like', '%' . $data['query'] . '%')
                ->with('department')
                ->get();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function referPatient(Request $request)
    {
//        dd($request->all());
        try {
            $patientRefer = new PatientRefer();
            $patientRefer->patient_id = $request->patient_id;
            $patientRefer->referred_by = auth()->user()->doctor->id;
            $patientRefer->hospital_id = $request->hospital_id;
            $patientRefer->remark = $request->remark;
            $patientRefer->save();
            Alert::toast('Patient referred successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
//            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error');
            return redirect()->back();
        }
    }

    public function printSticker($test_id)
    {
        $data['test_id'] = $test_id;
        $pdfFileName = 'Sticker-' . Carbon::now()->format('YmdHis') . '.pdf';
        $pdf = PDF::loadView('components.print-sticker', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream($pdfFileName);
    }

    public function telephoneNumbers()
    {
        $data['lists'] = Department::select(['id','name','phone_number'])->orderBy('id', 'asc')->get();
        return view('department-telephone.department-telephone', $data);
    }
}
