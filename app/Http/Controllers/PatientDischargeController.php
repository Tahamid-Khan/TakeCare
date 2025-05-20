<?php

namespace App\Http\Controllers;

use Alert as AlertAlias;
use App\Models\PatientDischarge;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PatientDischargeController extends Controller
{
    public function dischargeRequest($id)
    {
        try {
            $newRequest = new PatientDischarge();
            $newRequest->patient_id = $id;
            $newRequest->doctor_id = auth()->user()->doctor->id;
            $newRequest->save();
            Alert::toast('Discharge request sent successfully', 'success')->width('375px');
            return redirect()->back();
        }
        catch (\Exception $e) {
//            return response()->json(['error' => $e->getMessage()]);
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
