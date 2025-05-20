<?php

namespace App\Http\Controllers;

use App\Models\Radiology;
use App\Models\RadiologyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RadiologyController extends Controller
{
    public function index()
    {
        $data['tests'] = Radiology::where('status', 'pending')->with('patient')->get();
        return view('radiology.dashboard', $data);
    }

    public function viewTest($id)
    {
        $data['test'] = Radiology::where('id', $id)->with('patient')->first();
        if (!$data['test']) {
            Alert::toast('Test not found', 'error')->width('375px');
            return redirect()->back();
        }
        return view('radiology.view-test-details', $data);
    }

    public function updateTestStatus(Request $request, $id)
    {
        try {
            $test = Radiology::findOrFail($id);
            $test->delivery_date = $request->delivery_date;
            $test->remarks = $request->remarks;
            $test->test_date = Carbon::now();
            $test->status = 'completed';
            $test->save();
            Alert::toast('Test status updated successfully', 'success')->width('375px');
            return redirect()->route('radiology.dashboard');
        } catch (\Exception $e) {
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function previousTest()
    {
        $data['tests'] = Radiology::all();
        return view('radiology.previous-test-list', $data);
    }

    public function testReport($id)
    {
        return view('radiology.test-report');
    }

    public function reportGenerate($id)
    {
        return view('radiology.generate-test', compact('id'));
    }

    public function reportGeneratePost($id, Request $request)
    {
        //        dd($request->all());
        try {
            DB::beginTransaction();
            $test = Radiology::findOrFail($id);
            $test->status = 'generated';
            $test->save();

            $report = new RadiologyReport();
            $report->radiology_id = $test->id;
            $report->test_results = json_encode($request->item);
            $report->remarks = $request->comments;
            $report->save();
            DB::commit();
            Alert::toast('Test report generated successfully', 'success')->width('375px');
            return redirect()->route('radiology.dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
