<?php


use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\AmbulanceDriverController;
use App\Http\Controllers\DBArchiveController;
use App\Http\Controllers\DeathRegistrationController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewPathologyController;
use App\Http\Controllers\PatientDischargeController;
use App\Http\Controllers\RadiologyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRController;
use App\Http\Controllers\OPDController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TestTubeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PathologyController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DutyDoctorController;
use App\Http\Controllers\NurseStationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\SuperAdminController;
use App\Http\Controllers\ICUController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\OTController;
use App\Http\Controllers\POWController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\WardBedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});
Route::get('test', function () {
    return view('admin.permissions.index');
});


Route::get('/login', function () {
    return view('welcome');
});

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/cmo', [DashboardController::class, 'cmoDashboard'])->middleware(['auth'])->name('cmo.dashboard');
require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/leave-request', [EmployeeController::class, 'leaveRequest'])->name('employee.leave-request');
    Route::post('/leave-request', [EmployeeController::class, 'leaveRequestPost'])->name('employee.leave-request-post');

    // Print Sticker
    Route::get('print-sticker/{test_id}', [DashboardController::class, 'printSticker'])->name('print-sticker');

    // Notice Upload
    Route::resource('notice', NoticeBoardController::class);
    Route::get('notice-board', [NoticeBoardController::class, 'noticeBoard'])->name('notice-board');

    // Send Message
    Route::resource('message', MessageController::class);
    Route::post('message-reply', [MessageController::class, 'reply'])->name('message-reply');


    //Employee Holidays
    Route::get('/holidays/get', [HolidayController::class, 'getHolidays']);
    Route::get('/holidays', [HolidayController::class, 'holidayView'])->name('holidays');


    //Data Retrieve route
    Route::get('/get-products', [DashboardController::class, 'getProduct'])->name('get-products');
    Route::get('/get-hospitals', [DashboardController::class, 'getHospital'])->name('get-hospitals');
    Route::get('/get-medicines', [DashboardController::class, 'getMedicine'])->name('get-medicines');
    Route::get('/get-beds-by-ward', [DashboardController::class, 'getBedsByWard'])->name('get.beds.by.ward');
    Route::get('/get-patients', [DashboardController::class, 'getPatients'])->name('get-patients');
    Route::get('/get-services', [DashboardController::class, 'getServices'])->name('get-services');
    Route::get('/get-patient-details/{id}', [DashboardController::class, 'getPatientDetails'])->name('get-patient-details');
    Route::get('/get-service-details/{id}', [DashboardController::class, 'getServiceDetails'])->name('get-service-details');

    //refer patient by doctors
    Route::group(['middleware' => ['checkUserType:opd_doctor,emergency_doctor,icu_doctor,pow_doctor,ot_doctor']], function () {
        Route::post('/refer-patient', [DashboardController::class, 'referPatient'])->name('dashboard.refer-patient');
    });

    //reception
    Route::group(['middleware' => ['checkUserType:receptionist']], function () {
        Route::get('reception', [ReceptionController::class, 'index'])->name('reception');
        Route::get('reception/admit-request', [ReceptionController::class, 'admitRequest'])->name('reception.admit-request');
        Route::get('/reception/create', [ReceptionController::class, 'create'])->name('reception.create');
        Route::post('/reception/save', [ReceptionController::class, 'store'])->name('reception.store');
        Route::get('/reception/edit/{id}', [ReceptionController::class, 'edit'])->name('reception.edit');
        Route::post('/reception/update', [ReceptionController::class, 'update'])->name('reception.update');
        Route::get('reception/delete/{id}', [ReceptionController::class, 'delete']);
        Route::get('/reception/view/{id}', [ReceptionController::class, 'view'])->name('reception.view');
        Route::get('/reception/discharge-patient', [ReceptionController::class, 'dischargePatient'])->name('reception.discharge-patient');
        Route::post('/reception/approve-discharge/{id}', [ReceptionController::class, 'approveDischarge'])->name('reception.approve-discharge');
        Route::get('reception/report-delivery', [ReceptionController::class, 'reportDelivery'])->name('reception.pathology_report');
        Route::get('reception/create-invoice', [ReceptionController::class, 'createInvoice'])->name('reception.create-invoice');
        Route::get('reception/payment', [ReceptionController::class, 'payment'])->name('reception.payment');
        Route::post('reception/payment-store', [ReceptionController::class, 'paymentStore'])->name('reception.payment.store');
        Route::get('reception/patient-invoice/{id}', [ReceptionController::class, 'patientInvoice'])->name('reception.patient-invoice');
        Route::post('reception/patient-invoice-store', [ReceptionController::class, 'patientInvoiceStore'])->name('reception.patient-invoice.store');
        Route::get('/reception/search-patient', [ReceptionController::class, 'searchPatient'])->name('search.patient');
        Route::post('/reception/search-patient', [ReceptionController::class, 'searchPatientResult'])->name('search.patient.result');
        Route::get('/reception/assign-test', [ReceptionController::class, 'assignTest'])->name('reception.assign-test');
        Route::post('/reception/pathology/mark-delivered/{id}', [ReceptionController::class, 'pathologyMarkDelivered'])->name('pathology.mark-delivered');
        Route::post('/reception/radiology/mark-delivered/{id}', [ReceptionController::class, 'radiologyMarkDelivered'])->name('radiology.mark-delivered');
        // Search emergency patient
        Route::get('/reception/search-emergency-patient', [ReceptionController::class, 'searchEmergencyPatient'])->name('search.emergency-patient');
        Route::post('/reception/search-emergency-patient-result', [ReceptionController::class, 'searchEmergencyPatientResult'])->name('search.emergency-patient.result');
        Route::get('/reception/emergency-registration', [ReceptionController::class, 'emergencyRegistration'])->name('reception.emergency-registration');
        Route::post('/reception/emergency-registration-store', [ReceptionController::class, 'newEmergencyRegistration'])->name('reception.emergency-registration.store');

        Route::get('/reception/opd-registration', [ReceptionController::class, 'registration'])->name('reception.opd-registration');
        Route::post('/reception/opd-registration', [ReceptionController::class, 'newRegistration'])->name('reception.opd-registration.store');
        Route::get('/reception/opd-slip-pdf/{id}', [ReceptionController::class, 'opdSlipPdf'])->name('reception.opd-slip-pdf');

        Route::get('/reception/ot-order', [ReceptionController::class, 'otOrder'])->name('reception.ot-order');
        Route::get('/reception/ot-order/{id}', [ReceptionController::class, 'otOrderUpdate'])->name('reception.ot-order-update');
        Route::get('/reception/test-order', [ReceptionController::class, 'testOrder'])->name('reception.test-order');
        Route::get('/reception/test-order/{id}', [ReceptionController::class, 'testOrderUpdate'])->name('reception.test-order-update');
        Route::get('/discharge-letter/{id}', [ReceptionController::class, 'dischargeLetterPdf'])->name('discharge-letter-pdf');

        // invoice route
        Route::get('invoice/{print_id}', [InvoiceController::class, 'index'])->name('invoice');
        Route::post('invoice-create', [InvoiceController::class, 'create'])->name('invoice-create');
    });

    Route::group(['middleware' => ['checkUserType:pathologist']], function () {
        Route::get('pathology/dashboard', [NewPathologyController::class, 'index'])->name('pathology.dashboard');
        Route::get('pathology/view-test/{id}', [NewPathologyController::class, 'viewTest'])->name('pathology.viewTest');
        Route::post('pathology/update-test-status/{id}', [NewPathologyController::class, 'updateTestStatus'])->name('pathology.updateTestStatus');
        Route::get('pathology/previous-test', [NewPathologyController::class, 'previousTest'])->name('pathology.previousTest');
        Route::get('pathology/test-report/{id}', [NewPathologyController::class, 'testReport'])->name('pathology.testReport');
        Route::get('pathology/report-generate/{id}', [NewPathologyController::class, 'reportGenerate'])->name('pathology.report-generate');
        Route::post('pathology/report-generate/{id}', [NewPathologyController::class, 'reportGeneratePost'])->name('pathology.report-generate-post');
        Route::post('pathology/request', [NewPathologyController::class, 'addRequest'])->name('pathology.request');
        Route::get('pathology/patient-test-list', [NewPathologyController::class, 'patientTestList'])->name('pathology.patient-test-list');

        //test-tube
        Route::get('/test-tube', [TestTubeController::class, 'index'])->name('test.tube');
        Route::get('/test-tube/create', [TestTubeController::class, 'create'])->name('test.tube.create');
        Route::post('/test-tube/save', [TestTubeController::class, 'store'])->name('test.tube.store');
        Route::get('/test-tube/edit/{id}', [TestTubeController::class, 'edit'])->name('test.tube.edit');
        Route::post('/test-tube/update', [TestTubeController::class, 'update'])->name('test.tube.update');
        Route::get('/test-tube/delete/{id}', [TestTubeController::class, 'delete']);

    });
    // OPD
    Route::group(['middleware' => ['checkUserType:opd_doctor']], function () {
        Route::get('/opd-patients/{id}', [OPDController::class, 'list'])->name('opd.list');
        Route::get('/opd-list/view/{id}', [OPDController::class, 'view'])->name('opd.view');
        Route::post('/opd-list/view/{id}', [OPDController::class, 'store'])->name('opd.store');
        Route::post('/opd-list/update/{id}', [OPDController::class, 'update'])->name('opd.update');
        Route::get('/opd-patient/{id}', [OPDController::class, 'opdPatient'])->name('opd.patient-previous-info');
        Route::post('/opd-patient/{id}', [OPDController::class, 'opdPatientNewSerial'])->name('opd.patient-previous-info');
        Route::get('/prescription-view/{id}', [OPDController::class, 'prescription'])->name('prescription');
    });
    // Emergency
    Route::group(['middleware' => ['checkUserType:receptionist']], function () {
        Route::get('/emergency-patients', [EmergencyController::class, 'emergencyList'])->name('emergency.list');
        Route::get('/emergency-list/view/{id}', [EmergencyController::class, 'emergencyView'])->name('emergency.view');
        Route::post('/emergency-list/view/{id}', [EmergencyController::class, 'emergencyStore'])->name('emergency.store');
        //    Route::get('/emergency-patient/{id}', [EmergencyController::class, 'emergencyPatient'])->name('emergency.patient-previous-info');
        //    Route::post('/emergency-patient/{id}', [EmergencyController::class, 'emergencyPatientNewSerial'])->name('emergency.patient-previous-info');
        Route::get('/emergency-prescription-view/{id}', [EmergencyController::class, 'emergencyPrescription'])->name('emergency-prescription');
    });


    // ICU
    Route::group(['middleware' => ['checkUserType:icu_doctor']], function () {
        Route::get('/icu', [ICUController::class, 'index'])->name('icu.dashboard');
        Route::get('/icu/add', [ICUController::class, 'add'])->name('icu.add');
        Route::get('/icu/patient-info/{id}', [ICUController::class, 'patientInfo'])->name('icu.patientInfo');
        Route::get('/icu/add/form', [ICUController::class, 'addForm'])->name('icu.add-form');
        Route::post('/icu/patient-info/{id}', [ICUController::class, 'store'])->name('icu.store');
        Route::post('/icu/add/patient', [ICUController::class, 'addPatient'])->name('icu.add-patient');
        Route::post('/icu/patient-release', [ICUController::class, 'releasePatientToPOW'])->name('icu.release-patient-to-pow');
        Route::get('/icu/hospital-info', [ICUController::class, 'hospitalInfo'])->name('icu.hospital-info');
    });
    // Duty Doctor
    Route::group(['middleware' => ['checkUserType:duty_doctor']], function () {
        Route::get('/duty-doctor', [DutyDoctorController::class, 'index'])->name('duty_doctor');
        Route::get('/duty-doctor/view/{id}', [DutyDoctorController::class, 'view'])->name('duty-doctor.view');
        Route::post('/patient-previous-history/{id}', [DutyDoctorController::class, 'addPreviousHistory'])->name('patient.previous-history');
        Route::post('/patient-current-status/{id}', [DutyDoctorController::class, 'addCurrentStatus'])->name('patient.current-status');
        Route::post('/patient-active-med-update', [DutyDoctorController::class, 'updateMedicineStatus'])->name('patient.updateMedicineStatus');
        // Route::post('/patient-active-med-delete', [DutyDoctorController::class, 'deleteMedicine'])->name('patient.deleteMedicine');
        Route::post('/patient-discharge-request', [DutyDoctorController::class, 'dischargeRequest'])->name('patient.discharge-request');
        Route::get('/duty-doctor/view-discharge-letter/{id}', [DutyDoctorController::class, 'viewDischarge'])->name('duty-doctor.view-discharge-letter');
        Route::post('/duty-doctor/reg-ot/{id}', [DutyDoctorController::class, 'regOT'])->name('duty-doctor.reg-ot');
    });


    // Nurse Station
    Route::group(['middleware' => ['checkUserType:nurse,admin']], function () {
        Route::get('/nurse-station/dashboard', [NurseStationController::class, 'dashboard'])->name('nurse.dashboard');
        Route::get('/nurse-station/doctor/{id}', [NurseStationController::class, 'patientList'])->name('nurse.patientList');
        Route::get('/nurse-station/patient/{id}', [NurseStationController::class, 'patientDetails'])->name('nurse.patientDetails');
        Route::post('/nurse-station/patient/patient-medicine-list', [NurseStationController::class, 'patientMedicineList'])->name('nurse.patient-medicine-list');
        Route::post('/nurse-station/patient/patient-test-list', [NurseStationController::class, 'patientTestList'])->name('nurse.patient-test-list');
        Route::get('/nurse-station/discharge-letter/{id}', [NurseStationController::class, 'dischargeLetter'])->name('nurse.discharge-letter');
        Route::post('/nurse-station/discharge-letter-store', [NurseStationController::class, 'dischargeLetterStore'])->name('nurse.discharge-letter-store');
        Route::post('/nurse-station/medicine-status-update', [NurseStationController::class, 'medicineStatusUpdate'])->name('nurse.medicine-status-update');
    });
    // POW Section
    Route::group(['middleware' => ['checkUserType:pow_doctor']], function () {
        Route::get('/pow/patient-list', [POWController::class, 'index'])->name('pow.patientList');
        Route::get('/pow/patient-list/{id}', [POWController::class, 'singleDocPatientList'])->name('pow.single-doc-patient-list');
        Route::post('/pow/add/patient', [POWController::class, 'addPatient'])->name('pow.add-patient');
        Route::get('/pow/add/form/{id}', [POWController::class, 'addForm'])->name('pow.add-form');
        Route::get('/pow/patient-info/{id}', [POWController::class, 'patientInfo'])->name('pow.patientInfo');
        Route::get('/pow/doctor-list', [POWController::class, 'doctorList'])->name('pow.doctorList');
    });
    //    Patient Discharge
    Route::post('/discharge-request/{id}', [PatientDischargeController::class, 'dischargeRequest'])->name('discharge-request');


    // OT Section
    Route::group(['middleware' => ['checkUserType:ot_doctor']], function () {
        Route::get('/ot-section/dashboard', [OTController::class, 'dashboard'])->name('ot.dashboard');
        Route::get('/ot-section/view/{id}', [OTController::class, 'view'])->name('ot.view');
        Route::get('/ot-section/ot-manager', [OTController::class, 'doctorList'])->name('ot.doctorList');
        Route::get('/ot-section/ot-manager/ot-list/{id}', [OTController::class, 'otList'])->name('ot.otList');
        Route::get('/ot-section/ot-manager/ot-list', [OTController::class, 'otListAll'])->name('ot-list-all');

        // Route::get('/ot/add', [OTController::class, 'add'])->name('ot.add');
        // Route::get('/ot/add/form', [OTController::class, 'addForm'])->name('ot.add-form');
        Route::post('/ot/start/{id}', [OTController::class, 'startOT'])->name('ot.start');
        Route::post('/ot/end/{id}', [OTController::class, 'endOT'])->name('ot.end');
        Route::post('/ot/add/patient', [OTController::class, 'addPatient'])->name('ot.add-patient');
        Route::get('/ot-section/start-ot/{id}', [OTController::class, 'startOTView'])->name('ot.start-ot');
        Route::get('/ot-section/charges', [OTController::class, 'charges'])->name('ot.charges');
        Route::post('/ot-section/add-charges', [OTController::class, 'addCharges'])->name('ot.add-charges');
        Route::post('/ot-section/edit-charges', [OTController::class, 'editCharges'])->name('ot.edit-charges');
        Route::post('/ot-section/delete-charges', [OTController::class, 'deleteCharges'])->name('ot.delete-charges');
    });
    // Store Section
    Route::group(['middleware' => ['checkUserType:store']], function () {
        Route::get('/store/dashboard', [StoreController::class, 'dashboard'])->name('store.dashboard');
        Route::get('/store/inventory', [StoreController::class, 'inventory'])->name('store.inventory');
        Route::get('/store/department', [StoreController::class, 'department'])->name('store.department');
        Route::get('/store/summary', [StoreController::class, 'summary'])->name('store.summary');
        Route::get('/get-item-type/{id}', [StoreController::class, 'getItemType'])->name('get-item-type');
        Route::get('/get-item/{id}', [StoreController::class, 'getItem'])->name('get-item-type');
        Route::post('/store/add-request-item', [StoreController::class, 'addRequestItem'])->name('store.add-request-item');
        Route::get('/store/purchase', [StoreController::class, 'purchasedProducts'])->name('store.purchased-products');
        Route::post('/store/purchased-invoice', [StoreController::class, 'purchasedInvoice'])->name('store.purchased-invoice');
        Route::post('/store/response-to-req', [StoreController::class, 'responseToRequest'])->name('store.response-to-request');
        Route::post('/store/add-new-product', [StoreController::class, 'addNewProduct'])->name('store.add-new-product');
        Route::post('/store/update-product', [StoreController::class, 'updateProduct'])->name('store.update-product');
        Route::post('/store/add-department', [StoreController::class, 'addDepartment'])->name('store.add-department');
        Route::post('/store/update-department', [StoreController::class, 'updateDepartment'])->name('store.update-department');
        Route::post('/store/delete-department', [StoreController::class, 'deleteDepartment'])->name('store.delete-department');
        Route::post('/store/add-item-type', [StoreController::class, 'addItemType'])->name('store.add-item-type');
        Route::post('/store/update-item-type', [StoreController::class, 'updateItemType'])->name('store.update-item-type');
        Route::post('/store/delete-item-type', [StoreController::class, 'deleteItemType'])->name('store.delete-item-type');
        Route::get('/store/search', [StoreController::class, 'searchProduct'])->name('store.search-product');
        Route::get('/product-details/{id}', [StoreController::class, 'getProductData'])->name('store.get-product-data');
        Route::get('/store/return-product', [StoreController::class, 'returnProductView'])->name('store.return-product');
        Route::post('/store/return-product', [StoreController::class, 'returnProduct'])->name('store.return-product');
        Route::get('/store/indent', [StoreController::class, 'indentView'])->name('store.indent');
        Route::post('/store/indent-store', [StoreController::class, 'indentStore'])->name('store.indent-store');
        Route::get('/store/indent-list-view', [StoreController::class, 'indentListView'])->name('store.indent-list-view');
        //    Route::post('/store/exchange-product', [StoreController::class, 'exchangeProduct'])->name('store.exchange-product');
        Route::resource('store-vendor', 'App\Http\Controllers\StoreVendorController');
    });

    // hr and cbd
    Route::group(['middleware' => ['checkUserType:hr,cbd']], function () {
        Route::get('employee-attendance', [EmployeeController::class, 'attendance'])->name('employee-attendance');
        Route::get('employee-leave', [EmployeeController::class, 'leave'])->name('employee-leave');
        Route::get('/department/employee/{id}', [DepartmentController::class, 'departmentEmployeeList'])->name('department.employee-list');
        Route::get('/employee/staff-summary/{id}', [EmployeeController::class, 'staffSummary'])->name('employee.staff-summary');
        Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
        Route::get('/department/employee', [DepartmentController::class, 'departmentEmployee'])->name('department.employee');
    });

    //hr route
    Route::group(['middleware' => ['checkUserType:hr']], function () {
        // All Department Telephone Numbers
        Route::get('telephone-numbers', [DashboardController::class, 'telephoneNumbers'])->name('telephone-numbers');
        // Employee Holiday
        Route::resource('employee-holiday', HolidayController::class);
        Route::get('/department', [DepartmentController::class, 'index'])->name('department');
        Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('/department/save', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::post('/department/update', [DepartmentController::class, 'update'])->name('department.update');
        Route::get('/department/delete/{id}', [DepartmentController::class, 'delete']);

        Route::get('/employee-merit-points', [EmployeeController::class, 'employeeMerit'])->name('employee-merit-points');
        Route::post('/employee-merit-points', [EmployeeController::class, 'employeeMeritPost'])->name('employee-merit-points-post');
        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::get('/getDepartmentInfo/{id}', [EmployeeController::class, 'getDepartmentInfo'])->name('getDepartmentInfo');
        Route::post('/employee/save', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::post('/employee/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::get('/employee/delete/{id}', [EmployeeController::class, 'delete']);


        //Ward Bed Management
        Route::get('/ward', [WardBedController::class, 'showAllWard'])->name('ward-bed.show-all-ward');
        Route::post('/ward/edit', [WardBedController::class, 'editWard'])->name('ward-bed.edit-ward');
        Route::post('/ward/add', [WardBedController::class, 'addWard'])->name('ward-bed.add-ward');
        Route::post('/ward/delete/{id}', [WardBedController::class, 'deleteWard'])->name('ward-bed.delete-ward');
        Route::post('/bed/edit', [WardBedController::class, 'editBed'])->name('ward-bed.edit-bed');
        Route::post('/bed/add', [WardBedController::class, 'addBed'])->name('ward-bed.add-bed');
        Route::post('/bed/delete/{id}', [WardBedController::class, 'deleteBed'])->name('ward-bed.delete-bed');
        Route::get('/bed', [WardBedController::class, 'showAllBed'])->name('ward-bed.show-all-bed');
        Route::get('/get-next-bed-number/{wardId}', [WardBedController::class, 'getNextBedNumber'])->name('ward-bed.get-next-bed-number');

        // Teacher and staff route
        Route::get('human_resource', [HRController::class, 'index'])->name('human_resource.list');
        Route::get('staff', [HRController::class, 'indexStaff'])->name('staff.list');
        Route::get('/info/create', [HRController::class, 'create'])->name('info.create');
        Route::post('/info/save', [HRController::class, 'store'])->name('info.store');
        Route::get('/info/edit/{id}', [HRController::class, 'edit'])->name('info.edit');
        Route::post('/info/update', [HRController::class, 'update'])->name('info.update');
        Route::get('info/delete/{id}', [HRController::class, 'delete']);
        Route::get('approve-leave', [HRController::class, 'approveLeave'])->name('approve-leave');
        Route::post('approve-leave', [HRController::class, 'approveLeavePost'])->name('hr.approve-leave-post');
        Route::get('hr/doctor', [HRController::class, 'doctorView'])->name('human_resource.doctor-view');
        Route::post('hr/doctor', [HRController::class, 'addDoctor'])->name('hr.add-doctor');
        Route::post('hr/doctor/update', [HRController::class, 'updateDoctor'])->name('hr.update-doctor');
        Route::post('hr/doctor/delete', [HRController::class, 'deleteDoctor'])->name('hr.delete-doctor');
        Route::resource('hr-nurse', 'App\Http\Controllers\NurseController');
        Route::get('hr/medicine', [HRController::class, 'medicineView'])->name('human_resource.medicine-view');
        Route::post('hr/medicine', [HRController::class, 'addMedicine'])->name('add-medicine');
        Route::post('hr/medicine/edit', [HRController::class, 'editMedicine'])->name('edit-medicine');
        Route::post('hr/medicine/delete', [HRController::class, 'deleteMedicine'])->name('delete-medicine');
        Route::get('hr/hospital', [HRController::class, 'hospitalView'])->name('human_resource.hospital-view');
        Route::post('hr/hospital', [HRController::class, 'addHospital'])->name('add-hospital');
        Route::post('hr/hospital/edit', [HRController::class, 'editHospital'])->name('edit-hospital');
        Route::post('hr/hospital/delete', [HRController::class, 'deleteHospital'])->name('delete-hospital');
        Route::get('hr/services', [HRController::class, 'services'])->name('hr.services');
        Route::post('hr/service/add', [HRController::class, 'addService'])->name('hr.add-service');
        Route::post('hr/service/edit', [HRController::class, 'editService'])->name('hr.edit-service');
    });

    //account list
    Route::group(['middleware' => ['checkUserType:accountant']], function () {
        // Route::get('account/pathology', [AccountController::class, 'index'])->name('account.pathology');
        // Route::get('account/pathology/dashboard/', [AccountController::class, 'dashboard'])->name('pathology.dashboard');
        Route::get('account/dashboard', [AccountController::class, 'dashboard'])->name('account.dashboard');
        Route::post('account/statementPDF', [AccountController::class, 'statementPDF'])->name('account.statementPDF');
        Route::get('account/add-fund', [AccountController::class, 'addFund'])->name('account.add-fund');
        Route::post('account/add-fund', [AccountController::class, 'addFundPost'])->name('account.add-fund.post');
        Route::get('account/{fund_slug}/{slug}', [AccountController::class, 'viewFundDepartmentDetails'])->name('account.view-fund-department-details');
        Route::get('account/patient-expense', [AccountController::class, 'patientExpense'])->name('account.patient-expense');
        Route::get('account/daily-expense', [AccountController::class, 'dailyExpense'])->name('account.daily-expense');
        Route::get('account/create-budget', [AccountController::class, 'createBudget'])->name('account.create-budget');
        Route::post('account/create-budget', [AccountController::class, 'createBudgetPost'])->name('account.create-budget-post');
        Route::get('account/fund-department', [AccountController::class, 'fundDepartment'])->name('account.fund-department');
        Route::get('account/view-budget', [AccountController::class, 'viewBudget'])->name('account.view-budget');
        Route::get('account/patient-invoice-list', [AccountController::class, 'patientInvoiceList'])->name('account.patient-invoice-list');
        Route::post('account/add-expense', [AccountController::class, 'addExpense'])->name('account.add-expense');
        Route::post('account/add-department', [AccountController::class, 'addDepartment'])->name('account.add-department');

        Route::get('account/reference-discount', [AccountController::class, 'referenceDiscount'])->name('account.reference-discount');
        Route::post('account/reference-discount', [AccountController::class, 'editReferenceDiscount'])->name('account.edit-reference-discount');
    });
    // Ambulance
    Route::group(['middleware' => ['checkUserType:ambulance']], function () {
        Route::resource('ambulance-dashboard', 'App\Http\Controllers\AmbulanceDashboardController');
        Route::resource('ambulance', 'App\Http\Controllers\AmbulanceController');
        Route::resource('ambulance-driver', 'App\Http\Controllers\AmbulanceDriverController');
        Route::resource('ambulance-trips', 'App\Http\Controllers\AmbulanceTripController');
    });
    // Death Registration
    Route::group(['middleware' => ['checkUserType:death_register']], function () {
        Route::get('death-registration-dashboard', [DeathRegistrationController::class, 'dashboard'])->name('death-registration.dashboard');
        Route::get('death-registration', [DeathRegistrationController::class, 'deathRegistration'])->name('death-registration');
        Route::get('death-report-view/{id}', [DeathRegistrationController::class, 'deathReportView'])->name('death-report-view');
        Route::post('death-registration', [DeathRegistrationController::class, 'store'])->name('death-registration.store');
    });
    // Radiology
    Route::group(['middleware' => ['checkUserType:radiology']], function () {
        Route::get('radiology/dashboard', [RadiologyController::class, 'index'])->name('radiology.dashboard');
        Route::get('radiology/view-test/{id}', [RadiologyController::class, 'viewTest'])->name('radiology.viewTest');
        Route::post('radiology/update-test-status/{id}', [RadiologyController::class, 'updateTestStatus'])->name('radiology.updateTestStatus');
        Route::get('radiology/previous-test', [RadiologyController::class, 'previousTest'])->name('radiology.previousTest');
        Route::get('radiology/test-report/{id}', [RadiologyController::class, 'testReport'])->name('radiology.testReport');
        Route::get('radiology/report-generate/{id}', [RadiologyController::class, 'reportGenerate'])->name('radiology.report-generate');
        Route::post('radiology/report-generate/{id}', [RadiologyController::class, 'reportGeneratePost'])->name('radiology.report-generate-post');
    });
    // admin list
    Route::group(['middleware' => ['checkUserType:admin']], function () {
        Route::get('admin/list', [SuperAdminController::class, 'adminList'])->name('admin.list');
        Route::get('admin/create', [SuperAdminController::class, 'adminCreate'])->name('admin.create');
        Route::post('save/admin', [SuperAdminController::class, 'saveAdmin'])->name('admin.save');
        Route::get('admin/edit/{id}', [SuperAdminController::class, 'adminEdit']);
Route::get('admin/delete/{id}', [App\Http\Controllers\Admin\SuperAdminController::class, 'delete'])->name('admin.delete');

        // DB Archive
        Route::get('/db-archives', [DBArchiveController::class, 'index'])->name('db-archive');
        Route::post('export-db', [DBArchiveController::class, 'exportTablesData'])->name('export.db');
    });
    // Route::get('user/list', [SuperAdminController::class, 'userList'])->name('user.list');

    //Pathology
    //    Route::get('pathology', [PathologyController::class, 'index'])->name('pathology');
    //    Route::get('/reception/create-test', [PathologyController::class, 'create'])->name('pathology.create');
    //    Route::post('/pathology/save', [PathologyController::class, 'store'])->name('pathology.store');
    //    Route::get('/pathology/edit/{id}', [PathologyController::class, 'edit'])->name('pathology.edit');
    //    Route::post('/pathology/update', [PathologyController::class, 'update'])->name('pathology.update');
    //    Route::post('/pathology/update/status', [PathologyController::class, 'updateStatus'])->name('pathology.update.status');
    //    Route::get('pathology/delete/{id}', [PathologyController::class, 'delete']);
    //    Route::get('pathology/test/lists', [TestController::class, 'index'])->name('pathology.list_test');
    //    Route::get('/pathology/test/create', [TestController::class, 'create'])->name('pathology.create_test');
    //    Route::post('/pathology/test/save', [TestController::class, 'store'])->name('pathology.store_test');
    //    Route::get('/pathology/test/edit/{id}', [TestController::class, 'edit'])->name('pathology.edit_test');
    //    Route::post('/pathology/test/update', [TestController::class, 'update'])->name('pathology.update_test');
    //    Route::get('pathology/test/delete/{id}', [TestController::class, 'delete'])->name('pathology.delete_test');
    //    Route::get('pathology/info/{id}', [PathologyController::class, 'getPatientName'])->name('pathology.info');
    //    Route::get('pathology/report', [PathologyController::class, 'report'])->name('pathology.report');

    // OPD Management (Admin only)
    Route::group(['middleware' => ['checkUserType:admin']], function () {
        Route::get('/opd-management', [App\Http\Controllers\OPDManagementController::class, 'index'])->name('opd.management');
        Route::get('/opd-management/doctor/{doctorId}', [App\Http\Controllers\OPDManagementController::class, 'doctorPatients'])->name('opd.management.doctor-patients');
        Route::get('/opd-management/doctor/{doctorId}/patient/{patientId}/edit', [App\Http\Controllers\OPDManagementController::class, 'editPatient'])->name('opd.management.edit-patient');
        Route::put('/opd-management/doctor/{doctorId}/patient/{patientId}', [App\Http\Controllers\OPDManagementController::class, 'updatePatient'])->name('opd.management.update-patient');
        Route::delete('/opd-management/doctor/{doctorId}/patient/{patientId}', [App\Http\Controllers\OPDManagementController::class, 'deletePatient'])->name('opd.management.delete-patient');
    });
});
