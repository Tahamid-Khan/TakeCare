<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Holiday;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index()
    {
        $data['employeeHolidays'] = Holiday::with('employee')->get();
        $data['employees'] = Employee::all();
        return view('human_resource.employee-holiday-mark', $data);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try{
            $holiday = new Holiday();
//            $holiday->employee_id = $request->employee_id;
            $holiday->holiday_start_date = $request->start_date;
            $holiday->holiday_end_date = $request->end_date;
            $holiday->holiday_reason = $request->reason;
            $holiday->save();

            return response()->json(['success' => 'Holiday added successfully']);
        } catch (\Exception $e) {
//            return $e->getMessage();
            return response()->json(['error' => 'Something went wrong']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $holiday = Holiday::find($id);
            $holiday->holiday_start_date = $request->start_date;
            $holiday->holiday_end_date = $request->end_date;
            $holiday->holiday_reason = $request->reason;
            $holiday->save();

            return response()->json(['success' => 'Holiday updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $holiday = Holiday::find($id);
            $holiday->delete();

            return response()->json(['success' => 'Holiday deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong']);
        }
    }

    public function getHolidays()
    {
        $holidays = Holiday::select('holiday_start_date as start', 'holiday_reason as title', 'holiday_end_date as end', 'id')->get()->map(function ($holiday) {
            $holiday->end = date('Y-m-d', strtotime($holiday->end . ' +1 day'));
            return $holiday;
        });

        return response()->json($holidays);
    }

    public function holidayView()
    {
        return view('holiday.holidays-common');
    }
}
