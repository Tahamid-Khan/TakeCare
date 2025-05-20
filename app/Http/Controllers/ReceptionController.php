<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\EmergencyPatient;
use App\Models\FundDepartment;
use App\Models\Operation;
use App\Models\Pathology;
use App\Models\PathologyRequest;
use App\Models\Patient;
use App\Models\PatientDischarge;
use App\Models\PatientDiscount;
use App\Models\PatientInvoice;
use App\Models\Payment;
use App\Models\Radiology;
use App\Models\ReceptionModel;
use App\Models\PatientAdmitRequest;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Fund;
use App\Models\OPDPatientSerial;
use App\Models\PathologyModel;
use App\Models\Service;
use App\Models\TestList;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
use Illuminate\Support\Facades\DB;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function index()
    {
        $data['patientLists'] = Patient::orderBy('id', 'desc')->get();

        return view('reception.list', $data);
    }

    public function admitRequest()
    {
        // patientLists
        $data['patientLists'] = PatientAdmitRequest::where('status', 'pending')->with('patient', 'doctor')->orderBy('id', 'desc')->get();
        return view('reception.admit-request', $data);
    }

    public function dischargePatient()
    {
        $data['dischargeRequests'] = PatientDischarge::where('status', 'doctor_approved')->with('patient.patientDue')->orderBy('id', 'desc')->get();
        return view('reception.discharged-patients', $data);
    }

    public function approveDischarge($id)
    {
        try {
            DB::beginTransaction();
            $dischargeID = $id;
            PatientDischarge::where('id', $id)->update(['status' => 'approved', 'discharge_date' => Carbon::now()]);

            $patientId = PatientDischarge::where('id', $id)->first()->patient_id;

            Patient::where('id', $patientId)->update(['doctor_id' => null]);

            Bed::where('patient_id', $patientId)->update(['bed_status' => 'empty', 'patient_id' => null]);

            DB::commit();
            Alert::toast('Patient discharged successfully', 'success')->width('375px');
        } catch (Exception $e) {
            DB::rollback();
            //            dd($e->getMessage());
            Alert::toast('Patient not discharged successfully', 'error')->width('570px');
        }
        return redirect()->route('reception.discharge-patient', ['id' => $dischargeID]);
    }

    public function reportDelivery()
    {
        $data['pathologyReports'] = Pathology::where('status', 'generated')->orWhere('status', 'delivered')->with('patient', 'service')->orderBy('id', 'desc')->get();
        $data['radiologyReports'] = Radiology::where('status', 'generated')->orWhere('status', 'delivered')->with('patient', 'service')->orderBy('id', 'desc')->get();
        return view('reception.pathology_report', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->request_patient_id) {
            //            dd($request->request_patient_id);
            $data['request_patient_id'] = $request->request_patient_id;
            $data['patientData'] = Patient::find($request->request_patient_id);
        }
        $data['doctor'] = Doctor::where('type', '=', 'duty_doctor')->orderBy('id')->get();
        $data['wards'] = Ward::orderBy('id')->get();
        return view('reception.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        //        dd($request->all());
        DB::beginTransaction();
        try {
            if ($request->patient_id == null) {
                $patient = new Patient();
            } else {
                $patient = Patient::findOrFail($request->patient_id);
            }
            $patient->name = $request->name;
            $patient->gender = $request->gender;
            $patient->age = $request->age;
            $patient->blood_group = $request->blood_group;
            $patient->mobile = $request->mobile;
            $patient->address = $request->address;
            $patient->guardian_mobile = $request->guardian_mobile;
            $patient->patient_summary = $request->patient_summary;
            $patient->patient_type = $request->patient_type;
            $patient->reference = $request->reference;
            $patient->doctor_id = $request->doctor_id;
            $patient->save();


            $patientId = $patient->id;

            // check if the patient is already in the bed
            $checkDuplicateBedBooking = Bed::where('patient_id', $patientId)->first();
            if ($checkDuplicateBedBooking) {
                Bed::findOrFail($checkDuplicateBedBooking->id)->update([
                    'bed_status' => "empty",
                    'patient_id' => null
                ]);
            }

            $bookBed = Bed::findOrFail($request->bed_id);
            //            dd($bookBed, $request->bed_id, $request->ward_id);
            $bookBed->bed_status = "occupied";
            $bookBed->patient_id = $patientId;
            $bookBed->save();

            // make admit request status to approved
            PatientAdmitRequest::where('patient_id', $patientId)->where('status', 'pending')->update(['status' => 'approved']);


            DB::commit();
            Alert::toast('Patient information successfully added', 'success')->width('375px');
            return redirect()->route('reception');
        } catch (Exception $e) {
            DB::rollback();
            Alert::toast('Patient information not added successfully', 'error')->width('570px');
            return redirect()->back();
        }

    }

    public function edit($id)
    {
        $data['patientLists'] = ReceptionModel::find($id);
        $data['doctor'] = Doctor::orderBy('type')->orderBy('name')->get();
        $data['wards'] = Ward::orderBy('id')->get();
        return view('reception.edit', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $bed = Bed::where('patient_id', $request->id)->first();
            if ($bed && $request->doctor_id == null) {
                Alert::toast("Assign doctor can't be empty. Patient is admitted in ward.", 'error')->width('375px');
                return redirect()->back();

            }

            $postData = $request->except('_token', 'id');
            //update data
            ReceptionModel::where('id', $request->get('id'))->update($postData);
            DB::commit();
            Alert::toast('Patient information successfully updated', 'success')->width('375px');
        } catch (Exception $e) {
            //            dd($e->getMessage());
            DB::rollback();
            Alert::toast('Patient information not update successfully', 'error')->width('570px');
        }
        return redirect()->route('reception');
    }

    public function delete($id)
    {
        $test = ReceptionModel::find($id);

        if ($test) {
            $test->delete();

            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function view($id)
    {
        $data['patientLists'] = ReceptionModel::find($id);

        $pathologyId = $data['patientLists']->id;
        $docId = $data['patientLists']->doctor_id;
        $data['doctor'] = Doctor::where('id', $docId)->first();

        $data['pathologyList'] = PathologyModel::where('patient_id', $pathologyId)->get();

        return view('reception.view', $data);
    }

    public function createInvoice(Request $request)
    {
        // $search = $request->get('search');
        // $data['patientLists'] = ReceptionModel::where('name', 'like', '%'.$search.'%')->get();
        // dd($data);

        $data['funds'] = Fund::all();
        return view('reception.create-invoice', $data);
    }

    public function payment()
    {
        return view('reception.payment-page');
    }


    public function paymentStore(Request $request)
    {
        //                                dd($request->all());
        try {
            $saveIDForPrinting = [];
            DB::beginTransaction();
            foreach ($request->services as $service) {
                if ($service['primary_id'] == null) {
                    continue;
                }
                $price = ($service['amount'] - $request->discount / 100) > 0 ? ($service['amount'] - ($service['amount'] * $request->discount / 100)) : 0;
                $getFundDepartment = Service::findOrFail($service['primary_id']);
                $data = PatientInvoice::create([
                    'patient_id' => $request->customer['id'],
                    'fund_department_id' => $getFundDepartment->department_id,
                    'service_name' => $service['name'],
                    'total_price' => $service['amount'],
                    'discount' => $request->discount,
                    'final_price' => $price,
                    'due_amount' => $price,
                    'payment_status' => 'unpaid'
                ]);

                //                add to Radiology if the fund department is radiology (5)
                if ($getFundDepartment->department_id == 5) {
                    $addRadiology = new Radiology();
                    $addRadiology->patient_id = $request->customer['id'];
                    $addRadiology->service_id = $service['primary_id'];
                    $addRadiology->invoice_id = $data->id;
                    $addRadiology->save();
                }
                //                add to Pathology if the fund department is pathology (6)
                if ($getFundDepartment->department_id == 6) {
                    $addRadiology = new Pathology();
                    $addRadiology->patient_id = $request->customer['id'];
                    $addRadiology->service_id = $service['primary_id'];
                    $addRadiology->invoice_id = $data->id;
                    $addRadiology->save();
                }
            }
            // $invoiceData = PatientInvoice::whereIn('id', $saveIDForPrinting)->get();

            // $data['lists'] = $invoiceData;

            // $pdfFileName = 'product-invoice-' . Carbon::now()->format('YmdHis') . '.pdf';
            // $pdf = PDF::loadView('reception.service-invoice-pdf', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
            if (isset($request->manual_services)) {
                foreach ($request->manual_services as $service) {

                    if ($service['name'] == null) {
                        continue;
                    }

                    $data = new PatientInvoice();
                    $data->patient_id = $request->customer['id'];
                    //                department id 3 for Board Uncategorized and 4 for Lab Uncategorized
                    $data->fund_department_id = $service['fund_type'] == 1 ? 3 : 4;
                    $data->service_name = $service['name'];
                    $data->total_price = $service['amount'];
                    $data->discount = $request->discount;
                    $data->final_price = $service['amount'] - ($service['amount'] * $request->discount / 100);
                    $data->due_amount = $data->final_price;
                    $data->payment_status = 'unpaid';
                    $data->save();

                }
            }
            if ($request->operation_id) {
                Operation::where('id', $request->operation_id)->update(['isRequested' => 0]);
            }
            if ($request->test_id) {
                PathologyRequest::where('id', $request->test_id)->update(['status' => 'completed']);
            }
            //


            DB::commit();

            Alert::toast('Invoices Created Successfully', 'success')->width('375px');
            return redirect()->route('reception.patient-invoice', ['id' => $request->customer['id']]);
        } catch (Exception $e) {
            DB::rollback();
            //            dd($e->getMessage());
            Alert::toast("Couldn't create invoice", 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function patientInvoice($id)
    {
        $data['patientData'] = Patient::find($id);
        $data['invoices'] = PatientInvoice::where('patient_id', $id)->orderBy('payment_status', 'desc')->orderBy('created_at', 'desc')->get();
        return view('reception.patient-invoice', $data);
    }

    public function patientInvoiceStore(Request $request)
    {
        //    dd($request->all());

        $validator = Validator::make($request->all(), [
            'sub_total' => 'required',
            'due' => 'required',
            'pay_now' => 'required',
            'mode' => 'required',
            'invoice_id' => 'required',
        ]);
        if ($validator->fails()) {
            Alert::toast('Fill in the required fields', 'error')->width('375px');
            return redirect()->back();
        }
        if ($request->due < 0) {
            Alert::toast('Due amount can not be negative', 'error')->width('375px');
            return redirect()->back();
        }
        if ($request->pay_now > $request->due) {
            Alert::toast('Pay now amount can not be greater than due amount', 'error')->width('375px');
            return redirect()->back();
        }
        if ($request->pay_now == 0) {
            Alert::toast('Pay now amount can not be zero', 'error')->width('375px');
            return redirect()->back();
        }
        try {
            DB::beginTransaction();
            $invoice = PatientInvoice::find($request->invoice_id);
            // $invoiceID = [

            // ];
            // dd($invoiceData);
            $invoice->due_amount = $request->due - $request->pay_now;
            $invoice->payment_status = $invoice->due_amount == 0 ? 'paid' : 'unpaid';
            $invoice->save();

            //            create payment
            $payment = new Payment();
            $payment->patient_invoice_id = $request->invoice_id;
            $payment->payable = $request->due;
            $payment->due = $invoice->due_amount;
            $payment->paid_now = $request->pay_now;
            $payment->payment_method = $request->mode;
            $payment->save();

            //            update fund department
            $updateFundDepartment = FundDepartment::findOrFail($invoice->fund_department_id);
            $updateFundDepartment->balance += $request->pay_now;
            $updateFundDepartment->save();

            // $invoiceData = PatientInvoice::where('id', $request->invoice_id)->get();

            // $data['lists'] = $invoiceData;
            // // dd($data);
            // $pdfFileName = 'product-invoice-' . Carbon::now()->format('YmdHis') . '.pdf';
            // $pdf = PDF::loadView('reception.service-invoice-pdf', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);

            DB::commit();

            Alert::toast('Invoice Updated Successfully', 'success')->width('375px');
            // return $pdf->stream($pdfFileName);
            return redirect()->route('reception.patient-invoice', ['id' => $invoice->patient_id, 'print_id' => $request->invoice_id]);
        } catch (Exception $e) {
            DB::rollback();
            //            dd($e->getMessage());
            Alert::toast("Couldn't update invoice", 'error')->width('375px');
            return redirect()->back();
        }
    }

    public function searchPatient()
    {
        $data['patientLists'] = Patient::orderBy('id', 'desc')->get();
        return view('reception.search-patient', $data);
    }

    public function searchPatientResult(Request $request)
    {
        // dd($request->all());
        if ($request->patient_id) {
            $patientData = Patient::where('patient_id', $request->patient_id)->first();
            if ($patientData) {
                Alert::toast('Patient found.', 'success')->width('375px');
                return redirect()->route('opd.patient-previous-info', $patientData->id)->with('patientData', $patientData);
            } else {
                Alert::toast('No patient found, Please Register.', 'alert')->width('375px');
                return redirect()->route('reception.opd-registration');
            }
        } elseif ($request->mobile) {
            $patientData = Patient::where('mobile', $request->mobile)->first();
            if ($patientData) {
                Alert::toast('Patient found', 'success')->width('375px');
                return redirect()->route('opd.patient-previous-info', $patientData->id)->with('patientData', $patientData);
            } else {
                Alert::toast('No patient found, Please Register.', 'alert')->width('375px');

                return redirect()->route('reception.opd-registration');
            }
        } else {
            Alert::toast('No patient found, Please Register.', 'alert')->width('375px');

            return redirect()->route('reception.opd-registration');
        }
    }

    public function registration()
    {
        $data['departments'] = Department::all();
        $data['doctors'] = Doctor::where('type', 'opd_doctor')->orderBy('name')->get();
        $today = date('Y-m-d');
        $query = OPDPatientSerial::where('status', 'pending')->where('date', '>=', $today)->orderBy('id', 'desc')->with('patient');
        $data['patientLists'] = $query->get();
        $data['totalPatient'] = $query->count();
        return view('reception.patient-registration', $data);
    }

    public function newRegistration(Request $request)
    {

        //         dd($request->all());
        try {
            DB::beginTransaction();
            $checkPhoneDuplicate = Patient::where('mobile', $request->mobile)->first();
            if ($checkPhoneDuplicate) {
                Alert::toast('Mobile number already exists', 'error')->width('375px');
                return redirect()->back();
            }

            $patient = new Patient();
            $patient->name = $request->name;
            $patient->age = $request->age;
            $patient->gender = $request->gender;
            $patient->mobile = $request->mobile;
            //            $patient->doctor_id = $request->doctor_id;
            $patient->room_number = $request->room_number;
            $patient->patient_type = $request->patient_type;
            $patient->save();

            // new patient serial
            $patientSerial = new OPDPatientSerial();
            $patientSerial->patient_id = $patient->id;
            $patientSerial->doctor_id = $request->doctor_id;
            //             $patientSerial->department_id = 1;
            $patientSerial->date = $request->date;
            $patientSerial->amount = $request->amount;
            $patientSerial->save();

            DB::commit();

            Alert::toast('Patient registered successfully', 'success')->width('375px');
            return redirect()->route('reception.opd-registration');
        } catch (Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->route('reception.opd-registration');
        }
    }

    public function opdSlipPdf($id)
    {

        // dd($id);
        $query = OPDPatientSerial::where('id', $id)->with('patient')->with('doctor');
        $data['patientLists'] = $query->get();
        // $data['lists'] = $lists;


        $pdfFileName = 'Token-slip-' . Carbon::now()->format('YmdHis') . '.pdf';
        $pdf = PDF::loadView('reception.token-slip-pdf', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream($pdfFileName);
    }

    public function searchEmergencyPatient()
    {
        return view('reception.search-emergency-patient');
    }

    public function searchEmergencyPatientResult(Request $request)
    {


        try {
            $patientData = null;
            if ($request->patient_id !== null) {
                $patientData = Patient::where('patient_id', $request->patient_id)->first();
            } elseif ($request->mobile !== null) {
                $patientData = Patient::where('mobile', $request->mobile)->first();
            }
            if (!$patientData) {
                Alert::toast('No patient found, Please Register.', 'alert')->width('375px');
                return redirect()->back();
            }
            return redirect()->route('reception.emergency-registration', ['patient_id' => $patientData->id]);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public
    function emergencyRegistration(Request $request)
    {
        if ($request->patient_id) {
            $data['patientData'] = Patient::find($request->patient_id);
        }
        $data['departments'] = Department::all();
        $data['doctors'] = Doctor::where('type', 'emergency_doctor')->orderBy('name')->get();
        return view('reception.emergency-patient-registration', $data);
    }

    public
    function newEmergencyRegistration(Request $request)
    {
        //        dd($request->all());
        try {
            DB::beginTransaction();
            if ($request->patient_id) {
                $patient = Patient::findOrFail($request->patient_id);
            } else {
                $patient = new Patient();
                $patient->name = $request->name;
                $patient->age = $request->age;
                $patient->gender = $request->gender;
                $patient->mobile = $request->mobile;
                $patient->patient_type = $request->patient_type;
                $patient->save();
            }
            $newEmergency = new EmergencyPatient();
            $newEmergency->patient_id = $patient->id;
            $newEmergency->doctor_id = $request->doctor_id;
            if ($request->need_case == 1) {
                $mlcData = $request->only('case_id', 'police_station', 'officer_name', 'officer_contact', 'case_details');
                if ($request->document) {
                    $file = $request->file('document');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/emergency'), $fileName);
                    //                    add the name in mlcData
                    $mlcData['document'] = $fileName;
                }
                $newEmergency->mlc = json_encode($mlcData);
            }
            $newEmergency->save();
            DB::commit();
            Alert::toast('Patient registered successfully', 'success')->width('375px');
            return redirect()->route('reception.emergency-registration');


        } catch (Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->width('375px');
            return redirect()->route('reception.emergency-registration');
        }
    }

    public function pathologyMarkDelivered($id)
    {
        try {
            DB::beginTransaction();
            Pathology::where('id', $id)->update(['status' => 'delivered']);
            DB::commit();
            Alert::toast('Pathology report delivered successfully', 'success')->width('375px');
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            Alert::toast('Pathology report not delivered successfully', 'error')->width('570px');
        }
        return redirect()->back();
    }


    public function radiologyMarkDelivered($id)
    {
        try {
            DB::beginTransaction();
            Radiology::where('id', $id)->update(['status' => 'delivered']);
            DB::commit();
            Alert::toast('Radiology report delivered successfully', 'success')->width('375px');
        } catch (Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            Alert::toast('Radiology report not delivered successfully', 'error')->width('570px');
        }
        return redirect()->back();
    }

    public
    function otOrder()
    {
        $data['operations'] = Operation::where('isRequested', 1)->with('patient', 'doctor', 'requestedByUser')->get();
        return view('reception.ot-order', $data);
    }

    public
    function otOrderUpdate($id)
    {

        $data['patientData'] = Operation::where('id', $id)->with('patient', 'doctor', 'requestedByUser')->first();
        // Get the discount amount based on the patient type
        if (!empty($data['patientData']->patient->reference)) {
            $discountData = PatientDiscount::where('patient_type', $data['patientData']->patient->reference)->first();
            $data['discount'] = $discountData ? $discountData->discount : 0;
        }
        return view('reception.ot-payment-update', $data);
    }

    public
    function testOrder()
    {
        $data['testRequests'] = PathologyRequest::where('status', 'pending')->with('patient', 'service', 'doctor')->get();
        return view('reception.test-order', $data);
    }

    public
    function testOrderUpdate($id)
    {
        $data['patientData'] = PathologyRequest::where('id', $id)->with('patient', 'doctor', 'service')->first();

        if (!empty($data['patientData']->patient->reference)) {
            $discountData = PatientDiscount::where('patient_type', $data['patientData']->patient->reference)->first();
            $data['discount'] = $discountData ? $discountData->discount : 0;
        }

        return view('reception.test-payment-update', $data);
    }

    public
    function dischargeLetterPdf($id)
    {
        //        dd($id);
        $getDischargeInfo = PatientDischarge::findOrFail($id);

        $patientID = $getDischargeInfo->patient_id;
        $data['dischargeInfo'] = $getDischargeInfo;

        $data['patient'] = Patient::with([
            'patientMedicine' => function ($query) {
                $query->where('status', 'active');
            },
            'patientStatus' => function ($query) {
                $query->latest()->first();
            },
            'patientDailySummary' => function ($query) {
                $query->latest()->first();
            },
            'patientDoctorAssignment.doctor',
            'previousHistory'
        ])->find($patientID);
        $data['dischargeDetails'] = json_decode($getDischargeInfo->details);

        return view('reception.discharge-patient-pdf', $data);
    }

    public
    function assignTest()
    {
        $pathTestList = [
            (object)['id' => 1, 'name' => 'Blood Test', 'delivery_days' => 1, 'amount' => 1000,],
            (object)['id' => 2, 'name' => 'Urine Test', 'delivery_days' => 1, 'amount' => 500,],
            (object)['id' => 4, 'name' => 'ECG', 'delivery_days' => 1, 'amount' => 2000,],
            (object)['id' => 5, 'name' => 'Stool Test', 'delivery_days' => 1, 'amount' => 500,],
        ];
        // All radiology tests
        $radioTestList = [
            (object)['id' => 1, 'name' => 'X-Ray', 'delivery_days' => 1, 'amount' => 500,],
            (object)['id' => 2, 'name' => 'CT Scan', 'delivery_days' => 1, 'amount' => 2000,],
            (object)['id' => 3, 'name' => 'MRI', 'delivery_days' => 1, 'amount' => 3000,],
            (object)['id' => 4, 'name' => 'Ultrasound', 'delivery_days' => 1, 'amount' => 1000,],
        ];

        $data['pathTests'] = $pathTestList;
        $data['radioTests'] = $radioTestList;
        //        $data['pathTests'] = TestList::orderBy('id', 'asc')->get();
        //        $data['radioTests'] = TestList::orderBy('id', 'asc')->get();
        return view('reception.assign-test', $data);
    }
}
