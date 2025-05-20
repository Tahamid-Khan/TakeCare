<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Nurse;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index()
    {
        $data['departments'] = Department::all();
        $data['nurseTypes'] = [
            1 => "pow_nurse",
            2 => "opd_nurse",
            3 => "icu_nurse",
            4 => "ot_nurse",
            5 => "emergency_nurse",
            6 => "pathology_test_nurse",
            7 => "radiology_test_nurse",
        ];
        $data['wards'] = Ward::all();
        $data['users'] = User::where('is_assigned', 0)->get();
        $data['assignedUsers'] = User::where('is_assigned', 1)->get();
        $data['nurses'] = Nurse::all();
        return view('human_resource.nurse', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //        dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'department_id' => 'required',
            'type' => 'required',
            'ward_id' => 'required',
            'user_id' => 'required',
        ]);
        try {
            DB::beginTransaction();

            $newNurse = new Nurse();
            $newNurse->name = $request->name;
            $newNurse->department_id = $request->department_id;
            $newNurse->type = $request->type;
            $newNurse->position = $request->position;
            $newNurse->qualification = $request->qualification;
            $newNurse->contact_number = $request->phone;
            $newNurse->address = $request->address;
            $newNurse->ward_id = $request->ward_id;
            $newNurse->user_id = $request->user_id;
            $newNurse->save();

            $user = User::findOrFail($request->user_id);
            $user->is_assigned = 1;
            $user->save();

            DB::commit();
            Alert::toast('Nurse added successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $updateNurse = Nurse::findOrFail($id);
            $updateNurse->name = $request->name;
            $updateNurse->department_id = $request->department_id;
            $updateNurse->type = $request->type;
            $updateNurse->position = $request->position;
            $updateNurse->qualification = $request->qualification;
            $updateNurse->contact_number = $request->phone;
            $updateNurse->address = $request->address;
            $updateNurse->ward_id = $request->ward_id;
            $updateNurse->save();

            Alert::toast('Nurse updated successfully', 'success');
            return redirect()->back();

        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error');
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        try {
            $nurse = Nurse::findOrFail($id);
            $nurse->delete();
            Alert::toast('Nurse deleted successfully', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error');
            return redirect()->back();
        }
    }
}
