<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\Ride;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AmbulanceTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $data['trips'] = Ride::orderBy('status')->with('ambulance', 'driver')->get();
        return view('ambulance.ride-share', $data);
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
            $getAmbulance = Ambulance::where('id', $request->car_number)->with('driver')->first();
            DB::beginTransaction();
            $ambulance = new Ride();
            $ambulance->ambulance_id = $request->car_number;
            $ambulance->driver_id = $getAmbulance->driver_id;
            $ambulance->ambulance_number = $getAmbulance->car_number;
            $ambulance->driver_name = $getAmbulance->driver->name;
            $ambulance->patient_phone = $request->phone;
            $ambulance->patient_name = $request->name;
            $ambulance->pickup_location = $request->pickup_location;
            $ambulance->destination = $request->destination;
            $ambulance->save();

            $ambulanceUpdate = Ambulance::find($request->car_number);
            $ambulanceUpdate->isOnRoute = true;
            $ambulanceUpdate->save();

            DB::commit();
            Alert::toast('Ambulance added successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
//            dd($e->getMessage());
            Alert::toast('Error adding ambulance', 'error')->width('375px');
            return redirect()->back();
        }
    }




    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $ambulance = Ride::find($id);
            $ambulance->destination = $request->destination;
            $ambulance->patient_name = $request->name;
            $ambulance->patient_phone = $request->phone;
            $ambulance->charge = $request->charge;
            $ambulance->patient_summary = $request->patient_summary;
            $ambulance->status = "completed";
            $ambulance->save();

            $ambulanceUpdate = Ambulance::find($ambulance->ambulance_id);
            $ambulanceUpdate->isOnRoute = false;
            $ambulanceUpdate->save();

            DB::commit();
            Alert::toast('Ambulance status updated successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
//            dd($e->getMessage());
            Alert::toast('Error updating ambulance status', 'error')->width('375px');
            return redirect()->back();
        }
    }


}
