<?php

namespace App\Http\Controllers;

use App\Models\StoreVendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class StoreVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $data['vendors'] = StoreVendor::all();
        return view('store.vendor', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try{
            $createNew = new StoreVendor();
            $createNew->name = $request->name;
            $createNew->email = $request->email;
            $createNew->phone = $request->phone;
            $createNew->save();

            Alert::toast('Vendor Created Successfully', 'success')->width('375px');
            return redirect()->back();
        }
        catch (\Exception $e){
            // dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        dd($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        dd($id);
    }
}
