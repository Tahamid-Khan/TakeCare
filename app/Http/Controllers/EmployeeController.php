<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\EmpHistory;
use App\Models\EmployeeLeaveRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\EmpLeave;
use App\Models\EmployeeLeave;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\View\View|View
     */
    public function index()
    {
        $data['lists'] = Employee::orderBy('id', 'asc')->with('department')->get();

        return view('human_resource.employee.list', $data);
    }

    public function employeeMerit()
    {
        $data['lists'] = Employee::orderBy('id', 'asc')->get();

        return view('human_resource.employee.employee-merit-points', $data);
    }

    public function employeeMeritPost(Request $request)
    {
//                dd($request->all());
        try {
            DB::beginTransaction();
            $employee = Employee::find($request->employee_id);
            $employee->merit_points = $employee->merit_points + $request->points;
            $employee->save();


            $empHistory = new EmpHistory();
            $empHistory->employee_id = $request->employee_id;
            if ($request->points > 0) {
                $empHistory->history = 'Merit points added: ' . $request->points . ' points; Reason: ' . $request->reason . '; Remark: ' . $request->history;
            } else {
                $empHistory->history = 'Merit points deducted: ' . -$request->points . ' points; Reason: ' . $request->reason . '; Remark: ' . $request->history;
            }
            if ($request->document) {
                $document = $request->document;
                $document_name = time() . Str::random(7) . '.' . $document->extension();
                $document->move(public_path('img/history'), $document_name);
                $empHistory->document = $document_name;
            }
            $empHistory->save();

            DB::commit();
            Alert::toast('Merit points added successfully.', 'success')->width('375px');
            return redirect('employee-merit-points');
        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function staffSummary($id)
    {
        $data['employee'] = Employee::where('id', $id)->with('department')->first();
        $data['history'] = EmpHistory::where('employee_id', $id)->latest()->get();

        if (!$data['employee']) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        //        dd($data['employee']);
        return view('human_resource.employee.employee-view', $data);
    }


    public function create()
    {
        $data['department'] = Department::where('status', 1)->orderBy('id', 'asc')->get();
        return view('human_resource.employee.create', $data);
    }

    public function edit($id)
    {
        $data['employee'] = Employee::where('id', $id)->with('department')->first();
        $data['department'] = Department::where('status', 1)->orderBy('id', 'asc')->get();
        return view('human_resource.employee.edit', $data);
    }

    public function getDepartmentInfo($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json(['error' => 'Department not found'], 404);
        }

        $data = [
            'limit_emp' => $department->limit_emp,
            'total_emp' => $department->total_emp,
        ];

        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $previousData = Employee::where('id', $id)->first();
            if (!$previousData) {
                Alert::toast('Employee not found.', 'error')->width('375px');
                return redirect()->back();
            }
            $postData = $request->except('_token');
            $postData['updated_at'] = Carbon::now();

            // Move file
            if (!empty($request->photo)) {
                $image_name = time() . Str::random(7) . '.' . $request->photo->extension();
                $request->photo->move(public_path('img/human_resource'), $image_name);
                $postData['photo'] = $image_name;
            }

            // Check if department_id is not null
            if (!is_null($postData['department_id']) && $previousData->department_id != $postData['department_id']) {

                $previousDepartment = Department::find($previousData->department_id);
                $previousDepartment->total_emp = $previousDepartment->total_emp - 1;
                $previousDepartment->save();


                $depatId = $postData['department_id'];
                $department = Department::find($depatId);
                $department->total_emp = 1 + $department->total_emp;
                $department->save();

                $deptChange = new EmpHistory();
                $deptChange->employee_id = $id;
                $deptChange->history = 'Department changed from ' . $previousDepartment->name . ' to ' . $department->name;
                $deptChange->save();
            }

            if (!is_null($postData['shift_time']) && $previousData->shift_time != $postData['shift_time']) {
                $shiftChange = new EmpHistory();
                $shiftChange->employee_id = $id;
                $shiftChange->history = 'Shift changed from ' . $previousData->shift_time . ' to ' . $postData['shift_time'];
                $shiftChange->save();
            }

            if (!is_null($postData['basic_salary']) && $previousData->basic_salary != $postData['basic_salary']) {
                $salaryChange = new EmpHistory();
                $salaryChange->employee_id = $id;
                $salaryChange->history = 'Salary changed from ' . $previousData->basic_salary . 'tk to ' . $postData['basic_salary'] . 'tk';
                $salaryChange->save();
            }

            if (!is_null($postData['present_work_position']) && $previousData->present_work_position != $postData['present_work_position']) {
                $positionChange = new EmpHistory();
                $positionChange->employee_id = $id;
                $positionChange->history = 'Work position changed from ' . $previousData->present_work_position . ' to ' . $postData['present_work_position'];
                $positionChange->save();
            }

            Employee::where('id', $id)->update($postData);
            DB::commit();
            Alert::toast('Employee updated successfully.', 'success')->width('375px');
            return redirect('employee');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Alert::toast('Something went wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $postData = $request->except('_token');
            $postData['created_at'] = Carbon::now();
            if (!empty($request->photo)) {
                $image_name = time() . Str::random(7) . '.' . $request->photo->extension();
                $request->photo->move(public_path('img/human_resource'), $image_name);
                $postData['photo'] = $image_name;
            }

            $postData['status'] = 1;

            if (!is_null($postData['department_id'])) {
                $depatId = $postData['department_id'];
                $department = Department::find($depatId);
                $department->total_emp = 1 + $department->total_emp;
                $department->save();
            }

            $insertData = Employee::create($postData);
            $employeeHistory = new EmpHistory();
            $employeeHistory->employee_id = $insertData->id;
            $employeeHistory->history = 'Joined';
            $employeeHistory->save();
            DB::commit();
            Alert::toast('Employee added successfully.', 'success')->width('375px');
            return redirect('employee');

        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }


    public function delete($id)
    {
        $test = Employee::find($id);

        if ($test) {
            $test->delete();

            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function attendance(Request $request)
    {
        $filterStartDate = ($request->start_date) ? $request->start_date : null;
        $filterEndDate = ($request->end_date) ? $request->end_date : null;
        if ($filterStartDate != null && $filterEndDate != null) {
            if ($filterStartDate > $filterEndDate) {
                Alert::toast('Start date must come before end date.', 'error')->width('375px');
                return redirect()->back();
            }
        }
        $filter_emp_id = ($request->employee_id) ? $request->employee_id : null;
        $data['employees'] = Employee::orderBy('id', 'asc')->get();
        $query = Attendance::orderBy('date', 'desc')
            ->with('employee');
        if ($filterStartDate != null xor $filterEndDate != null) {
            Alert::toast('Please select both start and end date.', 'error')->width('375px');
            return redirect()->back();
        } else {
            if ($filterStartDate && $filterEndDate) {
                $query->whereBetween('date', [$filterStartDate, $filterEndDate]);
            }
        }
        if ($filter_emp_id) {
            $query->whereHas('employee', function ($query) use ($filter_emp_id) {
                $query->where('id', $filter_emp_id);
            });
        }
        $data['lists'] = $query->get();
        // dd($data['lists']);
        return view('human_resource.employee_attendance.attendance-list', $data);
    }

    public function leave()
    {
        $data['employees'] = Employee::orderBy('id', 'asc')->get();
        $data['lists'] = EmployeeLeave::orderBy('employee_id')
            ->with('employee')->get();
        $data['leave_types']['sick_leave'] = config(('basic.sick_leave'));
        $data['leave_types']['casual_leave'] = config(('basic.casual_leave'));
        $data['leave_types']['marital_leave'] = config(('basic.marital_leave'));
        $data['leave_types']['total_leave'] = config(('basic.total_leave'));

        return view('human_resource.employee_leave.leave-list', $data);
    }

    public function leaveRequest()
    {
        $user_id = auth()->user()->id;
//        $id = Employee::where('user_id', $user_id)->first()->id;
//        TODO: update this line when middleware is added (employee_id: update these routes first to add employee user type)
        $id = 1;
        $data['leaveRequests'] = EmployeeLeaveRequest::where('employee_id', $id)->get();
        return view('human_resource.employee_leave.leave-request-form', $data);
    }

    public function leaveRequestPost(Request $request)
    {
//        dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'leaveType' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'reason' => 'required',
            ]);

            if ($validator->fails()) {
                Alert::toast('Please fill all the fields appropriately.', 'error')->width('375px');
                return redirect()->back();
            }
            $userId = auth()->user()->id;
//            TODO: update this line when middleware is added ; (employee_id: update these routes first to add employee user type)
//            $employee_id = Employee::where('user_id', $userId)->first()->id;
            $employee_id = 1;
            DB::beginTransaction();
            $employeeLeave = EmployeeLeave::where('employee_id', $employee_id)->first();
            if (!$employeeLeave) {
                $employeeLeave = new EmployeeLeave();
                $employeeLeave->employee_id = $employee_id;
                $employeeLeave->total_leave = $employeeLeave->sick_leave + $employeeLeave->casual_leave + $employeeLeave->marital_leave;
                $employeeLeave->save();
            }
            //            day difference between start and end date
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
            $diff = $start_date->diffInDays($end_date) + 1;

            $leaveType = $request->leaveType;
            $currentLeave = $employeeLeave->$leaveType;
            $totalLeave = $currentLeave + $diff;
            if ($totalLeave > config(('basic.'.$leaveType))) {
                Alert::toast('You do not have enough leave.', 'error')->width('375px');
                return redirect()->back();
            }

//            update total leave
            $employeeLeave->$leaveType = $totalLeave;
            $employeeLeave->total_leave = $employeeLeave->sick_leave + $employeeLeave->casual_leave + $employeeLeave->marital_leave;
            $employeeLeave->save();

            $employeeLeaveRequest = new EmployeeLeaveRequest();
            $employeeLeaveRequest->employee_id = $employee_id;
            $employeeLeaveRequest->leave_type = $leaveType;
            $employeeLeaveRequest->start_date = $request->start_date;
            $employeeLeaveRequest->end_date = $request->end_date;
            $employeeLeaveRequest->total = $diff;
            $employeeLeaveRequest->reason = $request->reason;
            $employeeLeaveRequest->save();
            DB::commit();
            Alert::toast('Leave request submitted successfully.', 'success')->width('375px');
            return redirect('leave-request');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Something went wrong.', 'error')->width('375px');
            return redirect()->back();
        }
    }
}
