<?php

namespace App\Http\Controllers;

use App\Models\DeathCertificate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DeathRegistrationController extends Controller
{
    public function dashboard()
    {
        $data['naturalDeaths'] = DeathCertificate::where('isUnnatural', 0)->get();
        $data['unnaturalDeaths'] = DeathCertificate::where('isUnnatural', 1)->get();
        return view('death-registration.dashboard', $data);
    }

    public function deathRegistration()
    {
        return view('death-registration.death-registration');
    }

    public function store(Request $request)
    {
//                dd($request->all());

        try {
            $data = $request->only('death_date', 'time_of_death', 'death_cause', 'death_details', 'unnatural_details', 'case_number', 'police_station', 'reporting_officer', 'officer_contact', 'name', 'nid', 'relationship', 'contact_number', 'doctor_name', 'hospital_name');
            $deathRegistration = new DeathCertificate();
            $deathRegistration->name = $request->patient_name;
            $deathRegistration->age = $request->age;
            $deathRegistration->fathers_name = $request->father_name;
            $deathRegistration->mothers_name = $request->mother_name;
            $deathRegistration->spouse_name = $request->spouse_name;
            $deathRegistration->dob = $request->dob;
            $deathRegistration->isUnnatural = $request->death_cause == 'natural' ? 0 : 1;
            $deathRegistration->gender = $request->gender;
            $deathRegistration->religion = $request->religion;
            $deathRegistration->nationality = $request->national;
            $deathRegistration->address = $request->address;
            $deathRegistration->details = json_encode($data);
            $deathRegistration->save();

            Alert::toast('Death Registration Successful', 'success')->width('375px');
            return redirect()->route('death-registration.dashboard');
        }
        catch (\Exception $exception) {
//            dd($exception->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function deathReportView($id)
    {
        $data['data'] = DeathCertificate::findOrFail($id);
        return view('death-registration.death-report-view', $data);
    }
}
