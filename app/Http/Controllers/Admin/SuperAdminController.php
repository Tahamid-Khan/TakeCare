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
//        dd($request->all());
        if ($request->input('adminId') != NULL) {
            $data['name'] = $request->input('name');
            $data['email'] = $request->input('email');
            $data['status']= 1;
            $data['user_type'] = $request->input('user_type');
            $password = $request->input('password');
            //dd();
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
            //dd($data);
            if(isset($request->image) && !empty($request->image))
            {
                $image = time() . Str::random(7) . '.' . $request->image->extension();
                $request->image->move(public_path('img/registration'), $image);
                $data['image'] = $image;

            }
            $admin = User::create($data);
            //dd($admin);
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



}
