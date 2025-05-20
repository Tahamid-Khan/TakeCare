<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveRequest;
use App\Models\FundDepartment;
use App\Models\Hospital;
use App\Models\HRModel;
use App\Models\Medicine;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class HRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allTeacherLists'] = HRModel::where([
            'status' => 1,
            'hr_type' => 'Teacher'
        ])->orderBy('id', 'asc')->get();

        return view('human_resource.list', $data);


    }

    public function indexStaff()
    {
        $data['allStaffLists'] = HRModel::where([
            'status' => 1,
            'hr_type' => 'Staff'
        ])->orderBy('id', 'asc')->get();

        return view('human_resource.listStaff', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('human_resource.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postData = $request->except('_token', 'hr_photo', 'hr_sign');
        $postData['created_at'] = Carbon::now();
        // move file
        if (isset($request->hr_photo) && !empty($request->hr_photo)) {
            $image_name = time() . Str::random(7) . '.' . $request->hr_photo->extension();
            $request->hr_photo->move(public_path('img/human_resource'), $image_name);
            $postData['hr_photo'] = $image_name;
        }
        if (isset($request->hr_sign) && !empty($request->hr_sign)) {
            $image_name = time() . Str::random(7) . '.' . $request->hr_sign->extension();
            $request->hr_sign->move(public_path('img/human_resource'), $image_name);
            $postData['hr_sign'] = $image_name;
        }
        $postData['status'] = 1;
        $insertData = HRModel::insert($postData);

        if ($insertData) {
            Alert::toast('Data created successfully.', 'success')->width('375px');
        }

        if ($postData['hr_type'] == 'Teacher') {
            return redirect('human_resource');
        } else {
            return redirect('staff');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['infoEdit'] = HRModel::find($id);
        return view('human_resource.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $postData = $request->except('_token', 'id', 'hr_photo', 'hr_sign');
        // move file
        if (isset($request->hr_photo) && !empty($request->hr_photo)) {
            $image_name = time() . Str::random(7) . '.' . $request->hr_photo->extension();
            $request->hr_photo->move(public_path('img/human_resource'), $image_name);
            $postData['hr_photo'] = $image_name;
        }
        if (isset($request->hr_sign) && !empty($request->hr_sign)) {
            $image_name = time() . Str::random(7) . '.' . $request->hr_sign->extension();
            $request->hr_sign->move(public_path('img/human_resource'), $image_name);
            $postData['hr_sign'] = $image_name;
        }
        /*data update*/
        $postData['updated_at'] = Carbon::now();
        $updateData = HRModel::where(['id' => $request->get('id')])->update($postData);

        if ($updateData) {
            Alert::toast('Data updated successfully.', 'success')->width('375px');
        }
        if ($postData['hr_type'] == 'Teacher') {
            return redirect('human_resource');
        } else {
            return redirect('staff');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = HRModel::find($id);
        if ($data) {
            $image_path_hr_photo = "img/human_resource/" . $data->hr_photo;
            $image_path_hr_sign = "img/human_resource/" . $data->hr_sign;
            if (File::exists($image_path_hr_photo)) {
                File::delete($image_path_hr_photo);
            }
            if (File::exists($image_path_hr_sign)) {
                File::delete($image_path_hr_sign);
            }
            $data->delete();
            Alert::toast('Data Deleted successfully.', 'success')->width('375px');
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function approveLeave()
    {
        $data['leaveRequests'] = EmployeeLeaveRequest::with('employee')->where('status', 'pending')->get();
        return view('human_resource.approve-leave-request', $data);
    }

    public function approveLeavePost(Request $request)
    {
        //        dd($request->all());
        try {
            DB::beginTransaction();

            $leaveRequest = EmployeeLeaveRequest::find($request->id);
            $leaveRequest->status = $request->status;
            if ($request->status == 'rejected') {
                $leaveRequest->rejection_reason = $request->rejection_reason;

                $employeeLeave = EmployeeLeave::where('employee_id', $leaveRequest->employee_id)->first();
                $leaveType = $leaveRequest->leave_type;
                $leaveValue = $leaveRequest->total;
                $employeeLeave->$leaveType -= $leaveValue;
                $employeeLeave->total_leave = $employeeLeave->sick_leave + $employeeLeave->casual_leave + $employeeLeave->marital_leave;
                $employeeLeave->save();
            }
            $leaveRequest->save();
            DB::commit();
            Alert::toast('Leave request rejected successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }
    }

    public function doctorView()
    {

        $data['doctors'] = Doctor::all();
        $data['departments'] = Department::all();
        $data['users'] = User::where('is_assigned', 0)->get();
        $data['assignedUsers'] = User::where('is_assigned', 1)->get();
        $data['doctorTypes'] = ["duty_doctor", "visiting_doctor", "pow_doctor", "opd_doctor", "icu_doctor", "ot_doctor", "emergency_doctor", "pathology_doctor", "radiology_doctor"];
        return view('human_resource.doctor', $data);
    }

    public function addDoctor(Request $request)
    {
        //        dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'department_id' => 'required',
            'type' => 'required',
            'phone' => 'required',
            'specialization' => 'required',
            'position' => 'required',
            'qualification' => 'required',
            'address' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Please fill all the required fields', 'error')->width('375px');
            return back();
        }

        try {
            DB::beginTransaction();
            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->department_id = $request->department_id;
            $doctor->type = $request->type;
            $doctor->address = $request->address;
            $doctor->contactNumber = $request->phone;
            $doctor->specialization = $request->specialization;
            $doctor->position = $request->position;
            $doctor->qualification = $request->qualification;
            $doctor->user_id = $request->user_id;
            $doctor->status = 1;
            $doctor->save();

            $user = User::findOrFail($request->user_id);
            $user->is_assigned = 1;
            $user->save();
            DB::commit();
            Alert::toast('Doctor added successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }
    }

    public function updateDoctor(Request $request)
    {
        //        dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'department_id' => 'required',
            'type' => 'required',
            'phone' => 'required',
            'specialization' => 'required',
            'position' => 'required',
            'qualification' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Please fill all the required fields', 'error')->width('375px');
            return back();
        }

        try {
            $doctor = Doctor::find($request->id);
            $doctor->name = $request->name;
            $doctor->department_id = $request->department_id;
            $doctor->type = $request->type;
            $doctor->address = $request->address;
            $doctor->contactNumber = $request->phone;
            $doctor->specialization = $request->specialization;
            $doctor->position = $request->position;
            $doctor->qualification = $request->qualification;
            $doctor->status = $request->status;
            $doctor->save();
            Alert::toast('Doctor updated successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }
    }

    public function deleteDoctor(Request $request)
    {
        $doctor = Doctor::find($request->id);
        if ($doctor) {
            $doctor->delete();
            Alert::toast('Doctor deleted successfully', 'success')->width('375px');
            return back();
        } else {
            Alert::toast('Doctor not found', 'error')->width('375px');
            return back();
        }
    }

    public function medicineView()
    {
        //        data medicine
        // $data['medicines'] = Medicine::where('status', '=', '1')->get();
        $data['medicines'] = Medicine::all();
        return view('human_resource.medicine', $data);
    }

    public function addMedicine(Request $request)
    {
        //        dd($request->all());
        $validator = Validator::make($request->all(), [
            'pharmaceutical_name' => 'required',
            'brand_name' => 'required',
            'generic_name' => 'required',
            'strength' => 'required',
            'dosage_description' => 'required',
            'retail_price' => 'required',
            'use_for' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Please fill all the required fields', 'error')->width('375px');
            return back();
        }

        try {
            $medicine = new Medicine();
            $medicine->pharmaceutical_name = $request->pharmaceutical_name;
            $medicine->brand_name = $request->brand_name;
            $medicine->generic_name = $request->generic_name;
            $medicine->strength = $request->strength;
            $medicine->dosage_description = $request->dosage_description;
            $medicine->price = $request->retail_price;
            $medicine->use_for = $request->use_for;
            $medicine->status = 1;
            $medicine->save();
            Alert::toast('Medicine added successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }
    }

    public function editMedicine(Request $request)
    {
        //        dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'pharmaceutical_name' => 'required',
            'brand_name' => 'required',
            'generic_name' => 'required',
            'strength' => 'required',
            'dosage_description' => 'required',
            'retail_price' => 'required',
            'use_for' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Please fill all the required fields', 'error')->width('375px');
            return back();
        }

        try {
            $medicine = Medicine::find($request->id);
            $medicine->pharmaceutical_name = $request->pharmaceutical_name;
            $medicine->brand_name = $request->brand_name;
            $medicine->generic_name = $request->generic_name;
            $medicine->strength = $request->strength;
            $medicine->dosage_description = $request->dosage_description;
            $medicine->price = $request->retail_price;
            $medicine->use_for = $request->use_for;
            $medicine->status = $request->status;
            $medicine->save();
            Alert::toast('Medicine updated successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }

    }

    public function deleteMedicine(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        try {
            $medicine = Medicine::findOrFail($request->id);
            $medicine->delete();
            Alert::toast('Medicine deleted successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }


    }

    public function addHospital(Request $request)
    {
        //        dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Please fill all the required fields', 'error')->width('375px');
            return back();
        }

        try {
            $hospital = new Hospital();
            $hospital->name = $request->name;
            $hospital->email = $request->email;
            $hospital->phone = $request->phone;
            $hospital->address = $request->address;
            if ($request->has('website')) {
                $hospital->website = $request->website;
            }
            $hospital->save();
            Alert::toast('Hospital added successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }
    }

    public function editHospital(Request $request)
    {
        //        dd($request->all());

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Please fill all the required fields', 'error')->width('375px');
            return back();
        }

        try {
            $hospital = Hospital::find($request->id);
            $hospital->name = $request->name;
            $hospital->email = $request->email;
            $hospital->phone = $request->phone;
            $hospital->address = $request->address;
            if ($request->has('website')) {
                $hospital->website = $request->website;
            }
            $hospital->save();
            Alert::toast('Hospital updated successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }
    }

    public function deleteHospital(Request $request)
    {
        //        dd($request->all());
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        try {
            $hospital = Hospital::findOrFail($request->id);
            $hospital->delete();
            Alert::toast('Hospital deleted successfully', 'success')->width('375px');
            return back();
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return back();
        }
    }

    public function hospitalView()
    {
        $data['hospitals'] = Hospital::all();
        return view('human_resource.hospital', $data);
    }

    public function services()
    {
        $data['departments'] = FundDepartment::with('fund')->get();
        $data['services'] = Service::with('department')->get();
        return view('human_resource.services', $data);
    }

    public function addService(Request $request)
    {
        //    dd($request->all());
        $request->validate([
            'department_id' => 'required',
            'name' => 'required',
            'price' => 'required',
        ]);
        try {
            Service::create(
                [
                    'department_id' => $request->department_id,
                    'name' => $request->name,
                    'price' => $request->price,
                ]
            );
            Alert::toast('Service added successfully', 'success')->timerProgressBar()->width('375px');
            return redirect()->back()->with('success', 'Service added successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->timerProgressBar()->width('375px');
            return redirect()->back()->with('error', 'Something went wrong');

        }
    }

    public function editService(Request $request)
    {
        //    dd($request->all());
        $request->validate(
            [
                'id' => 'required',
                'service_name' => 'required',
                'department_id' => 'required',
                'price' => 'required',
            ]
        );
        try {
            $service = Service::findOrFail($request->id);
            $service->name = $request->service_name;
            $service->department_id = $request->department_id;
            $service->price = $request->price;
            $service->save();

            Alert::toast('Service updated successfully', 'success')->timerProgressBar()->width('375px');
            return redirect()->back()->with('success', 'Service updated successfully');
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->timerProgressBar()->width('375px');
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }
}
