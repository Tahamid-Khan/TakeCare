@extends('layouts.app')
@section('mainContent')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    @if (isset($admin->id) && $admin->id != null)
                        <h2 class="h2 font-weight-bold">Edit User</h2>
                    @else
                        <h2 class="h2 font-weight-bold">Add New User</h2>
                    @endif

                </div>
                <div class="">
                    <div class="">
                        <!-- general form elements -->
                        <div class="card-body">
                            <!-- <div class="card-header">
                              <h3 class="card-title">User Information</h3>
                            </div> -->
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('admin.save') }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="row">


                                    <div class="col-md-4 col-xl-3 form-group">
                                        <label for="name" class="col-form-label">User Name <span class="m-l-5">
                                                *</span></label>
                                        <div class="">
                                            @if (isset($admin->id) && $admin->id != null)
                                                <input type="hidden" name="adminId" value="{{ $admin->id }}">
                                                <input class="form-control custom-focus @error('name') is-invalid @enderror"
                                                    placeholder="User name" id="name" name="name" type="text"
                                                    value="{{ $admin->name }}">
                                            @else
                                                <input class="form-control custom-focus @error('name') is-invalid @enderror"
                                                    placeholder="User name" id="name" name="name" type="text"
                                                    value="{{ old('name') }}">
                                            @endif
                                        </div>
                                        @error('name')
                                            <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-xl-3 form-group">
                                        <label class="control-label" for="name">Email <span class="m-l-5">
                                                *</span></label>
                                        @if (isset($admin->id) && $admin->id != null)
                                            <input class="form-control custom-focus @error('email') is-invalid @enderror"
                                                placeholder="Email" id="email" name="email" type="text"
                                                value="{{ $admin->email }}" required="required">
                                        @else
                                            <input class="form-control custom-focus @error('email') is-invalid @enderror"
                                                placeholder="Email" id="email" name="email" type="text"
                                                value="{{ old('email') }}" required="required">
                                        @endif
                                        @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-xl-3 form-group">
                                        <label class="control-label" for="name">Image <span class="m-l-5">
                                            </span></label>
                                        @if (isset($admin->id) && $admin->id != null)
                                            <input class="form-control custom-focus " placeholder="Image" id="image"
                                                name="image" type="file">
                                        @else
                                            <input class="form-control custom-focus" placeholder="Image" id="image"
                                                name="image" type="file">
                                        @endif
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-xl-3 form-group">
                                        @if (isset($admin->id) && $admin->id != null)
                                            <label class="control-label" for="name">Password <span class="m-l-5">
                                                </span></label>
                                        @else
                                            <label class="control-label" for="name">Password <span class="m-l-5">
                                                    *</span></label>
                                        @endif
                                        @if (isset($admin->id) && $admin->id != null)
                                            <input class="form-control custom-focus @error('password') is-invalid @enderror"
                                                placeholder="Password" id="password" name="password" type="text">
                                        @else
                                            <input class="form-control custom-focus @error('password') is-invalid @enderror"
                                                placeholder="password" id="password" name="password" type="text"
                                                required="required">
                                        @endif
                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- User Type --}}
                                    <div class="col-md-4 col-xl-3 form-group">
                                        <label class="control-label" for="name">User Type <span class="m-l-5">
                                                *</span></label>
                                        <select class="form-control custom-focus @error('user_type') is-invalid @enderror"
                                            name="user_type" id="user_type">
                                            <option value="">Select User Type</option>
                                            @foreach($userTypes as $item)
                                                <option class="text-capitalize" value="{{ $item }}" @if (isset($admin->user_type) && $admin->user_type == $item) selected @endif>{{ $item }}</option>
                                            @endforeach

                                        </select>
                                        @error('user_type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-4 col-xl-3 form-group">
                                        <label class="control-label" for="name">Status <span class="m-l-5">
                                                *</span></label>
                                        <select class="form-control custom-focus @error('status') is-invalid @enderror"
                                            name="status" id="status">
                                            <option value="">Select Status</option>
                                            <option value="1" @if (isset($admin->status) && $admin->status == '1') selected @endif>Active
                                            </option>
                                            <option value="0" @if (isset($admin->status) && $admin->status == '0') selected @endif>Inactive
                                            </option>
                                        </select>
                                        @error('status')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>


                                </div>
                                <!-- /.card-body -->

                                <div class="">
                                    <button type="submit" class="btn btn-secondary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
