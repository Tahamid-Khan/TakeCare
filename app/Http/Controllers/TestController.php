<?php

namespace App\Http\Controllers;

use App\Models\TestList;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['testLists'] = TestList::orderBy('id', 'asc')->get();

        return view('pathology.list_test', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pathology.create_test');
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
        $insertData= TestList::insert($postData);

        if ($insertData)
        {
            Alert::toast('Test added successfully.','success')->width('375px');
        }

        return redirect('pathology/test/lists');

    }

    public function edit($id)
    {
        $data['testLists'] =  TestList::find($id);
        return view('pathology.edit_test', $data);
    }

    public function update(Request $request)
    {


        DB::beginTransaction();
        try {
            $postData = $request->except('_token','id');
            //update data
            TestList::where('id',$request->get('id'))->update($postData);
            DB::commit();
            Alert::toast('Test information successfully updated', 'success')->width('375px');
        }catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Test information not update successfully','error')->width('570px');
        }
        return redirect()->route('pathology.list_test');
    }

    public function delete($id)
    {
        $test = TestList::find($id);

        if ($test) {
            $test->delete();

            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }

    }
}

