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

    public function getNextBedNumber($wardId)
    {
        try {
            $ward = Ward::findOrFail($wardId);
            
            // Get all existing bed numbers for this ward
            $existingBedNumbers = Bed::where('ward_id', $wardId)
                                   ->pluck('bed_number')
                                   ->toArray();
            
            // Find the first available bed number (starting from 1)
            $nextBedNumber = 1;
            while (in_array($nextBedNumber, $existingBedNumbers)) {
                $nextBedNumber++;
            }
            
            // Check if we've reached the ward's total bed capacity
            if ($nextBedNumber > $ward->total_beds) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ward has reached maximum bed capacity (' . $ward->total_beds . ' beds)',
                    'next_bed_number' => null,
                    'existing_beds' => $existingBedNumbers
                ]);
            }
            
            return response()->json([
                'success' => true,
                'next_bed_number' => $nextBedNumber,
                'ward_name' => $ward->name,
                'total_beds' => $ward->total_beds,
                'current_beds' => count($existingBedNumbers),
                'existing_beds' => $existingBedNumbers
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving bed information',
                'next_bed_number' => null
            ]);
        }
    }

    public function addBed(Request $request)
    {
        $request->validate([
            'ward_id' => 'required',
            'bed_number' => 'required|integer|min:1',
            'bed_type' => 'required',
            'bed_status' => 'required|in:empty,occupied',
        ]);

        try {
            // Check if bed number already exists in this ward
            $existingBed = Bed::where('ward_id', $request->ward_id)
                             ->where('bed_number', $request->bed_number)
                             ->first();
            
            if ($existingBed) {
                Alert::toast('Bed number ' . $request->bed_number . ' already exists in this ward.', 'error')->width('375px');
                return redirect()->back();
            }
            
            // Check ward capacity
            $ward = Ward::findOrFail($request->ward_id);
            $currentBedCount = Bed::where('ward_id', $request->ward_id)->count();
            
            if ($currentBedCount >= $ward->total_beds) {
                Alert::toast('Ward has reached maximum capacity (' . $ward->total_beds . ' beds).', 'error')->width('375px');
                return redirect()->back();
            }
            
            if ($request->bed_number > $ward->total_beds) {
                Alert::toast('Bed number cannot exceed ward capacity (' . $ward->total_beds . ' beds).', 'error')->width('375px');
                return redirect()->back();
            }

            Bed::create([
                'ward_id' => $request->ward_id,
                'bed_number' => $request->bed_number,
                'bed_type' => $request->bed_type,
                'bed_status' => $request->bed_status,
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
            
            // Check if bed is currently occupied
            if ($getBed->bed_status === 'occupied' && $getBed->patient_id !== null) {
                Alert::toast('Cannot delete bed. Bed is currently occupied by a patient.', 'error')->width('375px');
                return redirect()->back();
            }
            
            // Check if bed is referenced by any ICU patients (current or discharged)
            $icuPatients = \App\Models\ICUPatient::where('bed_id', $id)->count();
            if ($icuPatients > 0) {
                Alert::toast('Cannot delete bed. This bed has patient history records. Please contact administrator.', 'error')->width('375px');
                return redirect()->back();
            }
            
            // Check if bed is referenced by any POW patients
            $powPatients = \App\Models\POWPatient::where('bed_id', $id)->count();
            if ($powPatients > 0) {
                Alert::toast('Cannot delete bed. This bed has patient history records. Please contact administrator.', 'error')->width('375px');
                return redirect()->back();
            }
            
            $getBed->delete();
            Alert::toast('Bed Deleted Successfully.', 'success')->width('375px');
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle foreign key constraint violations
            if ($e->getCode() == 23000) {
                Alert::toast('Cannot delete bed. This bed is referenced by patient records.', 'error')->width('375px');
            } else {
                Alert::toast('Database error occurred. Please try again.', 'error')->width('375px');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Something went wrong. Please try again.', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
