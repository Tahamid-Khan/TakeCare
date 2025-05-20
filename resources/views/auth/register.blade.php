@extends('layouts.registerApp')
@section('mainContent')
  
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <h3>Add Employee</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Add Employee</h3>
                            </div>
                            <form action="{{ route('register') }}" class="p-2" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-4">
                                    <label for="name" class="col-12 col-form-label">Employee Name *</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <input type="hidden" name="emp_id" value="{{$emp->id}}">
                                            <input class="form-control custom-focus @error('emp_name') is-invalid @enderror" placeholder="Employee Name" id="emp_name" name="emp_name" type="text" value="{{ $emp->emp_name }}" required="required">
                                        @else
                                            <input class="form-control custom-focus @error('emp_name') is-invalid @enderror" placeholder="Employee Name" id="emp_name" name="emp_name" type="text" value="{{ old('emp_name') }}" required="required">
                                        @endif
                                    </div>
                                    @error('emp_name')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-4">
                                    <label for="name" class="col-12 col-form-label">Employee Father Name</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('emp_father_name') is-invalid @enderror" placeholder="Employee Father Name" id="emp_father_name" name="emp_father_name" type="text" value="{{ $emp->emp_father_name }}">
                                        @else
                                            <input class="form-control custom-focus @error('emp_father_name') is-invalid @enderror" placeholder="Employee Father Name" id="emp_father_name" name="emp_father_name" type="text" value="{{ old('emp_father_name') }}">
                                        @endif
                                    </div>
                                    @error('emp_father_name')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-4">
                                    <label for="name" class="col-12 col-form-label">Employee Mother Name</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('emp_mother_name') is-invalid @enderror" placeholder="Employee Mother Name" id="emp_mother_name" name="emp_mother_name" type="text" value="{{ $emp->emp_mother_name }}">
                                        @else
                                            <input class="form-control custom-focus @error('emp_mother_name') is-invalid @enderror" placeholder="Employee Mother Name" id="emp_mother_name" name="emp_mother_name" type="text" value="{{ old('emp_mother_name') }}">
                                        @endif
                                    </div>
                                    @error('emp_mother_name')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3">
                                    <label for="name" class="col-12 col-form-label">Group Name *</label>
                                    <div class="col-12">
                                        
                                        <select class="form-control select2" id="group_id" name="group_id" style="width: 100%;" required="required">
                                            
                                             

                                                <option value="1">1</option>
                                                
                                           
                                        </select>
            
                                    </div>
                                    @error('group_id')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-3">
                                    <label for="name" class="col-12 col-form-label">Department Name *</label>
                                    <div class="col-12">

                                        <select class="form-control select2" id="dep_id" name="dep_id" style="width: 100%;" required="required">
                                            
                                           
                                                <option value="1">1</option>
                                            
                                        </select>
                                      
                                    </div>
                                    @error('dep_id')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-3">
                                    <label for="name" class="col-12 col-form-label">Designation Name *</label>
                                    <div class="col-12">
 
                                        <select class="form-control select2" id="desi_id" name="desi_id" style="width: 100%;" required="required">
                                           
                                           
                                                <option value="1">1</option>
                                           
                                        </select>
                                        
                                    </div>
                                    @error('desi_id')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-3">
                                    <label for="name" class="col-12 col-form-label">Branch Name *</label>
                                    <div class="col-12">
                                         
                                        <select class="form-control select2" id="branch_id" name="branch_id" style="width: 100%;" required="required">

                                                <option value="1">1</option>
                                    
                                        </select>

                                    </div>
                                    @error('branch_id')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="name" class="col-12 col-form-label">Permission *</label>
                                        <div class="col-12">

                                                <select class="form-control select2" id="groups" name="groups" style="width: 100%;">
                                                    <option value="">For All Group</option>
                                             
                                                </select>
                                           
                                        </div>
                                        @error('groups')
                                        <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="email" class="col-12 col-form-label">Employee Email*</label>
                                        <div class="col-12">
                                            @if(isset($emp->id) && $emp->id != null)
                                                <input class="form-control custom-focus @error('email') is-invalid @enderror" placeholder="Employee Email" id="email" name="email" type="email" value="{{ $emp->email }}" required="required">
                                            @else
                                                <input class="form-control custom-focus @error('email') is-invalid @enderror" placeholder="Employee Email" id="email" name="email" type="email" value="{{ old('email') }}" required="required">
                                            @endif
                                        </div>
                                        @error('email')
                                        <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label for="password" class="col-12 col-form-label">Employee Password</label>
                                        <div class="col-12">
                                            @if(isset($emp->id) && $emp->id != null)
                                            <input class="form-control custom-focus @error('password') is-invalid @enderror" placeholder="Employee Password" id="password" name="password" type="password" value="{{ old('password') }}" required="required">
                                            @else
                                            <input class="form-control custom-focus @error('password') is-invalid @enderror" placeholder="Employee Password" id="password" name="password" type="password" value="{{ old('password') }}" >
                                            @endif
                                        </div>
                                        @error('password')
                                        <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                                                <!-- start -->
                                <div class="form-group row">

                                    <div class="col-4">
                                    <label for="emp_code" class="col-12 col-form-label">Employee Code </label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <input class="form-control custom-focus @error('emp_code') is-invalid @enderror" placeholder="Employee Code" id="emp_code" name="emp_code" type="text" value="{{ $emp->emp_code }}" >
                                        @else
                                            <input class="form-control custom-focus @error('emp_code') is-invalid @enderror" placeholder="Employee Code" id="emp_code" name="emp_code" type="text" value="{{ old('emp_code') }}" >
                                        @endif
                                    </div>
                                    @error('emp_code')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                    <label for="birth_date" class="col-12 col-form-label">Date of Birth</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('birth_date') is-invalid @enderror" placeholder="Employee Father Name" id="birth_date" name="birth_date" type="date" value="{{ $emp->birth_date }}">
                                        @else
                                            <input class="form-control custom-focus @error('birth_date') is-invalid @enderror" placeholder="Employee Father Name" id="birth_date" name="birth_date" type="date" value="{{ old('birth_date') }}">
                                        @endif
                                    </div>
                                    @error('birth_date')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-4">
                                    <label for="birth_place" class="col-12 col-form-label">Birth Place</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('birth_place') is-invalid @enderror" placeholder="Birth Place" id="birth_place" name="birth_place" type="text" value="{{ $emp->birth_place }}">
                                        @else
                                            <input class="form-control custom-focus @error('birth_place') is-invalid @enderror" placeholder="Birth Place" id="birth_place" name="birth_place" type="text" value="{{ old('birth_place') }}">
                                        @endif
                                    </div>
                                    @error('birth_place')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>


                                </div>
                                <!-- end -->

                                <div class="form-group row">
                                    <div class="col-4">
                                    <label for="emp_blood_group" class="col-12 col-form-label">Blodd Group</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                        <select class="form-control select2" id="emp_blood_group" name="emp_blood_group" style="width: 100%;" >
                                            <option value="{{$emp->emp_blood_group}}">{{$emp->emp_blood_group}}</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>

                                        @else
                                        <select class="form-control select2" id="emp_blood_group" name="emp_blood_group" style="width: 100%;" >
                                            <option value="">Select Blood Group</option>

                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>

                                        </select>
                                        @endif
                                    </div>
                                    @error('emp_blood_group')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                    <label for="name" class="col-12 col-form-label">Gender</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                        <select class="form-control select2" id="gender" name="gender" style="width: 100%;" >
                                            <option value="{{$emp->gender}}">{{$emp->gender}}</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>


                                        @else
                                        <select class="form-control select2" id="gender" name="gender" style="width: 100%;" >
                                            <option value="">Select Gender</option>

                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @endif
                                    </div>
                                    @error('gender')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                    <label for="religion" class="col-12 col-form-label">Religion</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                        <select class="form-control select2" id="religion" name="religion" style="width: 100%;" >
                                            <option value="{{$emp->religion}}">{{$emp->religion}}</option>

                                            <option value="Islam">Islam</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Chirstan">Chirstan</option>
                                            <option value="Buddoh">Buddoh</option>
                                            <option value="Other">Other</option>
                                        </select>

                                        @else
                                        <select class="form-control select2" id="religion" name="religion" style="width: 100%;" >
                                            <option value="">Select Religion</option>

                                            <option value="Islam">Islam</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Chirstan">Chirstan</option>
                                            <option value="Buddoh">Buddoh</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @endif
                                    </div>
                                    @error('religion')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>




                                </div>
                                <!-- start -->
                                <div class="form-group row">
                                    <div class="col-4">
                                    <label for="marital_status" class="col-12 col-form-label">Marital Status</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                        <select class="form-control select2" id="marital_status" name="marital_status" style="width: 100%;" >
                                            <option value="{{$emp->marital_status}}">{{$emp->marital_status}}</option>
                                            <option value="Married">Married</option>
                                            <option value="Unmarrid">Unmarrid</option>
                                            <option value="Widow">Widow</option>
                                            <option value="Divored">Divored</option>
                                            <option value="Other">Other</option>
                                        </select>

                                        @else
                                        <select class="form-control select2" id="marital_status" name="marital_status" style="width: 100%;" >
                                            <option value="">Select Status</option>

                                            <option value="Married">Married</option>
                                            <option value="Unmarrid">Unmarrid</option>
                                            <option value="Widow">Widow</option>
                                            <option value="Divored">Divored</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @endif
                                    </div>
                                    @error('marital_status')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                    <label for="national_id" class="col-12 col-form-label">National ID</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <input class="form-control custom-focus @error('national_id') is-invalid @enderror" placeholder="National ID" id="national_id" name="national_id" type="text" value="{{ $emp->national_id }}" >
                                        @else
                                            <input class="form-control custom-focus @error('national_id') is-invalid @enderror" placeholder="National ID" id="national_id" name="national_id" type="text" value="{{ old('national_id') }}" >
                                        @endif
                                    </div>
                                    @error('national_id')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                    <label for="passport_no" class="col-12 col-form-label">Passport No</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <input class="form-control custom-focus @error('passport_no') is-invalid @enderror" placeholder="Passport No" id="passport_no" name="passport_no" type="text" value="{{ $emp->passport_no }}" >
                                        @else
                                            <input class="form-control custom-focus @error('passport_no') is-invalid @enderror" placeholder="Passport No" id="passport_no" name="passport_no" type="text" value="{{ old('passport_no') }}" >
                                        @endif
                                    </div>
                                    @error('passport_no')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>




                                </div>
                                <!-- end -->
                                                                <div class="form-group row">
                                    <div class="col-4">
                                    <label for="driving_licence" class="col-12 col-form-label">Driving Licence</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <input class="form-control custom-focus @error('driving_licence') is-invalid @enderror" placeholder="Driving Licence" id="driving_licence" name="driving_licence" type="text" value="{{ $emp->driving_licence }}" >
                                        @else
                                            <input class="form-control custom-focus @error('driving_licence') is-invalid @enderror" placeholder="Driving Licence" id="driving_licence" name="driving_licence" type="text" value="{{ old('driving_licence') }}" >
                                        @endif
                                    </div>
                                    @error('driving_licence')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                    <label for="nationality" class="col-12 col-form-label">Nationality</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <input class="form-control custom-focus @error('nationality') is-invalid @enderror" placeholder="Nationality" id="nationality" name="nationality" type="text" value="{{ $emp->nationality }}" >
                                        @else
                                            <input class="form-control custom-focus @error('nationality') is-invalid @enderror" placeholder="Nationality" id="nationality" name="nationality" type="text" value="{{ old('nationality') }}" >
                                        @endif
                                    </div>
                                    @error('nationality')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                    <label for="remarks" class="col-12 col-form-label">Remarks</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <input class="form-control custom-focus @error('remarks') is-invalid @enderror" placeholder="Remarks" id="remarks" name="remarks" type="text" value="{{ $emp->remarks }}" >
                                        @else
                                            <input class="form-control custom-focus @error('remarks') is-invalid @enderror" placeholder="Remarks" id="remarks" name="remarks" type="text" value="{{ old('remarks') }}" >
                                        @endif
                                    </div>
                                    @error('remarks')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>




                                </div>
                                <!-- start -->
                                                                <div class="form-group row">
                                    <div class="col-6">
                                    <label for="pressent_address" class="col-12 col-form-label">Present Address</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <textarea class="form-control custom-focus @error('pressent_address') is-invalid @enderror" placeholder="Present Address" id="pressent_address" name="pressent_address" type="text"  >{{ $emp->pressent_address }}</textarea>
                                        @else
                                            <textarea class="form-control custom-focus @error('pressent_address') is-invalid @enderror" placeholder="Present Address" id="pressent_address" name="pressent_address" type="text"  >{{ old('pressent_address') }}</textarea>
                                        @endif
                                    </div>
                                    @error('driving_licence')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-6">
                                    <label for="permanent_address" class="col-12 col-form-label">Permanent Address</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <textarea class="form-control custom-focus @error('permanent_address') is-invalid @enderror" placeholder="Permanent Address" id="permanent_address" name="permanent_address" type="text"  >{{ $emp->permanent_address }}</textarea>
                                        @else
                                            <textarea class="form-control custom-focus @error('permanent_address') is-invalid @enderror" placeholder="Permanent Address" id="permanent_address" name="permanent_address" type="text"  >{{ old('permanent_address') }}</textarea>
                                        @endif
                                    </div>
                                    @error('permanent_address')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>







                                </div>
                                <!-- end -->
                                <!-- start -->
                                <div class="form-group row">
                                    <div class="col-3">
                                    <label for="name" class="col-12 col-form-label">Current Salary *</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('current_salary') is-invalid @enderror" placeholder="Current Salary" id="current_salary" name="current_salary" type="number" value="{{ $emp->current_salary }}" required="required" step=".01">
                                        @else
                                            <input class="form-control custom-focus @error('current_salary') is-invalid @enderror" placeholder="Current Salary" id="current_salary" name="current_salary" type="number" value="{{ old('current_salary') }}" required="required" step=".01">
                                        @endif
                                    </div>
                                    @error('current_salary')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>






                                    <div class="col-3">
                                    <label for="mobile_no" class="col-12 col-form-label">Mobile No *</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('mobile_no') is-invalid @enderror" placeholder="Mobile No" id="mobile_no" name="mobile_no" type="text" value="{{ $emp->mobile_no }}" required="required" >
                                        @else
                                            <input class="form-control custom-focus @error('mobile_no') is-invalid @enderror" placeholder="Mobile No" id="mobile_no" name="mobile_no" type="text" value="{{ old('mobile_no') }}" required="required" >
                                        @endif
                                    </div>
                                    @error('mobile_no')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-3">
                                    <label for="name" class="col-12 col-form-label">Joining Date *</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('joining_date') is-invalid @enderror" placeholder="Joining Date" id="joining_date" name="joining_date" type="date" value="{{ $emp->joining_date }}" required="required">


                                        @else
                                            <input class="form-control custom-focus @error('joining_date') is-invalid @enderror" placeholder="Joining Date" id="joining_date" name="joining_date" type="date" value="{{ old('joining_date') }}" required="required">
                                        @endif
                                    </div>
                                    @error('joining_date')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>


                                    <div class="col-3">
                                    <label for="job_confirmation_date" class="col-12 col-form-label">Confirmation Date</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('job_confirmation_date') is-invalid @enderror" placeholder="Joining Date" id="job_confirmation_date" name="job_confirmation_date" type="date" value="{{ $emp->job_confirmation_date }}" >
                                        @else
                                            <input class="form-control custom-focus @error('job_confirmation_date') is-invalid @enderror" placeholder="Joining Date" id="job_confirmation_date" name="job_confirmation_date" type="date" value="{{ old('job_confirmation_date') }}" >
                                        @endif
                                    </div>
                                    @error('job_confirmation_date')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>


                                </div>
                                <!-- end -->
                                <div class="form-group row">
                                    <div class="col-4">
                                    <label for="emp_att_no" class="col-12 col-form-label">Employee No(Attendance Mechine) *</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)

                                            <input class="form-control custom-focus @error('emp_att_no') is-invalid @enderror" placeholder="Employee NO" id="emp_att_no" name="emp_att_no" type="number" min="1" value="{{ $emp->emp_att_no }}" required="required" >
                                        @else
                                            <input class="form-control custom-focus @error('emp_att_no') is-invalid @enderror" placeholder="Employee NO" id="emp_att_no" name="emp_att_no" type="number" min="1" value="{{ old('emp_att_no') }}" required="required" >
                                        @endif
                                    </div>
                                    @error('emp_att_no')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="col-4">
                                    <label for="emp_photo" class="col-12 col-form-label">Photo</label>
                                    <div class="col-12">
                                        @if(isset($emp->id) && $emp->id != null)
                                            <input class="form-control custom-focus @error('emp_photo') is-invalid @enderror"  id="emp_photo" name="emp_photo" type="file" value="{{ $emp->emp_photo }}" >
                                        @else
                                            <input class="form-control custom-focus @error('emp_photo') is-invalid @enderror"  id="emp_photo" name="emp_photo" type="file" value="{{ old('emp_photo') }}" >
                                        @endif
                                    </div>
                                    @error('emp_photo')
                                    <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="emp_photo" class="col-12 col-form-label">Check is honorable</label>
                                    <div class="form-check">
                                        @if(isset($emp->id) && $emp->id != null)
                                            @if($emp->is_honourable==1)
                                                <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="is_honourable" checked>
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            @else
                                                <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="is_honourable">
                                                <label class="form-check-label" for="flexCheckChecked"></label>
                                            @endif
                                        @else
                                            <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="is_honourable">
                                            <label class="form-check-label" for="flexCheckChecked"></label>
                                        @endif
                                        Is Honorable
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 mt-3 mb-2 text-right">
                                   <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
@endsection
