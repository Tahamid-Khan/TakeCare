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
                                <h3 class="h3">Test Details</h3>
                            </div>
                            <form action="{{ route('radiology.updateTestStatus', $test->id) }}" class="p-2" method="POST">@csrf
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-4 form-group">
                                                    <label for="date">Date</label>
                                                    <input type="date" class="form-control" id="date"
                                                           value="{{ \Carbon\Carbon::now()->toDateString() }}" readonly>
                                                </div>

                                                <!--Patient ID-->
                                                <div class="col-12 col-md-4 form-group">
                                                    <label for="patient_id">Patient ID</label>
                                                    <input type="text" class="form-control" id="patient_id"
                                                            value="{{ $test->patient->patient_id }}" readonly>
                                                </div>

                                                <!--Test Name-->
                                                <div class="col-12 col-md-4 form-group">
                                                    <label for="test_name">Test Name</label>
                                                    <input type="text" class="form-control" id="test_name"
                                                          value="{{ $test->service->name }}" readonly>
                                                </div>

                                                <!--Delivery Date-->
                                                <div class="col-12 col-md-4 form-group">
                                                    <label for="delivery_date">Delivery Date</label>
                                                    <input type="date" class="form-control" id="delivery_date"
                                                           name="delivery_date" value="" required>
                                                </div>


                                                <!--Remarks-->
                                                <div class="col-12 col-md-4 form-group">
                                                    <label for="remarks">Remarks</label>
                                                    <input type="text" class="form-control" id="remarks" name="remarks"
                                                           value="" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mt-3 mb-2 text-right">
                                                    <button type="submit" class="btn btn-primary">Mark As Complete
                                                    </button>
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
