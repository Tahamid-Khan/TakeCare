<style>
    .bg-sky-cust {
        background-color: #0071C1 !important;

    }

    .main-sidebar * {
        color: white !important;
    }

    .selected-item {
        background-color: rgba(0, 0, 0, .1) !important;
    }

    .main-sidebar {
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>
@php
    $currentUrl = url()->current();
    $currentRoute = Route::currentRouteName();
    $receptionLinks = ['reception.create', 'reception.edit', 'reception.admit-request', 'reception.ot-order', 'reception.test-order', 'pathology.create', 'reception.ot-order-update', 'reception.test-order-update', 'search.patient', 'reception.opd-registration', 'opd.patient-previous-info', 'reception', 'reception.discharge-patient', 'reception.pathology_report', 'reception.create-invoice', 'reception.payment', 'reception.patient-invoice', 'search.emergency-patient', 'reception.emergency-registration'];
    $dutyDoctorLinks = ['duty_doctor.create', 'duty_doctor', 'duty-doctor.view-discharge-letter'];
    $nurseLinks = ['nurse.dashboard', 'nurse.patientList', 'nurse.patientDetails', 'nurse.discharge-letter'];
    $nurseDashboardLinks = ['nurse.dashboard', 'nurse.patientList', 'nurse.patientDetails', 'nurse.discharge-letter'];
//    $pathologyLinks = ['pathology', 'pathology.create_test', 'pathology.list_test', 'test.tube.create', 'test.tube', 'pathology.edit', 'pathology.edit_test', 'pathology.report'];
    $pathologyLinks = ['pathology.dashboard', 'pathology.viewTest', 'pathology.previousTest', 'pathology.report-generate', 'pathology.patient-test-list'];
    $opdLinks = ['opd.create', 'opd', 'opd.list', 'opd.view'];
    $icuLinks = ['icu.dashboard', 'icu.add', 'icu.add-form', 'icu.patientInfo', 'icu.hospital-info'];
    $powLinks = ['pow.patientList', 'pow.doctorList', 'pow.patientInfo', 'pow.single-doc-patient-list'];
    $otLinks = ['ot.dashboard', 'ot.doctorList', 'ot.otList', 'ot.view', 'pow.add-form', 'ot.start-ot', 'ot-list-all'];
    $storeLinks = ['store.dashboard', 'store.inventory', 'store.department', 'store.summary', 'store-vendor.index', 'store.return-product', 'store.purchased-products', 'store.indent'];
    $accountLinks = ['account.dashboard', 'account.add-fund', 'account.fund-department', 'account.doctor-charge', 'account.etc', 'account.patient-expense', 'account.daily-expense', 'account.create-budget', 'account.view-budget', 'account.patient-invoice-list', 'account.view-fund-department-details', 'account.reference-discount'];
    $hrLinks = ['department', 'ward-bed.show-all-ward', 'ward-bed.show-all-bed', 'department.create', 'department.edit', 'human_resource.doctor-view', 'hr-nurse.index', 'human_resource.medicine-view', 'human_resource.hospital-view', 'employee.create', 'employee', 'department.employee', 'department.employee-list', 'employee.staff-summary', 'employee-attendance', 'employee-leave', 'approve-leave', 'hr.services', 'employee.edit','employee-merit-points','notice.index', 'employee-holiday.index','telephone-numbers'];
    $hrItems = ['employee.create', 'employee', 'department.employee', 'department.employee-list', 'employee.staff-summary', 'employee-attendance', 'employee-leave', 'approve-leave',  'employee.edit','employee-merit-points','notice.index', 'employee-holiday.index'];
    $adminItems = ['department', 'ward-bed.show-all-ward', 'ward-bed.show-all-bed', 'department.create', 'department.edit', 'human_resource.doctor-view', 'hr-nurse.index', 'human_resource.medicine-view', 'human_resource.hospital-view','hr.services','telephone-numbers'];
    $ambulanceLinks = [ 'ambulance-dashboard.index' , 'ambulance.index','ambulance-driver.index' ,'ambulance-trips.index' ];
    $cbdLinks = ['employee','department.employee', 'department.employee-list', 'employee.staff-summary','employee-attendance', 'employee-leave'];
@endphp
    <!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-light-primary elevation-4 font-white bg-sky-cust">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link d-flex align-items-center pl-2 py-1">
        <img src="{{ asset('img/takecare_logo_uptd.png') }}" class="footer-logo mr-4" height="auto" width="50px" alt="Take Care" style="width: 13%;margin-left: 14px;margin-top: 5px;"/>
        <p class="mb-0">Take Care</p>
    </a>
    <!-- Sidebar Menu -->
    <nav class="mt-2 navbar">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
            <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->


            <li class="nav-item d-block d-sm-none {{ Route::currentRouteName() == 'notice-board' || Route::currentRouteName() == 'message.index' || Route::currentRouteName() == 'holidays' ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="fas fa-folder-open"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Menu<i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('notice-board') }}" class="nav-link {{ Route::currentRouteName() == 'notice-board' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Notice Board</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('message.index') }}" class="nav-link {{ Route::currentRouteName() == 'message.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Messages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('holidays') }}" class="nav-link {{ Route::currentRouteName() == 'holidays' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Holidays</p>
                        </a>
                    </li>
                </ul>
            </li>
            @userType('admin','receptionist')

            <li class="nav-item {{ in_array($currentRoute, $receptionLinks) || preg_match('/\/reception\/view\//', $currentUrl)  ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Reception<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('reception.admit-request') }}" class="nav-link {{ Route::currentRouteName() == 'reception.admit-request' || Route::currentRouteName() == 'reception.create' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Admit Patient</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('search.patient') }}" class="nav-link {{ Route::currentRouteName() == 'reception.opd-registration' || Route::currentRouteName() == 'search.patient' || Route::currentRouteName() == 'opd.patient-previous-info' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>OPD Patient</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('search.emergency-patient') }}" class="nav-link {{ Route::currentRouteName() == 'search.emergency-patient' || Route::currentRouteName() == 'reception.emergency-registration' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Emergency Patient</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reception') }}" class="nav-link {{ Route::currentRouteName() == 'reception' || Route::currentRouteName() == 'reception.edit' || preg_match('/\/reception\/view\//', $currentUrl) ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Patients</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reception.ot-order') }}" class="nav-link {{ Route::currentRouteName() == 'reception.ot-order' || Route::currentRouteName() == 'reception.ot-order-update' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Operation Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reception.test-order') }}" class="nav-link {{ Route::currentRouteName() == 'reception.test-order' || Route::currentRouteName() == 'reception.test-order-update' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Test Order</p>
                        </a>
                    </li>
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a href="{{ route('pathology.create') }}"--}}
                    {{--                           class="nav-link {{ Route::currentRouteName() == 'pathology.create' ? 'selected-item' : '' }}">--}}
                    {{--                            <i class="fas fa-circle nav-icon "></i>--}}
                    {{--                            <p>Pathological Test</p>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a href="{{ route('reception.assign-test') }}"--}}
                    {{--                           class="nav-link {{ Route::currentRouteName() == 'reception.assign-test' ? 'selected-item' : '' }}">--}}
                    {{--                            <i class="fas fa-circle nav-icon "></i>--}}
                    {{--                            <p>Assign Test</p>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li class="nav-item">
                        <a href="{{ route('reception.discharge-patient') }}" class="nav-link {{ Route::currentRouteName() == 'reception.discharge-patient' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Discharge Patients</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reception.pathology_report') }}" class="nav-link {{ Route::currentRouteName() == 'reception.pathology_report' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Report Delivery</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reception.create-invoice') }}" class="nav-link {{ Route::currentRouteName() == 'reception.create-invoice' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Create Invoice</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('reception.payment') }}" class="nav-link {{ Route::currentRouteName() == 'reception.payment' || Route::currentRouteName() == 'reception.patient-invoice' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Make Payment</p>
                        </a>
                    </li>

                </ul>
            </li>
            @enduserType

            {{-- Duty Doctor --}}
            @userType('admin','duty_doctor')
            <li class="nav-item {{ in_array($currentRoute, $dutyDoctorLinks) || preg_match('/\/duty-doctor\/view\//', $currentUrl) ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-user-md"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Duty Doctor<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('duty_doctor') }}" class="nav-link {{ Route::currentRouteName() == 'duty_doctor' || Route::currentRouteName() == 'duty-doctor.view-discharge-letter' || preg_match('/\/duty-doctor\/view\//', $currentUrl) ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Doctor Dashboard</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType


            <span>
            {{-- Ward Bed Management --}}
                {{--            <li --}}
                {{--                class="nav-item {{ Route::currentRouteName() == 'ward-bed.show-all-ward' || Route::currentRouteName() == 'ward-bed.show-all-bed' ? 'menu-open' : '' }}"> --}}
                {{--                <a href="#" class="nav-link"> --}}
                {{--                    <i class="fas fa-bong"></i> --}}
                {{--                    <p style="margin-left: 10px;" class="font-weight-bold">Ward/Bed<i class="fas fa-angle-left right"></i></p> --}}
                {{--                </a> --}}
                {{--                <ul class="nav nav-treeview"> --}}
                {{--                    <li class="nav-item"> --}}
                {{--                        <a href="{{ route('ward-bed.show-all-ward') }}" --}}
                {{--                           class="nav-link {{ Route::currentRouteName() == 'ward-bed.show-all-ward' ? 'selected-item' : '' }}"> --}}
                {{--                            <i class="fas fa-circle nav-icon "></i> --}}
                {{--                            <p>Wards</p> --}}
                {{--                        </a> --}}
                {{--                    </li> --}}
                {{--                    <li class="nav-item"> --}}
                {{--                        <a href="{{ route('ward-bed.show-all-bed') }}" --}}
                {{--                           class="nav-link {{ Route::currentRouteName() == 'ward-bed.show-all-bed' ? 'selected-item' : '' }}"> --}}
                {{--                            <i class="fas fa-circle nav-icon "></i> --}}
                {{--                            <p>Beds</p> --}}
                {{--                        </a> --}}
                {{--                    </li> --}}
                {{--                </ul> --}}
                {{--            </li> --}}
</span>
            {{-- Nurse Station --}}
            @userType('admin','nurse')
            <li class="nav-item {{ in_array($currentRoute, $nurseLinks)  ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-user-nurse"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Nurse Station<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('nurse.dashboard') }}" class="nav-link {{ in_array($currentRoute, $nurseDashboardLinks)  ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Nurse Dashboard</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType


            {{-- Pathology --}}
            @userType('admin','pathologist')
            <li class="nav-item {{ in_array($currentRoute, $pathologyLinks)  ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-microscope"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Pathology<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('pathology.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'pathology.dashboard' || Route::currentRouteName() == 'pathology.viewTest' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pathology.previousTest') }}" class="nav-link {{ Route::currentRouteName() == 'pathology.previousTest' || Route::currentRouteName() == 'pathology.report-generate' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Previous Test</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pathology.patient-test-list') }}" class="nav-link {{ Route::currentRouteName() == 'pathology.patient-test-list' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Manager</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType

            {{-- OPD --}}
            @userType('admin','opd_doctor')
            <li class="nav-item {{ in_array($currentRoute, $opdLinks)  ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-hospital"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">OPD<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('opd.list', [($id = 10)]) }}" class="nav-link {{ Route::currentRouteName() == 'opd.list' || Route::currentRouteName() == 'opd.view' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>OPD Patient</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType

            @userType('admin','emergency_doctor')
            {{-- Emergency --}}
            <li class="nav-item {{ Route::currentRouteName() == 'emergency.list' ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-lightbulb"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Emergency<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('emergency.list') }}" class="nav-link {{ Route::currentRouteName() == 'emergency.list' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Emergency Patient</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType

            {{-- ICU --}}
            @userType('admin','icu_doctor')
            <li class="nav-item {{ in_array($currentRoute, $icuLinks)  ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-briefcase-medical"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">ICU<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('icu.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'icu.dashboard' || Route::currentRouteName() == 'icu.patientInfo' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('icu.add') }}" class="nav-link {{ Route::currentRouteName() == 'icu.add' || Route::currentRouteName() == 'icu.add-form' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Add/Find</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('icu.hospital-info') }}" class="nav-link {{ Route::currentRouteName() == 'icu.hospital-info' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Hospital Info</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType

            {{-- POW Section --}}
            @userType('admin','pow_doctor')
            <li class="nav-item {{ in_array($currentRoute, $powLinks)  ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-bed"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">POW<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('pow.patientList') }}" class="nav-link {{ Route::currentRouteName() == 'pow.patientList' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Patient List</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pow.doctorList') }}" class="nav-link {{ Route::currentRouteName() == 'pow.doctorList' || Route::currentRouteName() == 'pow.single-doc-patient-list' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>POW Manager</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType


            {{-- OT Section --}}
            @userType('admin','ot_doctor')
            <li class="nav-item {{ in_array($currentRoute, $otLinks)  ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    {{--                    <i class="fas fa-bong"></i>--}}
                    <i class="fas fa-procedures"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">OT Section<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('ot.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'ot.dashboard' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>OT Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ot.doctorList') }}" class="nav-link {{ Route::currentRouteName() == 'ot.doctorList' || Route::currentRouteName() == 'ot.otList' || Route::currentRouteName() == 'ot-list-all' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>OT Manager</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('ot.add') }}"
                           class="nav-link {{ Route::currentRouteName() == 'ot.add' || Route::currentRouteName() == 'ot.add-form' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Add/Find</p>
                        </a>
                    </li> --}}
                    {{--                    <li class="nav-item"> --}}
                    {{--                        <a href="{{ route('ot.charges') }}" --}}
                    {{--                           class="nav-link {{ Route::currentRouteName() == 'ot.charges' ? 'selected-item' : '' }}"> --}}
                    {{--                            <i class="fas fa-circle nav-icon "></i> --}}
                    {{--                            <p>Charges</p> --}}
                    {{--                        </a> --}}
                    {{--                    </li> --}}
                </ul>
            </li>
            @enduserType

            {{-- Store Section --}}
            @userType('admin','store')
            <li class="nav-item {{ in_array($currentRoute, $storeLinks) ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-store"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Store Section<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('store.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'store.dashboard' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('store.inventory') }}" class="nav-link {{ Route::currentRouteName() == 'store.inventory' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Material Store</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('store.department') }}" class="nav-link {{ Route::currentRouteName() == 'store.department' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Department</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('store.summary') }}" class="nav-link {{ Route::currentRouteName() == 'store.summary' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Summary</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('store-vendor.index') }}" class="nav-link {{ Route::currentRouteName() == 'store-vendor.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Vendors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('store.return-product') }}" class="nav-link {{ Route::currentRouteName() == 'store.return-product' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Return Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('store.indent') }}" class="nav-link {{ Route::currentRouteName() == 'store.indent' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Create Quotation</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('store.purchased-products') }}"
                           class="nav-link {{ Route::currentRouteName() == 'store.purchased-products' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Purchased Products</p>
                        </a>
                    </li> --}}
                </ul>
            </li>
            @enduserType
            {{--Accounts--}}
            @userType('admin','accountant')
            <li class="nav-item {{ in_array($currentRoute, $accountLinks) ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-money-bill-wave"></i>
                    <p style="margin-left: 15px;" class="font-weight-bold">Accounts<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('account.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'account.dashboard' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('account.reference-discount') }}" class="nav-link {{ Route::currentRouteName() == 'account.reference-discount' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Reference Discount</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('account.add-fund') }}" class="nav-link {{ Route::currentRouteName() == 'account.add-fund' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Add Fund</p>
                        </a>
                    </li>
                    @php
                        $boardFundDepartments = \App\Models\FundDepartment::where('fund_id', 1)->with('fund')->get();
                        $labFundDepartments = \App\Models\FundDepartment::where('fund_id', 2)->with('fund')->get();
                        // dd($boardFundDepartments);
                    @endphp
                    <li class="nav-item">
                        <a href="{{ route('account.fund-department') }}" class="nav-link {{ Route::currentRouteName() == 'account.fund-department' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Fund Department</p>
                        </a>
                    </li>
                    {{-- Sub sub category --}}
                    <li class="nav-item {{ preg_match('/\/account\/board\//', $currentUrl) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="fas fa-hourglass-half nav-icon"></i>
                            <p>Board Fund<i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @foreach ($boardFundDepartments as $item)
                                @if ($item && $item->fund)
                                    <li class="nav-item pl-4">
                                        <a href="{{ route('account.view-fund-department-details', ['fund_slug' => $item->fund->type, 'slug' => $item->slug]) }}" class="nav-link {{ Route::currentRouteName() == 'account.view-fund-department-details' && $item->slug == request()->slug ? 'selected-item' : '' }}">
                                            <i class="fas fa-circle nav-icon "></i>
                                            <p>{{ $item->name }}</p>
                                        </a>
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </li>

                    <li class="nav-item {{  preg_match('/\/account\/lab\//', $currentUrl) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="fas fa-hourglass-half nav-icon"></i>
                            <p>Lab Fund<i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @foreach ($labFundDepartments as $item)
                                @if ($item && $item->fund)
                                    <li class="nav-item pl-4">
                                        <a href="{{ route('account.view-fund-department-details', ['fund_slug' => $item->fund->type, 'slug' => $item->slug]) }}" class="nav-link {{ Route::currentRouteName() == 'account.view-fund-department-details' && $item->slug == request()->slug ? 'selected-item' : '' }}">
                                            <i class="fas fa-circle nav-icon "></i>
                                            <p>{{ $item->name }}</p>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('account.patient-expense') }}" class="nav-link {{ Route::currentRouteName() == 'account.patient-expense' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Patient Expense</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('account.patient-invoice-list') }}" class="nav-link {{ Route::currentRouteName() == 'account.patient-invoice-list' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Patient Invoice</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('account.create-budget') }}" class="nav-link {{ Route::currentRouteName() == 'account.create-budget' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Create Budget</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('account.view-budget') }}" class="nav-link {{ Route::currentRouteName() == 'account.view-budget' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>View Budget</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType
            {{--HR Information--}}
            @userType('admin','hr')
            <li class="nav-item {{ in_array($currentRoute, $hrLinks)? 'menu-open': '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-user-tie"></i>
                    <p style="margin-left: 15px;" class="font-weight-bold">HR & Admin<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('notice.index') }}" class="nav-link {{ Route::currentRouteName() == 'notice.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Notice Upload</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('department') }}" class="nav-link {{ Route::currentRouteName() == 'department' || Route::currentRouteName() == 'department.create' || Route::currentRouteName() == 'department.edit' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Department</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ward-bed.show-all-ward') }}" class="nav-link {{ Route::currentRouteName() == 'ward-bed.show-all-ward' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Wards</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ward-bed.show-all-bed') }}" class="nav-link {{ Route::currentRouteName() == 'ward-bed.show-all-bed' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Beds</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('human_resource.doctor-view') }}" class="nav-link {{ Route::currentRouteName() == 'human_resource.doctor-view' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Doctor</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hr-nurse.index') }}" class="nav-link {{ Route::currentRouteName() == 'hr-nurse.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Nurse</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('human_resource.medicine-view') }}" class="nav-link {{ Route::currentRouteName() == 'human_resource.medicine-view' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Medicine</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('human_resource.hospital-view') }}" class="nav-link {{ Route::currentRouteName() == 'human_resource.hospital-view' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Hospital</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hr.services') }}" class="nav-link {{ Route::currentRouteName() == 'hr.services' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Services</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee.create') }}" class="nav-link {{ Route::currentRouteName() == 'employee.create' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Add Employee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('department.employee') }}" class="nav-link {{ Route::currentRouteName() == 'employee' || Route::currentRouteName() == 'employee.staff-summary' || Route::currentRouteName() == 'department.employee-list' || Route::currentRouteName() == 'department.employee' || Route::currentRouteName() == 'employee.edit' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Employee List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee-merit-points') }}" class="nav-link {{ Route::currentRouteName() == 'employee-merit-points' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Employee Merit</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee-holiday.index') }}" class="nav-link {{ Route::currentRouteName() == 'employee-holiday.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Employee Holiday</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee-attendance') }}" class="nav-link {{ Route::currentRouteName() == 'employee-attendance' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Employee Attendance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('employee-leave') }}" class="nav-link {{ Route::currentRouteName() == 'employee-leave' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Employee Leave</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('approve-leave') }}" class="nav-link {{ Route::currentRouteName() == 'approve-leave' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Approve Leave Request</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('telephone-numbers') }}" class="nav-link {{ Route::currentRouteName() == 'telephone-numbers' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>PhoneBook</p>
                        </a>
                    </li>

                </ul>
            </li>
            @enduserType

            {{-- Ambulance Section --}}
            @userType('admin','ambulance')
            <li class="nav-item {{ in_array($currentRoute, $ambulanceLinks) ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-ambulance"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Ambulance<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('ambulance-dashboard.index') }}" class="nav-link {{ Route::currentRouteName() == 'ambulance-dashboard.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ambulance.index') }}" class="nav-link {{ Route::currentRouteName() == 'ambulance.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Car</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ambulance-driver.index') }}" class="nav-link {{ Route::currentRouteName() == 'ambulance-driver.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Driver</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ambulance-trips.index') }}" class="nav-link {{ Route::currentRouteName() == 'ambulance-trips.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Trips</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType

            <!-- Death Registration -->
            @userType('admin','death_register')
            <li class="nav-item {{ Route::currentRouteName() == 'death-registration' || Route::currentRouteName() == 'death-registration.dashboard' ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-skull-crossbones"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Death Registration<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('death-registration.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'death-registration.dashboard' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('death-registration') }}" class="nav-link {{ Route::currentRouteName() == 'death-registration' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Death Registration</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType

            <!-- Radiology -->
            @userType('admin','radiology')
            <li class="nav-item {{ Route::currentRouteName() == 'radiology.dashboard' || Route::currentRouteName() == 'radiology.viewTest' || Route::currentRouteName() == 'radiology.previousTest' || Route::currentRouteName() == 'radiology.report-generate' ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-x-ray"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Radiology<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('radiology.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'radiology.dashboard' || Route::currentRouteName() == 'radiology.viewTest' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('radiology.previousTest') }}" class="nav-link {{ Route::currentRouteName() == 'radiology.previousTest' || Route::currentRouteName() == 'radiology.report-generate' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Previous Test</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType

            <!-- CBD -->
            @userType('admin','cbd')
            <li class="nav-item {{ in_array($currentRoute, $cbdLinks) ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-user-secret"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">CBD<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('department.employee') }}" class="nav-link {{ Route::currentRouteName() == 'employee' || Route::currentRouteName() == 'employee.staff-summary' || Route::currentRouteName() == 'department.employee-list' || Route::currentRouteName() == 'department.employee' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Employee List</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('employee-attendance') }}" class="nav-link {{ Route::currentRouteName() == 'employee-attendance' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Employee Attendance</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('employee-leave') }}" class="nav-link {{ Route::currentRouteName() == 'employee-leave' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon "></i>
                            <p>Employee Leave</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType
            <!-- CMO -->
            @userType('admin','cmo')
            <li class="nav-item {{ Route::currentRouteName() == 'cmo.dashboard' ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-user-cog"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">CMO<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('cmo.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'cmo.dashboard' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType
            <!-- Admin -->
            @userType('admin')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.list' || Route::currentRouteName() == 'admin.create' || Route::currentRouteName() == 'notice.index' || Route::currentRouteName() == 'db-archive' ? 'menu-open' : '' }}">
                @userType('admin')
                <a href="#" class="nav-link">
                    <i class="fas fa-cogs"></i>
                    <p style="margin-left: 10px;" class="font-weight-bold">Setup<i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                @enduserType
                <ul class="nav @userType('admin') nav-treeview @enduserType">
                    <li class="nav-item">
                        <a href="{{ route('admin.list') }}" class="nav-link {{ Route::currentRouteName() == 'admin.list' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>User List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('notice.index') }}" class="nav-link {{ Route::currentRouteName() == 'notice.index' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Notice Upload</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('db-archive') }}" class="nav-link {{ Route::currentRouteName() == 'db-archive' ? 'selected-item' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>DB Archive</p>
                        </a>
                    </li>
                </ul>
            </li>
            @enduserType

            <style>
                .button-reset {
                    width: 100%;
                    border: none;
                    background: none;
                    padding: 0;
                    font: inherit;
                    cursor: pointer;
                    outline: inherit;
                }
            </style>
            @if(!(auth()->user()->user_type == 'cmo' || auth()->user()->user_type == 'cbd'))
                <li class="nav-item">
                    <a href="{{ route('employee.leave-request') }}" class="nav-link {{ Route::currentRouteName() == 'employee.leave-request' ? 'selected-item' : '' }}">
                        <i class="fas fa-circle nav-icon "></i>
                        <p>Leave Request</p>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <div class="nav-link">
                    <form action="{{ route('logout') }}" method="POST">@csrf
                        <button type="submit" class="button-reset text-left">
                            <i class="fas fa-sign-out-alt" title="Logout"></i>
                            <span style="margin-left: 10px;" class="font-weight-bold">Logout</span>
                        </button>
                    </form>
                </div>
            </li>


            {{--            <ul class="navbar-nav ml-auto">--}}
            {{--                <li class="nav-item nav-link">--}}
            {{--                    <form method="POST" action="{{ route('logout') }}">--}}
            {{--                        @csrf--}}
            {{--                        <x-responsive-nav-link :href="route('logout')"--}}
            {{--                                               onclick="event.preventDefault(); this.closest('form').submit();"--}}
            {{--                                               class="nav-link">--}}
            {{--                            <i class="fas fa-sign-out-alt" title="Logout"></i>--}}
            {{--                            <p style="margin-left: 10px;" class="font-weight-bold">Logout</p>--}}
            {{--                        </x-responsive-nav-link>--}}
            {{--                    </form>--}}
            {{--                </li>--}}
            {{--            </ul>--}}

        </ul>
    </nav>
    <!-- /.sidebar-menu -->


    <!-- /.sidebar -->
</aside>
