@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h2 font-weight-bold">Add Department</h2>
                            </div>
                            <form action="{{ route('department.store') }}" class="p-2" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content shampan-heading">
                                                <div class="active tab-pane" id="general-information">
                                                    <!-- Post -->
                                                    <div class="col-md-12">
                                                        <div class="row">

                                                            <div class="col-12 col-md-4 form-group">
                                                                <p class="p-tag"> Name <span
                                                                        class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('name') is-invalid @enderror"
                                                                    placeholder="Department Name" id="name" name="name"
                                                                    type="text" value="{{ old('name') }}" required>
                                                                <!-- </div> -->
                                                                @error('name')
                                                                <span
                                                                    class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12 col-md-4 form-group">
                                                                <p class="p-tag">Max Employee <span class="text-danger">*</span>
                                                                </p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus"
                                                                       placeholder="Max Employee" id="limit_emp"
                                                                       name="limit_emp" type="number"
                                                                       value="{{ old('limit_emp') }}" required>
                                                                <!-- </div> -->
                                                            </div>

                                                            <!--Telephone Number-->
                                                            <div class="col-12 col-md-4 form-group">
                                                                <p class="p-tag">Phone Number
                                                                    <span class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input
                                                                    class="form-control custom-focus @error('telephone_number') is-invalid @enderror"
                                                                    placeholder="Telephone Number" id="telephone_number"
                                                                    name="phone_number" type="text"
                                                                    value="{{ old('telephone_number') }}" required>
                                                                <!-- </div> -->
                                                                @error('telephone_number')
                                                                <span
                                                                    class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mt-3 mb-2 text-right">
                                                    <button type="submit" class="btn btn-primary">Add</button>
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
