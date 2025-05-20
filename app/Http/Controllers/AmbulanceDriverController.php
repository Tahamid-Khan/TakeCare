<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AmbulanceDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * //     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['drivers'] = Driver::all();
        return view('ambulance.ambulance-driver', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request->all());
        try {
            $addDriver = new Driver();
            $addDriver->name = $request->name;
            $addDriver->phone = $request->phone;
            $addDriver->nid = $request->nid;
            $addDriver->status = $request->status;
            $addDriver->address = $request->address;
            $addDriver->remarks = $request->remark;
            $addDriver->save();
            Alert::toast('Driver Added Successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
//            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $driver = Driver::findOrFail($id);
            $driver->name = $request->name;
            $driver->phone = $request->phone;
            $driver->nid = $request->nid;
            $driver->status = $request->status;
            $driver->address = $request->address;
            $driver->remarks = $request->remark;
            $driver->save();
            Alert::toast('Driver Updated Successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        try {
            $driver = Driver::findOrFail($id);
            $driver->delete();
            Alert::toast('Driver Deleted Successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
