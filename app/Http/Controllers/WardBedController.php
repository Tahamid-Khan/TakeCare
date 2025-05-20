<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use App\Models\Bed;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class WardBedController extends Controller
{
    public function showAllWard()
    {
        $data['wards'] = Ward::all();
        return view('wards.wards', $data);
    }

    public function addWard(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'bed_number' => 'required',
            'type' => 'required',
        ]);

        try {
            Ward::create([
                'name' => $request->name,
                'location' => $request->location,
                'total_beds' => $request->bed_number,
                'type' => $request->type,
            ]);
            Alert::toast('Ward Added Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
//            dd($e->getMessage());
            Alert::toast('Something went wrong. Please try again.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function editWard(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'bed_number' => 'required',
            'type' => 'required',
        ]);

        try {
            $getWard = Ward::findOrFail($request->ward_id);
            $getWard->name = $request->name;
            $getWard->location = $request->location;
            $getWard->total_beds = $request->bed_number;
            $getWard->type = $request->type;
            $getWard->save();
            Alert::toast('Ward Updated Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Something went wrong. Please try again.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function deleteWard($id)
    {
        try {
            $getWard = Ward::findOrFail($id);
            $getWard->delete();
            Alert::toast('Current Status Added Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Something went wrong. Please try again.', 'error')->width('375px');
            return redirect()->back();
        }
    }


    public function showAllBed()
    {
        $data['beds'] = Bed::with('Ward')->get();
        $data['wards'] = Ward::all();
        return view('wards.bed', $data);
    }

    public function addBed(Request $request)
    {
        $request->validate([
            'ward_id' => 'required',
            'bed_number' => 'required',
            'bed_type' => 'required',
        ]);

        try {
            Bed::create([
                'ward_id' => $request->ward_id,
                'bed_number' => $request->bed_number,
                'bed_type' => $request->bed_type,
                'bed_status' => 'empty',
            ]);
            Alert::toast('Bed Added Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Something went wrong. Please try again.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function editBed(Request $request)
    {
        $request->validate([
            'ward_id' => 'required',
            'bed_number' => 'required',
            'bed_type' => 'required',
            'bed_status' => 'required',
        ]);

        try {
            $getBed = Bed::findOrFail($request->bed_id);
            $getBed->ward_id = $request->ward_id;
            $getBed->bed_number = $request->bed_number;
            $getBed->bed_type = $request->bed_type;
            $getBed->bed_status = $request->bed_status;
            if ($request->bed_status == 'empty') {
                $getBed->patient_id = null;
            }
            $getBed->save();
            Alert::toast('Bed Updated Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Something went wrong. Please try again.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function deleteBed($id)
    {
        try {
            $getBed = Bed::findOrFail($id);
            $getBed->delete();
            Alert::toast('Current Status Added Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Something went wrong. Please try again.', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
