<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['lists'] = Department::orderBy('id', 'asc')->get();

        return view('human_resource.department.list', $data);
    }

    public function departmentEmployee ()
    {
        $data['lists'] = Department::orderBy('id', 'asc')->get();

        return view('human_resource.employee.department-wise-employee', $data);
    }

    public function departmentEmployeeList ($id)
    {
        $data['lists'] = Employee::where('department_id', $id)->get();

        return view('human_resource.employee.list', $data);
    }


    public function create()
    {
        return view('human_resource.department.create');
    }


    public function store(Request $request)
    {
        $postData = $request->except('_token');
        $postData['created_at'] = \Carbon\Carbon::now();
        $postData['status'] = 1;
        $insertData= Department::insert($postData);

        if ($insertData)
        {
            Alert::toast('Department added successfully.','success')->width('375px');
        }

        return redirect('department');

    }

    public function edit($id)
    {
        $data['lists'] =  Department::find($id);
        return view('human_resource.department.edit', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $postData = $request->except('_token','id');
            $postData['updated_at'] = \Carbon\Carbon::now();
            //update data
            Department::where('id',$request->get('id'))->update($postData);
            DB::commit();
            Alert::toast('Department successfully updated', 'success')->width('375px');
        }catch (\Exception $e) {
            DB::rollback();
            Alert::toast('Department not update successfully','error')->width('570px');
        }
        return redirect()->route('department');
    }

    public function delete($id)
    {
        $test = Department::find($id);

        if ($test) {
            $test->delete();

            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }

    }
}
