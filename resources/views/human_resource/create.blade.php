@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Add Employee</h5>
                            </div>
                            <form action="{{ route('info.store') }}" class="p-2" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills st-back">
                                            <li class="nav-item"><a class="nav-link active" href="#general-information" data-toggle="tab">Employee Information</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#guardian-information" data-toggle="tab">More Information</a></li>

                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content shampan-heading">
                                            <div class="active tab-pane" id="general-information">
                                                <!-- Post -->
                                                <div class="col-md-12">
                                                <div class="row">
                                                        <div class="col-2 form-group">
                                                        <p class="p-tag">Type <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" name="hr_type" id="hr_type" required>
                                                                    <option value="">----</option>
                                                                    <option value="Employee" {{(old('hr_type') == 'Employee')? 'selected':''}}>Employee</option>
                                                                    <option value="Staff" {{(old('hr_type') == 'Staff')? 'selected':''}}>Staff</option>
                                                                </select>
                                                            <!-- </div> -->
                                                            @error('hr_type')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2 form-group">
                                                        <p class="p-tag">Serial <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('serial') is-invalid @enderror" placeholder="" id="serial" name="serial" type="number" value="{{ old('serial') }}" required>
                                                            <!-- </div> -->
                                                            @error('serial ')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2 form-group">
                                                        <p class="p-tag">HR ID <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('hr_id') is-invalid @enderror" placeholder="" id="hr_id" name="hr_id" type="number"  value="{{ old('hr_id') }}" required>
                                                            <!-- </div> -->
                                                            @error('hr_id')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4 form-group">
                                                        <p class="p-tag">Employee/Staff's Name <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('hr_name') is-invalid @enderror" placeholder="" id="hr_name" name="hr_name" type="text"  value="{{ old('hr_name') }}" required>
                                                            <!-- </div> -->
                                                            @error('hr_name')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2 form-group">
                                                        <p class="p-tag">Designation <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="designation" name="designation" required>
                                                                    <option value="">-----</option>
                                                                    <option value="Office Staff" {{(old('designation') == 'Office Staff')? 'selected':''}}>Office Staff</option>
                                                                    <option value="Peon" {{(old('designation') == 'Peon')? 'selected':''}}>Peon</option>
                                                                </select>
                                                            <!-- </div> -->
                                                            @error('designation')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2 form-group">
                                                        <p class="p-tag">Gender <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="gender" name="gender" required>
                                                                    <option value="">----</option>
                                                                    <option value="Male" {{(old('gender') == 'Male')? 'selected':''}}>Male</option>
                                                                    <option value="Female" {{(old('gender') == 'Female')? 'selected':''}}>Female</option>
                                                                    <option value="Other" {{(old('gender') == 'Other')? 'selected':''}}>Other</option>
                                                                </select>
                                                            <!-- </div> -->
                                                            @error('gender')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4 form-group">
                                                        <p class="p-tag">Date Of Birth <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('date_of_birth') is-invalid @enderror" placeholder="" id="date_of_birth" name="date_of_birth" type="date"  value="{{ old('date_of_birth') }}" required>
                                                            <!-- </div> -->
                                                            @error('date_of_birth')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2 form-group">
                                                        <p class="p-tag">Religion <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="religion" name="religion" required>
                                                                    <option value="">----</option>
                                                                    <option value="Muslim" {{(old('religion') == 'Muslim')? 'selected':''}}>Muslim</option>
                                                                    <option value="Hindu" {{(old('religion') == 'Hindu')? 'selected':''}}>Hindu</option>
                                                                    <option value="Buddhist" {{(old('religion') == 'Buddhist')? 'selected':''}}>Buddhist</option>
                                                                    <option value="Christian" {{(old('religion') == 'Christian')? 'selected':''}}>Christian</option>
                                                                    <option value="Other" {{(old('religion') == 'Other')? 'selected':''}}>Other</option>
                                                                </select>
                                                            <!-- </div> -->
                                                            @error('religion')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4 form-group">
                                                        <p class="p-tag">Mobile No <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('mobile_no') is-invalid @enderror" placeholder="" id="mobile_no" name="mobile_no" type="number"  value="{{ old('mobile_no') }}" required>
                                                            <!-- </div> -->
                                                            @error('mobile_no')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4 form-group">
                                                        <p class="p-tag">Email Address <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('email') is-invalid @enderror" placeholder="" id="email" name="email" type="text"  value="{{ old('email') }}" required>
                                                            <!-- </div> -->
                                                            @error('email')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2 form-group">
                                                        <p class="p-tag">Blood Group</p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="blood_group" name="blood_group">
                                                                <option value="">----</option>
                                                                    <option value="A+">A+</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="B-">B-</option>
                                                                    <option value="AB+">AB+</option>
                                                                    <option value="AB-">AB-</option>
                                                                    <option value="O+">O+</option>
                                                                    <option value="O-">O-</option>
                                                                </select>
                                                            <!-- </div> -->
                                                            @error('blood_group')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2 form-group">
                                                        <p class="p-tag">Joining Date <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('joining_date') is-invalid @enderror" placeholder="" id="joining_date" name="joining_date" type="date"  value="{{ old('joining_date') }}" required>
                                                            <!-- </div> -->
                                                            @error('joining_date')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4 form-group">
                                                        <p class="p-tag">Previous Institute</p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('previous_institute') is-invalid @enderror" placeholder="" id="previous_institute" name="previous_institute" type="text"  value="{{ old('previous_institute') }}">
                                                            <!-- </div> -->
                                                            @error('previous_institute')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4 form-group">
                                                        <p class="p-tag">Present Address <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('pressent_address') is-invalid @enderror" placeholder="" id="pressent_address" name="pressent_address" type="text"  value="{{ old('pressent_address') }}" required>
                                                            <!-- </div> -->
                                                            @error('pressent_address')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-4 form-group">
                                                        <p class="p-tag">Permanent Address <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('permanent_address') is-invalid @enderror" placeholder="" id="permanent_address" name="permanent_address" type="text"  value="{{ old('permanent_address') }}" required>
                                                            <!-- </div> -->
                                                            @error('permanent_address')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            <!-- /.tab-pane -->
                                            <div class="tab-pane" id="guardian-information">
                                            <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-3 form-group">
                                                        <p class="p-tag">Father's Name</p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('hr_father_name') is-invalid @enderror" placeholder="" id="hr_father_name" name="hr_father_name" type="text"  value="{{ old('hr_father_name') }}">
                                                            <!-- </div> -->
                                                            @error('hr_father_name')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-3 form-group">
                                                        <p class="p-tag">Mother's Name</p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('hr_mother_name') is-invalid @enderror" placeholder="" id="hr_mother_name" name="hr_mother_name" type="text"  value="{{ old('hr_mother_name') }}">
                                                            <!-- </div> -->
                                                            @error('hr_mother_name')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-3 form-group">
                                                        <p class="p-tag">Basic Salary <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('basic_salary') is-invalid @enderror" placeholder="" id="basic_salary" name="basic_salary" type="Number"  value="{{ old('basic_salary') }}" required>
                                                            <!-- </div> -->
                                                            @error('basic_salary')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-3 form-group">
                                                        <p class="p-tag">Provident Fund <span class="text-danger">*</span></p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('provident_fund') is-invalid @enderror" placeholder="Provident Fund" id="provident_fund" name="provident_fund" type="Number"  value="{{ old('provident_fund') }}" required>
                                                            <!-- </div> -->
                                                            @error('provident_fund')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-3 form-group">
                                                        <p class="p-tag">Coaching </p>
                                                            <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('coaching') is-invalid @enderror" placeholder="" id="coaching" name="coaching" type="Number"  value="{{ old('coaching') }}">
                                                            <!-- </div> -->
                                                            @error('coaching')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-3 form-group">
                                                        <!-- <label for="image" class="col-12 col-form-label">Image </label> -->
                                                        <p class="p-tag">Photo </p>
                                                            <!-- <div class="col-md-12 "> -->
                                                            <input class="form-control custom-focus" placeholder="" id="hr_photo" name="hr_photo" type="file" >
                                                            <!-- </div> -->
                                                            @error('hr_photo')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-3 form-group">
                                                        <p class="p-tag">Sign </p>
                                                        <!-- <label for="image" class="col-12 col-form-label">Sign <span class="text-danger">*</span></label>
                                                            <div class="col-md-12 "> -->
                                                            <input class="form-control custom-focus" placeholder="" id="hr_sign" name="hr_sign" type="file" >
                                                            <!-- </div> -->
                                                            @error('hr_sign')
                                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <div class="col-12 mt-3 mb-2 text-right">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(function () {
            $("#teamList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
