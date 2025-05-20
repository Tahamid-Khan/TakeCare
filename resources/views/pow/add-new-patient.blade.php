@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3 class="card-title">Search Patient</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('pow.add-form') }}" method="GET">

                                    <div class="form-group">
                                        <label for="searchById">Patient ID</label>
                                        <input type="text" name="patient_id" class="form-control" id="searchById"
                                               placeholder="Enter Patient ID">
                                    </div>
                                    <div class="text-center">OR</div>
                                    <div class="form-group">
                                        <label for="searchByPhoneNumber">Phone Number</label>
                                        <input type="text" name="mobile" class="form-control" id="searchByPhoneNumber"
                                               placeholder="Enter Phone Number">
                                    </div>
                                     <button type="submit" class="btn btn-primary float-right">Find</button>
{{--                                    <a href=" {{ route('icu.add-form') }}" class="btn btn-primary float-right">Find</a>--}}
                                    {{-- <a href=" {{ route('add') }}" class="btn btn-primary">Add</a>--}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
