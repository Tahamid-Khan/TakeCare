<?php

namespace App\Http\Controllers;

use App\Models\ApprovedFund;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Fund;
use App\Models\FundDepartment;
use App\Models\Patient;
use App\Models\PatientDiscount;
use App\Models\PatientInvoice;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\PathologyModel;
use App\Models\Doctor;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MyDailyReportExport;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{


    public function dashboard()
    {
        return view('account.account-dashboard');
    }

    public function addFund()
    {
        $data['fundDepartments'] = FundDepartment::with('fund')->get();
        $data['approvedFunds'] = ApprovedFund::with('fundDepartment.fund')->latest()->get();
        return view('account.add-fund', $data);
    }

    public function addFundPost(Request $request)
    {
        //        dd($request->all());
        $request->validate([
            'fund_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'note' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $fund = new ApprovedFund();
            $fund->fund_department_id = $request->fund_id;
            $fund->amount = $request->amount;
            $fund->date = $request->date;
            $fund->note = $request->note;
            $fund->save();

            $updateFundDepartment = FundDepartment::findOrFail($request->fund_id);
            $updateFundDepartment->balance = $updateFundDepartment->balance + $request->amount;
            $updateFundDepartment->save();

            DB::commit();
            Alert::toast('Fund added successfully', 'success')->timerProgressBar()->width('375px');
            return redirect()->back()->with('success', 'Fund added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->timerProgressBar()->width('375px');
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    // Board Fund Section
    public function viewFundDepartmentDetails($fund_slug, $slug)
    {
        $data['fundDepartment'] = FundDepartment::where('slug', $slug)->first();
        $department_id = $data['fundDepartment']->id;
        $data['budget'] = Budget::where('department_id', $department_id)->orderBy('forMonth', 'desc')->first();
        //        dd($department_id);
        //        get all expenses
        $data['expenses'] = Expense::where('department_id', $department_id)->limit(20)->get();
        //        dd($data['expenses']);
        return view('account.fund-department-details', $data);
    }

    public function addExpense(Request $request)
    {
        //        dd($request->all());
        $request->validate([
            'budget_id' => 'required',
            'department_id' => 'required',
            'expense' => 'required',
            'date' => 'required',
            'purpose' => 'required',
        ]);
        try {
            //            check if expense is greater than balance
            $fundDepartment = FundDepartment::findOrFail($request->department_id);
            if ($fundDepartment->balance < $request->expense) {
                Alert::toast('Insufficient balance', 'error')->timerProgressBar()->width('375px');
                return redirect()->back()->with('error', 'Expense is greater than balance');
            }
            DB::beginTransaction();

            $updateBudget = Budget::findOrFail($request->budget_id);
            $updateBudget->expense = $updateBudget->expense + $request->expense;
            $updateBudget->save();

            $fund = new Expense();
            $fund->department_id = $request->department_id;
            $fund->amount = $request->expense;
            $fund->date = $request->date;
            $fund->purpose = $request->purpose;
            $fund->save();

            //            updateBalance
            $updateFundDepartment = FundDepartment::findOrFail($request->department_id);
            $updateFundDepartment->balance = $updateFundDepartment->balance - $request->expense;
            $updateFundDepartment->save();


            DB::commit();
            Alert::toast('Expense added successfully', 'success')->timerProgressBar()->width('375px');
            return redirect()->back()->with('success', 'Expense added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->timerProgressBar()->width('375px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    // others
    public function patientExpense()
    {
            $data['patients'] = Patient::with('patientInvoice.fundDepartment')->get();
//            dd($data['patients']);

        return view('account.patient-expense', $data);
    }

    public function dailyExpense()
    {
        return view('account.daily-expense');
    }

    public function statementPDF(Request $request)
    {
        //        dd($request->all());

        $lists = [
            (object)[
                'id' => '1',
                'date' => '7/25/2024',
                'fund' => 'board',
                'fund_includes' => 'icu billings',
                'purpose' => 'test',
                'income' => '342234',
                'expenditure' => '',
                'available_fund' => '23424'
            ],
            (object)[
                'id' => '2',
                'date' => '7/25/2024',
                'fund' => 'board',
                'fund_includes' => 'icu billings',
                'purpose' => 'test',
                'income' => '342234',
                'expenditure' => '',
                'available_fund' => '23424'
            ],
            (object)[
                'id' => '3',
                'date' => '7/25/2024',
                'fund' => 'board',
                'fund_includes' => 'icu billings',
                'purpose' => 'test',
                'income' => '342234',
                'expenditure' => '',
                'available_fund' => '23424'
            ],
        ];

        $data['lists'] = $lists;

        // dd($data);

        $pdfFileName = 'financial-statement-' . Carbon::now()->format('YmdHis') . '.pdf';
        $pdf = PDF::loadView('account.financial-statement-pdf', $data)->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream($pdfFileName);
    }

    public function createBudget()
    {
        $data['fundDepartments'] = FundDepartment::with('fund')->get();
        return view('account.create-budget', $data);
    }

    public function createBudgetPost(Request $request)
    {
        //        dd($request->all());
        $request->validate([
            'department_id' => 'required',
            'total_budget' => 'required',
            'forMonth' => 'required',
            'items' => 'required',
        ]);
        try {
            $checkBudget = Budget::where('department_id', $request->department_id)->where('forMonth', $request->forMonth)->first();
            if ($checkBudget) {
                Alert::toast('Budget already created for this month', 'error')->timerProgressBar()->width('375px');
                return redirect()->back()->with('error', 'Budget already created for this month');
            }
            DB::beginTransaction();
            $fund = new Budget();
            $fund->department_id = $request->department_id;
            $fund->amount = $request->total_budget;
            $fund->forMonth = $request->forMonth . '-01';
            $fund->items = json_encode($request->items);
            $fund->save();

            DB::commit();
            Alert::toast('Fund added successfully', 'success')->timerProgressBar()->width('375px');
            return redirect()->back()->with('success', 'Fund added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->timerProgressBar()->width('375px');
            return redirect()->back()->with('error', 'Something went wrong');
        }

    }

    public function viewBudget(Request $request)
    {
        if ($request->department && $request->month){
            $month = $request->month . '-01';
            $data['budgetDetails'] = Budget::where('department_id', $request->department)->where('forMonth', $month)->with('fundDepartment')->first();
        }
        $data['budgets'] = Budget::with('fundDepartment')->latest()->get();
        $data['fundDepartments'] = FundDepartment::all();
        return view('account.view-budget', $data);
    }

    public function patientInvoiceList()
    {
    $data['invoices'] = PatientInvoice::with('patient')->latest()->get();
        return view('account.patient-invoice', $data);
    }

    public function fundDepartment()
    {

        $data['fundDepartments'] = FundDepartment::with('fund')->get();
        $data['funds'] = Fund::all();
        return view('account.fund-department', $data);
    }

    public function addDepartment(Request $request)
    {
        //        dd($request->all());
        $request->validate([
            'fund_id' => 'required',
            'name' => 'required',

        ]);

        try {
            $fundDepartment = new FundDepartment();
            $fundDepartment->fund_id = $request->fund_id;
            $fundDepartment->name = $request->name;
            $fundDepartment->save();

            Alert::toast('Department added successfully', 'success')->timerProgressBar()->width('375px');
            return redirect()->back()->with('success', 'Department added successfully');
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->timerProgressBar()->width('375px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function referenceDiscount()
    {
        $data['discounts'] = PatientDiscount::all();
        return view('account.reference-discount', $data);
    }

    public function editReferenceDiscount(Request $request)
    {
        //        dd($request->all());

        if ($request->discount < 0 || $request->discount == '') {
            Alert::toast('Discount can not be negative or empty.', 'error')->timerProgressBar()->width('375px');
            return redirect()->back()->with('error', 'Discount can not be negative');
        }

        try {
            $discount = PatientDiscount::findOrFail($request->id);
            $discount->discount = $request->discount;
            $discount->save();

            Alert::toast('Discount updated successfully', 'success')->timerProgressBar()->width('375px');
            return redirect()->back()->with('success', 'Discount updated successfully');
        } catch (\Exception $e) {
            //            dd($e->getMessage());
            Alert::toast('Something went wrong', 'error')->timerProgressBar()->width('375px');
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

}
