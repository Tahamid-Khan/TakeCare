<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Pathology;
use App\Models\PathologyReport;
use App\Models\PathologyRequest;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class NewPathologyController extends Controller
{
    public function index()
    {
        $data['tests'] = Pathology::where('status', 'pending')->with('patient', 'service')->get();
        return view('newPathology.dashboard', $data);
    }

    public function viewTest($id)
    {
        $data['test'] = Pathology::where('id', $id)->with('patient', 'service')->first();
        return view('newPathology.view-test-details', $data);
    }

    public function updateTestStatus(Request $request, $id)
    {
        try {
            $test = Pathology::findOrFail($id);
            $test->status = 'completed';
            $test->delivery_date = $request->delivery_date;
            $test->test_date = Carbon::now();
            $test->materials = json_encode($request->materials);
            $test->remarks = $request->remarks;
            $test->save();
            Alert::toast('Test completed successfully', 'success')->width('20rem');
            return redirect()->route('pathology.dashboard');
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('20rem');
            return redirect()->back();
        }
    }

    public function previousTest()
    {
        $data['tests'] = Pathology::where('status', '!=', 'pending')->with('patient', 'service')->get();
        return view('newPathology.previous-test-list', $data);
    }

    public function testReport($id)
    {
        return view('newPathology.test-report');
    }

    public function reportGenerate($id)
    {
        $data['test'] = Pathology::where('id', $id)->with('patient', 'service')->first();
        if (!$data['test']) {
            return redirect()->route('pathology.dashboard');
        }
        if ($data['test']->status != 'completed') {
            Alert::toast('Test is not completed yet', 'error')->width('20rem');
            return redirect()->route('pathology.dashboard');
        }
        return view('newPathology.generate-test', $data);
    }

    public function reportGeneratePost(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $test = Pathology::findOrFail($id);
            $test->status = 'generated';
            $test->save();

            $report = new PathologyReport();
            $report->pathology_id = $test->id;
            $report->test_results = json_encode($request->item);
            $report->remarks = $request->comments;
            $report->save();
            DB::commit();
            Alert::toast('Report generated successfully', 'success')->width('20rem');
            return redirect()->route('pathology.dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('20rem');
            return redirect()->back();
        }
    }

    public function addRequest(Request $request)
    {
        //        dd($request->all());
        try {
            DB::beginTransaction();
            foreach ($request->test as $test) {
                $pathology = new PathologyRequest();
                $pathology->patient_id = $request->patient_id;
                $pathology->service_id = $test;
                $pathology->referred_by = $request->duty_doctor_id;
                $pathology->save();
            }
            DB::commit();
            Alert::toast('Test request added successfully', 'success')->width('20rem');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
//            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('20rem');
            return redirect()->back();
        }
    }

    public function patientTestList(Request $request)
    {
        $data['testNames'] = Service::where('department_id', 6)->get();
        $data['doctors'] = Doctor::where('type', 'pathology_doctor')->get();

        $query = Pathology::where(function ($query) {
            $query->where('status', 'generated')
                ->orWhere('status', 'delivered');
        })->with('patient', 'service');

        if (!is_null($request->start_date) && !is_null($request->end_date)) {
            $query->whereBetween('test_date', [$request->start_date, $request->end_date]);
        } elseif (!is_null($request->start_date)) {
            $query->where('test_date', '=', $request->start_date);
        }

        if (!is_null($request->test)) {
            $query->where('service_id', $request->test);
        }

        $data['tests'] = $query->get();

        return view('newPathology.patient-test-list', $data);
    }

}
