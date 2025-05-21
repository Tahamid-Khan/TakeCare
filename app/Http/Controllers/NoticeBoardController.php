<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Notice;
use App\Models\NoticeDepartmentPivot;
use App\Traits\CheckUserType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class NoticeBoardController extends Controller
{
    use CheckUserType;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        //        hr or admin can view this page else redirect to home page
        $this->userType('hr', 'admin');

        $data['departments'] = Department::all();
        return view('admin.notice-upload', $data);


    }

    public function noticeBoard()
    {
        $data['notices'] = NoticeDepartmentPivot::where('department_id', 1)->with('notice')->get();
        return view('notice.notice-board', $data);
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
    // hr or admin can view this page else redirect to home page
    $this->userType('hr', 'admin');
    
    try {
        $validator = Validator::make($request->all(), [
            'notice_title' => 'required',
            'department' => 'required|array',
            'notice_type' => 'required',
            'notice_file' => 'required|file|mimes:pdf',
            'notice_description' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('Please fill all the fields correctly', 'error')->width('375px');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        
        $notice = new Notice();
        $notice->title = $request->notice_title;
        $notice->type = $request->notice_type;
        // Remove the description field as it doesn't exist in the database
        // $notice->description = $request->notice_description;
        
        // Handle file upload
        if ($request->hasFile('notice_file')) {
            $file = $request->file('notice_file');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/notice');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $file->move($uploadPath, $file_name);
            $notice->file = $file_name;
        }
        
        $notice->save();
        
        // Handle department relationships
        $noticeDepartmentPivotData = [];
        foreach ($request->department as $department) {
            // Skip 'all' option if it's in the array
            if ($department === 'all') continue;
            
            $noticeDepartmentPivotData[] = [
                'notice_id' => $notice->id,
                'department_id' => $department,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Only insert if there are departments to add
        if (!empty($noticeDepartmentPivotData)) {
            NoticeDepartmentPivot::insert($noticeDepartmentPivotData);
        }
        
        DB::commit();
        Alert::toast('Notice uploaded successfully', 'success')->width('375px');
        return redirect()->route('notice.index');
        
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Notice upload error: ' . $e->getMessage());
        Alert::toast('Something went wrong: ' . $e->getMessage(), 'error')->width('375px');
        return redirect()->back()->withInput();
    }
}


    public function show($id)
    {
        $data['notice'] = Notice::find($id);
        $data['latestNotices'] = NoticeDepartmentPivot::where('department_id', 1)->with('notice')->latest()->limit(5)->get();
        return view('notice.notice-details', $data);
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

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        // return response success with id
        return response()->json(['success' => 'Record deleted successfully. Id=' . $id]);
    }
}
