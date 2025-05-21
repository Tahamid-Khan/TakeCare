<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrudModel;
use App\Models\JoinModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator; 
class SuperAdminController extends Controller
{
    public function adminList()
    {
        $data['paginateData'] = DB::table('users')
            ->select('users.*')

            ->orderBy('users.id', 'desc')
            ->paginate(20);
        //dd( $data['paginateData']);
        return view('admin.roles.adminList', $data);
    }
    public function userList()
    {
        $data['userList'] = DB::table('users')
            ->select('users.*')
            ->where('user_type','user')
            ->where('status',1)
            ->orderBy('users.id', 'desc')
            ->paginate(20);
        //dd( $data['userList']);
        return view('admin.roles.userList', $data);
    }

    public function adminCreate()
    {
        $data['userTypes'] = User::userTypes;
        return view('admin.roles.adminCreate', $data);
    }

public function saveAdmin(Request $request)
{
    // First validate basic requirements without uniqueness
    $basicValidator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'user_type' => 'required',
        'password' => $request->input('adminId') ? 'nullable|min:6' : 'required|min:6',
    ]);
    
    // If basic validation fails, return with errors but no toast
    if ($basicValidator->fails()) {
        return redirect()->back()->withErrors($basicValidator)->withInput();
    }
    
    // Now check for email uniqueness
    $emailValidation = 'unique:users,email';
    
    if ($request->input('adminId') != NULL) {
        // For updates, exclude the current user from the unique check
        $emailValidation = 'unique:users,email,' . $request->input('adminId');
    }
    
    $uniqueValidator = Validator::make($request->all(), [
        'email' => $emailValidation,
    ]);
    
    // If email uniqueness validation fails, show toast and return with errors
    if ($uniqueValidator->fails()) {
        Alert::toast('Email is already registered', 'error')->width('375px');
        return redirect()->back()->withErrors($uniqueValidator)->withInput();
    }

    if ($request->input('adminId') != NULL) {
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['status']= 1;
        $data['user_type'] = $request->input('user_type');
        $password = $request->input('password');
        
        if(isset($password) && !empty($password))
        {
            $data['password'] = Hash::make($request->input('password'));
        }

        if(isset($request->image) && !empty($request->image))
        {
            $image = time() . Str::random(7) . '.' . $request->image->extension();
            $request->image->move(public_path('img/registration'), $image);
            $data['image'] = $image;
        }
        
        $id = $request->input('adminId');
        DB::table('users')->where('id', $id)->update($data);
        Alert::toast('Data successfully Updated', 'success')->width('375px');
    }
    else
    {
        $password = Hash::make($request->input('password'));
        $data = [];
        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['status']= 1;
        $data['user_type'] = $request->input('user_type');
        $data['password'] = $password;
        
        if(isset($request->image) && !empty($request->image))
        {
            $image = time() . Str::random(7) . '.' . $request->image->extension();
            $request->image->move(public_path('img/registration'), $image);
            $data['image'] = $image;
        }
        
        $admin = User::create($data);
        Alert::toast('Data successfully Inserted', 'success')->width('375px');
    }
    
    return Redirect::to('admin/list');
}



    public function adminEdit($id)
    {
        $admin = DB::table('users')->where('id', $id)->first();
        $userTypes = User::userTypes;
        return view('admin.roles.adminCreate', compact('admin', 'userTypes'));
    }

public function delete($id)
{
    try {
        $user = User::find($id);
        if ($user) {
            // Delete the user's image if it exists
            if ($user->image && file_exists(public_path('img/registration/'.$user->image))) {
                unlink(public_path('img/registration/'.$user->image));
            }
            
            // Manually delete the user without triggering role-related operations
            DB::statement("SET FOREIGN_KEY_CHECKS=0");
            $result = DB::table('users')->where('id', $id)->delete();
            DB::statement("SET FOREIGN_KEY_CHECKS=1");
            
            if ($result) {
                return response()->json(['status' => 1, 'message' => 'User deleted successfully']);
            } else {
                return response()->json(['status' => 0, 'message' => 'Failed to delete user']);
            }
        }
        return response()->json(['status' => 0, 'message' => 'User not found']);
    } catch (\Exception $e) {
        return response()->json(['status' => 0, 'message' => $e->getMessage()]);
    }
}




}
