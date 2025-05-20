@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">Edit Employee</h3>
                            </div>
                            <form action="{{ route('employee.update', $employee->id) }}" class="p-2" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-2 form-group">
                                                        <p class="p-tag">Employee ID <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus "
                                                             type="text"
                                                            value="{{ $employee->emp_id }}" disabled>
                                                        <!-- </div> -->

                                                    </div>
                                                    <div class="col-4 form-group">
                                                        <p class="p-tag">Employee/Staff's Name <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus @error('name') is-invalid @enderror"
                                                            placeholder="" id="name" name="name" type="text"
                                                            value="{{ $employee->name }}" required>
                                                        <!-- </div> -->
                                                        @error('name')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 form-group">
                                                        <p class="p-tag">Department <span class="text-danger">*</span></p>
                                                        <select class="form-control" id="department_id" name="department_id" required>
                                                            <option value="">----</option>
                                                            @if(isset($department))
                                                                @foreach($department as $list)
                                                                    <option value="{{ $list->id }}" {{ $employee->department_id == $list->id ? 'selected' : '' }}>
                                                                        {{ $list->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('department_id')
                                                        <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <div class="col-2 form-group">
                                                        <p class="p-tag">Gender <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <select class="form-control" id="gender" name="gender" required>
                                                            <option value="">----</option>
                                                            <option value="Male" {{ $employee->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                            <option value="Female" {{ $employee->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                            <option value="Other" {{ $employee->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                                        </select>
                                                        <!-- </div> -->
                                                        @error('gender')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-2 form-group">
                                                        <p class="p-tag">Age <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->

                                                        <input
                                                            class="form-control custom-focus @error('age') is-invalid @enderror"
                                                            placeholder="" id="age" name="age" type="text"
                                                            value="{{ $employee->age }}" required>
                                                        <!-- </div> -->
                                                        @error('age')
                                                        <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-2 form-group">
                                                        <p class="p-tag">Religion <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <select class="form-control" id="religion"
                                                                name="religion" required>
                                                            <option value="">----</option>
                                                            <option value="Muslim" {{ $employee->religion == 'Muslim' ? 'selected' : '' }}>Islam</option>
                                                            <option value="Hindu" {{ $employee->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                            <option value="Christian" {{ $employee->religion == 'Christian' ? 'selected' : '' }}>Christian</option>
                                                            <option value="Buddhist" {{ $employee->religion == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                                                            <option value="Other" {{ $employee->religion == 'Other' ? 'selected' : '' }}>Other</option>
                                                        </select>
                                                        <!-- </div> -->
                                                        @error('religion')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 form-group">
                                                        <p class="p-tag">Date Of Birth <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus @error('date_of_birth') is-invalid @enderror"
                                                            placeholder="" id="date_of_birth"
                                                            name="date_of_birth" type="date"
                                                            value="{{ $employee->date_of_birth }}" required>
                                                        <!-- </div> -->
                                                        @error('date_of_birth')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-3 form-group">
                                                        <p class="p-tag">Mobile No <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus @error('mobile_no') is-invalid @enderror"
                                                            placeholder="" id="mobile_no" name="mobile_no"
                                                            type="number" value="{{ $employee->mobile_no }}"
                                                            required>
                                                        <!-- </div> -->
                                                        @error('mobile_no')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3 form-group">
                                                        <p class="p-tag">Email Address <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus @error('email') is-invalid @enderror"
                                                            placeholder="" id="email" name="email" type="text"
                                                            value="{{ $employee->email }}" required>
                                                        <!-- </div> -->
                                                        @error('email')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-2 form-group">
                                                        <p class="p-tag">Shift Time <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <select class="form-control" id="shift_time"
                                                                name="shift_time" required>
                                                            <option value="">----</option>
                                                            <option value="morning" {{ $employee->shift == 'morning' ? 'selected' : '' }}>Morning</option>
                                                            <option value="evening" {{ $employee->shift == 'evening' ? 'selected' : '' }}>Evening</option>
                                                            <option value="night" {{ $employee->shift == 'night' ? 'selected' : '' }}>Night</option>
                                                        </select>
                                                        <!-- </div> -->
                                                        @error('shift_time')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-3 form-group">
                                                        <p class="p-tag">Account Number </p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus @error('account_no') is-invalid @enderror"
                                                            placeholder="Account Number" id="account_no" name="account_no"
                                                            type="number" value="{{ $employee->account_no }}"
                                                            >
                                                        <!-- </div> -->
                                                        @error('account_no')
                                                        <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-3 form-group">
                                                        <p class="p-tag">Present Work Position <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus @error('present_work_position') is-invalid @enderror"
                                                            placeholder="" id="present_work_position" name="present_work_position"
                                                            type="text" value="{{ $employee->present_work_position }}"
                                                            required>
                                                        <!-- </div> -->
                                                        @error('present_work_position')
                                                        <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-2 form-group">
                                                        <p class="p-tag">Blood Group</p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <select class="form-control" id="blood_group"
                                                                name="blood_group">
                                                            <option value="">----</option>
                                                            <option value="A+" {{ $employee->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                                            <option value="A-" {{ $employee->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                                            <option value="B+" {{ $employee->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                                            <option value="B-" {{ $employee->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                                            <option value="AB+" {{ $employee->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                            <option value="AB-" {{ $employee->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                                            <option value="O+" {{ $employee->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                                            <option value="O-" {{ $employee->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                                        </select>
                                                        <!-- </div> -->
                                                        @error('blood_group')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    <div class="col-4 form-group">
                                                        <p class="p-tag">Address <span
                                                                class="text-danger">*</span></p>
                                                        <textarea
                                                            class="form-control custom-focus @error('address') is-invalid @enderror"
                                                            placeholder="" id="address" name="address"
                                                            type="text">{{ $employee->address }}
                                                        </textarea>
                                                        @error('address')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-4 form-group">
                                                        <p class="p-tag">Employee Showcases <span
                                                                class="text-danger">*</span></p>
                                                        <textarea
                                                            class="form-control custom-focus @error('showcases') is-invalid @enderror"
                                                            placeholder="" id="showcases"
                                                            name="showcases"
                                                            type="text">{{ $employee->showcases }}
                                                        </textarea>
                                                        @error('showcases')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-4 form-group">
                                                        <p class="p-tag">Summery</p>
                                                        <textarea
                                                            class="form-control custom-focus @error('summery') is-invalid @enderror"
                                                            placeholder="" id="summery" name="summery"
                                                            type="text">{{ $employee->summery }}
                                                        </textarea>
                                                        @error('summery')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-3 form-group">
                                                        <p class="p-tag">Basic Salary <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus @error('basic_salary') is-invalid @enderror"
                                                            placeholder="" id="basic_salary"
                                                            name="basic_salary" type="Number"
                                                            value="{{ $employee->basic_salary }}"
                                                            required>
                                                        <!-- </div> -->
                                                        @error('basic_salary')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3 form-group">
                                                        <p class="p-tag">Salary Scale<span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input
                                                            class="form-control custom-focus @error('salary_scale') is-invalid @enderror"
                                                            placeholder="" id="salary_scale"
                                                            name="salary_scale" type="text"
                                                            value="{{ $employee->salary_scale }}"
                                                            required>
                                                        <!-- </div> -->
                                                        @error('salary_scale')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3 form-group">
                                                        <p class="p-tag">Employee Type <span
                                                                class="text-danger">*</span></p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <select class="form-control" id="type"
                                                                name="type" required>
                                                            <option value="">----</option>
                                                            <option value="Permanent" {{ $employee->type == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                                                            <option value="Temporary" {{ $employee->type == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                                                        </select>
                                                        <!-- </div> -->
                                                        @error('type')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-3 form-group">
                                                        <!-- <label for="image" class="col-12 col-form-label">Image </label> -->
                                                        <p class="p-tag">Photo </p>
                                                        <!-- <div class="col-md-12 "> -->
                                                        <input class="form-control custom-focus"
                                                               placeholder="" id="photo" name="photo"
                                                               type="file">
                                                        <!-- </div> -->
                                                        @error('photo')
                                                        <span
                                                            class="text-success ml-3 mt-1">{{ $message }}</span>
                                                        @enderror
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

    <script>
        $(document).ready(function () {
            // Handle change event on the department dropdown
            $('#department_id').change(function () {
                // Get the selected department ID
                var selectedDepartmentId = $(this).val();

                // Make an AJAX request to retrieve limit_emp and total_emp for the selected department
                $.ajax({
                    url: '/getDepartmentInfo/' + selectedDepartmentId,
                    type: 'GET',
                    success: function (data) {
                        var availableEmployees = data.limit_emp - data.total_emp;

                        // Update the text line with the available employees information
                        $('#departmentText').text('Available employees: ' + availableEmployees);
                    },
                    error: function (xhr, status, error) {
                        // Handle error if any
                        // console.log('Error fetching department information');
                        // console.log(xhr.responseText); // Log the detailed error response
                    }
                });
            });
        });
    </script>
@endpush
