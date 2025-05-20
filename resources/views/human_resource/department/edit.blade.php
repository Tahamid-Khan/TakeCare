@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h2 class="h2 font-weight-bold">Update Department</h2>
                </div>
                <form action="{{ route('department.update') }}" class="p-2" method="post"  enctype="multipart/form-data">@csrf
                    <input type="hidden" name="id" value="{{$lists->id}}">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content shampan-heading">
                                    <div class="active tab-pane" id="general-information">
                                        <!-- Post -->
                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="col-12 col-md-3 form-group">
                                                    <p class="p-tag"> Name <span
                                                            class="text-danger">*</span></p>
                                                    <!-- <div class="col-md-12 "> -->
                                                    <input
                                                        class="form-control custom-focus @error('name') is-invalid @enderror"
                                                        placeholder="Department Name" id="name" name="name"
                                                        type="text"
                                                        value="{{old('name')?old('name'):$lists->name}}"
                                                        required>
                                                    <!-- </div> -->
                                                    @error('name')
                                                    <span
                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-md-3 form-group">
                                                    <p class="p-tag">Max Employee <span class="text-danger">*</span>
                                                    </p>
                                                    <!-- <div class="col-md-12 "> -->
                                                    <input class="form-control custom-focus"
                                                           placeholder="Max Employee" id="limit_emp"
                                                           name="limit_emp" type="number"
                                                           value="{{old('limit_emp')?old('limit_emp'):$lists->limit_emp}}">
                                                    <!-- </div> -->
                                                </div>
                                                <div class="col-12 col-md-3 form-group">
                                                    <p class="p-tag">Status <span
                                                            class="text-danger">*</span></p>
                                                    <!-- <div class="col-md-12 "> -->
                                                    <select class="form-control" id="status" name="status"
                                                            required>
                                                        <option
                                                            value="" {{($lists->status == '')? 'selected':''}}>
                                                            -----
                                                        </option>
                                                        <option
                                                            value="1" {{($lists->status == '1')? 'selected':''}}>
                                                            On
                                                        </option>
                                                        <option
                                                            value="0" {{($lists->status == '0')? 'selected':''}}>
                                                            Off
                                                        </option>
                                                    </select>
                                                    <!-- </div> -->
                                                    @error('designation')
                                                    <span
                                                        class="text-success ml-3 mt-1">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!--Telephone Number-->
                                                <div class="col-12 col-md-3 form-group">
                                                    <p class="p-tag">Phone Number
                                                        <span class="text-danger">*</span></p>
                                                    <!-- <div class="col-md-12 "> -->
                                                    <input
                                                        class="form-control custom-focus @error('telephone_number') is-invalid @enderror"
                                                        placeholder="Telephone Number" id="telephone_number"
                                                        name="phone_number" type="text"
                                                        value="{{old('phone_number')?old('phone_number'):$lists->phone_number}}"
                                                        required>
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
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
