@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">Search Patient</h3>
                            </div>
                            <form action="{{ route('icu.add-form') }}" method="GET">
                                <div class="row align-items-center m-4">

                                    <div class="form-group col-12 col-md-5">
                                        <label for="searchById">Patient ID</label>
                                        <input type="text" name="patient_id" class="form-control" id="searchById"
                                               placeholder="Enter Patient ID">
                                    </div>
                                    <div class="text-center mx-2">OR</div>
                                    <div class="form-group col-12 col-md-5">
                                        <label for="searchByPhoneNumber">Phone Number</label>
                                        <input type="text" name="mobile" class="form-control" id="searchByPhoneNumber"
                                               placeholder="Enter Phone Number">
                                    </div>
                                </div>
                                <div class="m-4"><button type="submit" class="btn btn-primary">Find</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
