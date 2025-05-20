<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PathologyModel;
use App\Models\ReceptionModel;
use App\Models\TestList;
use App\Models\Tube;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class TestTubeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['lists'] = Tube::orderBy('id', 'asc')->with('patient','pathology')->get();

        return view('pathology.tube_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pathologys'] = PathologyModel::orderBy('id', 'asc')->get();
        $data['patients'] = ReceptionModel::orderBy('id', 'asc')->get();
        $data['testLists'] = TestList::orderBy('id', 'asc')->get();
       // dd($data);
        return view('pathology.create_test_tube', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postData = $request->except('_token');

        $testName = $request->input('test_list_name');
        $testId = TestList::where('name', $testName)->first();
        // $tubeId = mt_rand(100000, 999999);
        // $paddedTubeId = str_pad($tubeId, 6, '0', STR_PAD_LEFT);

        $postData['created_at'] = \Carbon\Carbon::now();
        $postData['test_list_id'] = $testId->id;
       // $postData['tube_id'] = 'T'.$paddedTubeId;

        $insertData= Tube::insert($postData);

        if ($insertData)
        {
            Alert::toast('Test TUbe added successfully.','success')->width('375px');
        }

        return redirect('test-tube');

    }
    public function delete($id)
    {
        $test = Tube::find($id);

        if ($test) {
            $test->delete();

            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }

    }

}
