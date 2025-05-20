<?php

namespace App\Http\Controllers;

use App\Models\PathologyModel;
use App\Models\Patient;
use App\Models\ReceptionModel;
use App\Models\Doctor;
use App\Models\TestList;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MyDailyReportExport;

class PathologyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['testLists'] = PathologyModel::orderBy('id', 'asc')->get();

        return view('pathology.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['patients'] = ReceptionModel::orderBy('id', 'asc')->get();

        // dd($data['patients']);
        $data['tests'] = TestList::orderBy('id', 'asc')->get();
////        $pathTestList = [
////            (object) ['id' => 1, 'name' => 'Blood Test', 'delivery_days' => 1,'amount' => 1000,],
////            (object) ['id' => 2, 'name' => 'Urine Test', 'delivery_days' => 1,'amount' => 500,],
////            (object) ['id' => 4, 'name' => 'ECG', 'delivery_days' => 1,'amount' => 2000,],
////            (object) ['id' => 5, 'name' => 'Stool Test', 'delivery_days' => 1,'amount' => 500,],
////        ];
//        $data['tests'] = $pathTestList;

        return view('pathology.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
//        dd($request->all());
        $requestData = $request->except(['save', '_token']);
        $requestData['created_at'] = \Carbon\Carbon::now();
        $requestData['date'] = \Carbon\Carbon::now();
        $insertData = PathologyModel::insert($requestData);


        if ($insertData) {
            Alert::toast('Test added successfully.', 'success')->width('375px');
        }

        return redirect('pathology');
    }

    public function edit($id)
    {
        $patients =  ReceptionModel::orderBy('id', 'asc')->get();
        $tests =  TestList::orderBy('id', 'asc')->get();
        $doctors =  Doctor::orderBy('id', 'asc')->get();
        $pathology = PathologyModel::find($id);
        $selectedTests = json_decode($pathology->test_list_details);

        return view('pathology.edit', compact('selectedTests', 'pathology', 'patients', 'tests', 'doctors'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $postData = $request->only(['status', 'date', 'doctor_id', 'type', 'test_list_details', 'patient_id', 'name', 'mobile', 'gender', 'age', 'address', 'reference', 'delivery_date', 'delivery_time', 'remark', 'total', 'discount', 'payable', 'paid', 'due', 'account']);

            // Update data
            $postData['updated_at'] = \Carbon\Carbon::now();
            $result = PathologyModel::where('id', $request->get('id'))->update($postData);

            if ($result !== false) {
                DB::commit();
                Alert::toast('Test information successfully updated', 'success')->width('375px');
            } else {
                DB::rollback();
                Alert::toast('Test information not updated successfully', 'error')->width('570px');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Alert::toast('An error occurred while updating test information', 'error')->width('570px');
        }

        return redirect()->route('pathology');
    }
    public function updateStatus(Request $request)
    {
        $testListId = $request->input('testListId');
        $newStatus = $request->input('newStatus');

        // Assuming TestList is the model for your table
        $testList = PathologyModel::find($testListId);

        if ($testList) {
            $testList->status = $newStatus;
            $testList->save();

            return response()->json(['message' => 'Status updated successfully'], 200);
        }

        return response()->json(['message' => 'TestList not found'], 404);
    }

    public function getPatientName($id)
    {
        $patient = Patient::where('patient_id', $id)->first();
//        dd($patient);
        $doctors = Doctor::orderBy('id', 'asc')->get();

        if ($patient) {
            return response()->json([
                'name' => $patient->name,
                'doctor_id' => $patient->doctor_id,
                'mobile' => $patient->mobile,
                'age' => $patient->age,
                'address' => $patient->address,
                'gender' => $patient->gender,
                'reference' => $patient->reference,
                'doctors' => $doctors->toArray()
            ]);
        } else {
            return response()->json(['error' => 'Patient not found'], 404);
        }
    }

    public function getDoctors($patientId)
    {
        // Fetch the doctors based on the patient ID
        $doctors = Doctor::whereHas('patient', function ($query) use ($patientId) {
            $query->where('id', $patientId);
        })->get();

        return response()->json(['doctors' => $doctors]);
    }



    public function delete($id)
    {
        $test = PathologyModel::find($id);

        if ($test) {
            $test->delete();

            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function report(Request $request)
    {
        $doctors = Doctor::orderBy('id', 'asc')->get();
        $tests = TestList::orderBy('id', 'asc')->get();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $doctorId = $request->input('doctor');
        $testName = $request->input('test');

        $now = Carbon::now();
        $today = $now->toDateString();

        $query = PathologyModel::orderBy('id', 'asc')->with('patient', 'doctor');
        //dd($query);
        // dd($request->all());
        if ($startDate && $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }
        if ($doctorId) {
            $query->where('doctor_id', $doctorId);
        }

        if ($testName) {
            $query->whereRaw('JSON_CONTAINS(test_list_details, ?)', ['{"name":"' . $testName . '"}']);
        }

        $lists = $query->get();
        //dd($data);
        $csvdata = [];
        $data['lists'] = $lists;
        if ($request->input('submit') == 'excel') {
            $csvdata[] = array(
                'Id',
                'Type',
                'PatientId',
                'Doctor',
                'Name',
                'Mobile',
                'Gender',
                'Age',
                'Address',
                'Reference',
                'Test List Details',
                'Delivery Date',
                'Delivery Time',
                'Remark',
                'Account',
                'Total',
                'Discount',
                'Payable',
                'Paid',
                'Due',
            );

            if (isset($lists) && $lists->isNotEmpty()) {
                foreach ($lists as $item) {
                    $patient = $item->patient;
                    $doctor = $item->doctor;
                    $testListDetails = json_decode($item->test_list_details, true);
                    $formattedTestList = implode(', ', array_map(function ($test) {
                        return "(name: {$test['name']}, price:{$test['price']}, days:{$test['days']})";
                    }, $testListDetails));

                    $csvdata[] = array(
                        $item->pathology_id,
                        $item->type == 0 ? 'OPD' : 'IPD',
                        $patient->patient_id,
                        $doctor->name,
                        $item->name,
                        $item->mobile,
                        $item->gender,
                        $item->age . ' years',
                        $item->address,
                        $item->reference,
                        $formattedTestList,
                        $item->delivery_date,
                        $item->delivery_time,
                        $item->remark,
                        $item->account == 1 ? 'Cash' : 'Bkash',
                        $item->total . 'TK',
                        $item->discount . '%',
                        $item->payable . 'TK',
                        $item->paid . 'TK',
                        $item->due . 'TK',
                    );
                }
            }
        }

        if ($request->get('submit') == 'pdf') {
            $pdfFileName = 'pathology-report-' . Carbon::now()->format('YmdHis') . '.pdf';
            $pdf = PDF::loadView('account.pathology-pdf', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->stream($pdfFileName);
        } elseif ($request->get('submit') == 'excel') {
            $CSVFileName = 'pathology-report' . '-' . Carbon::now()->format('YmdHis') . '.csv';

            return (new MyDailyReportExport($csvdata))->download($CSVFileName, \Maatwebsite\Excel\Excel::CSV);
        } else {
            //return view('account.pathology', $data);


            return view('pathology.report', [
                'doctors' => $doctors,
                'lists' => $lists,
                'tests' => $tests
            ]);
        }
    }
}
