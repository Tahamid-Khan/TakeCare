<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\Driver;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use RealRashid\SweetAlert\Facades\Alert;

class AmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index()
    {
        $data['ambulances'] = Ambulance::with('driver')->get();
        $data['drivers'] = Driver::all();
        return view('ambulance.ambulance', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
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
        try {
            $ambulance = new Ambulance();
            $ambulance->car_number = $request->car_number;
            $ambulance->driver_id = $request->driver_id;
            $ambulance->contact_number = $request->phone;
            $ambulance->type = $request->type;
            $ambulance->category = $request->category;
            $ambulance->status = $request->status;
            $ambulance->save();
            Alert::toast('Ambulance added successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error adding ambulance', 'error')->width('375px');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        dd('edit');
    }

    public function update(Request $request, $id)
    {
        try {
            $ambulance = Ambulance::findOrFail($id);
            $ambulance->car_number = $request->car_number;
            $ambulance->driver_id = $request->driver_id;
            $ambulance->contact_number = $request->contact_number;
            $ambulance->type = $request->type;
            $ambulance->category = $request->category;
            $ambulance->status = $request->status;
            $ambulance->save();
            Alert::toast('Ambulance updated successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error updating ambulance', 'error')->width('375px');
            return redirect()->back();
        }
    }

 
    public function destroy($id)
    {
        try {
            Ambulance::find($id)->delete();
            Alert::toast('Ambulance deleted successfully', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Error deleting ambulance', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
