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
                                <h2 class="h2">Create Invoice for Test</h2>
                            </div>
                            <div class="card-body pb-0">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row mb-4">
                                            <div class="col-12 col-md-4">
                                                <p class="my-2"><strong>Patient ID
                                                        :</strong> {{ $patientData->patient->patient_id }} </p>
                                                <p class="my-2"><strong>Name
                                                        :</strong> {{ $patientData->patient->name }} </p>
                                                <p class="my-2"><strong>Gender
                                                        :</strong> {{ $patientData->patient->gender }} </p>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p class="my-2"><strong>Age :</strong> {{ $patientData->patient->age }}
                                                </p>
                                                <p class="my-2"><strong>Mobile
                                                        : </strong>{{ $patientData->patient->mobile }} </p>

                                            </div>
                                            <div class="col-12 col-md-4">
                                                <p class="my-2"><strong>Ref. By
                                                        : </strong>{{ $patientData->doctor->name }} </p>
                                                <p class="my-2"><strong>Patient Type
                                                        : </strong>{{ $patientData->patient->patient_type }} </p>
                                                <p class="my-2"><strong>Reference
                                                        : </strong>{{ $patientData->patient->reference }} </p>
                                            </div>
                                        </div>
                                        <hr style="border-color: #6c757d4a;">
                                    </div>
                                    <form action="{{ route('reception.payment.store') }}" method="POST">@csrf
                                        <div class="row">
                                            <div class="col-xl-9" style="border-right: 1px solid #6c757d4a;">
                                                <div style="min-height: 220px; padding: 00px; background:#fafafa;">
                                                    <table class="table table-bordered table-striped">
                                                        <thead
                                                            style="background-color: #0099ff; color: #fff; padding: 5px;">
                                                        <tr>
                                                            <th>Test Name</th>
                                                            <th>Charge</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$patientData->service->name}}</td>
                                                            <td><span class="taka-small">&#2547;</span>{{ number_format($patientData->service->price, 2) }}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div>
                                                <input type="hidden" name="customer[id]" value="{{ $patientData->patient->id }}">
                                                <input type="hidden" name="customer[name]" value="{{ $patientData->patient->name }}">
                                                <input type="hidden" name="customer[phone]" value="{{ $patientData->patient->mobile }}">
                                                <input type="hidden" name="services[0][primary_id]" value="{{ $patientData->service->id }}">
                                                <input type="hidden" name="services[0][name]" value="{{ $patientData->service->name }}">
                                                <input type="hidden" name="services[0][amount]" value="{{ $patientData->service->price }}">
                                                <input type="hidden" name="test_id" value="{{ $patientData->id }}">
                                            </div>

                                            <div class="col-xl-3" style="margin-bottom: 20px;">
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <div class="input-group mb-0 mr-sm-0">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text" style="width: 140px;">
                                                                    Total
                                                                </div>
                                                            </div>
                                                            <input
                                                                class="form-control text-success text-right font-weight-bold h6"
                                                                readonly type="text" required id="total"
                                                                name="total" value="{{ $patientData->service->price }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <div class="input-group mb-0 mr-sm-0">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text" style="width: 140px;">
                                                                    Discount %
                                                                </div>
                                                            </div>
                                                            <input type="number"
                                                                   class="form-control text-success text-right font-weight-bold"
                                                                   style="border-radius: 0;" id="discount"
                                                                   name="discount" value="{{  $discount ?? 0 }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 form-group">
                                                        <div class="input-group mb-0 mr-sm-0">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text pay" style="width: 140px; ">Payable</div>
                                                                <div class="input-group-text payh" style="width: 140px; display:none;">Payable</div>
                                                            </div>
                                                            <input
                                                                class="form-control text-success text-right font-weight-bold"
                                                                readonly type="text" id="payable" name="payable">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary add btn-block lidl mt-3" id="save">Save & Print Invoice</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(document).ready(function () {
            calculatePayable();
            jQuery('#discount').on('input', function () {
                calculatePayable();
            });
            function calculatePayable(){
                let total = $('#total').val();
                let discount = $('#discount').val();
                let payable = total - (total * discount / 100);
                if (isNaN(payable) || payable < 0) {
                    payable = 0;
                }
                $('#payable').val(payable);
            }
        });
    </script>
@endpush
