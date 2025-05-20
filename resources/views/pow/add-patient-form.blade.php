@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Book POW Seat</h3>
                            </div>


                            <div class="container mt-4">
                                <form action="{{ route('pow.add-patient') }}" method="POST">@csrf

                                    <div class="row">
                                        <input type="text" hidden value="{{ $operationData->id }}" name="operation_id">
                                        <input type="text" hidden value="{{ $operationData->patient->id }}"
                                            name="patient_id">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="patient-id">Patient ID</label>
                                            <input type="text" disabled class="form-control" id="patient-id"
                                                value="{{ $operationData->patient->patient_id }}">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="bed-no">Bed No*</label>
                                            <select class="form-control" id="bed-no" name="bed_no">
                                                <option selected disabled>Please Select</option>
                                                @foreach ($beds as $item)
                                                    <option value="{{ $item->id }}">{{ $item->bed_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="assign-doctor">Assign Doctor*</label>
                                            <select class="form-control" id="assign-doctor" name="doctor_id">
                                                <option selected disabled>Please Select</option>
                                                @foreach ($doctors as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div>
                                        <div id="material-section">
                                            <div class="form-row align-items-center">
                                                <div class="col-12 col-md-4">
                                                    <h6 class="h6"><strong>Required Materials</strong></h6>
                                                </div>
                                            </div>

                                            <div class="form-row align-items-center mb-3">
                                                <div class="col-10 col-md-4 mb-2">
                                                    <input type="text" class="form-control item-name" id="item-name-0"
                                                        name="material[0][name]" placeholder="Materials Needed">
                                                </div>

                                                <div class="col-2 mb-2">
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="removeItem(this)">&times;</button>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mb-4">
                                            <div id="material-details">
                                                <!-- Dynamic list of material will be displayed here -->
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-info mb-4" onclick="addItem()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
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

        let itemIndex = 1;

        function addItem() {
            let item = `
            <div class="form-row align-items-center mb-3">
                <div class="col-10 col-md-4 mb-2">
                    <input type="text" class="form-control item-name" id="item-name-${itemIndex}" name="meterial[${itemIndex}][name]" placeholder="Materials Needed">
                </div>

                <div class="col-2 mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">&times;</button>
                </div>
            </div>
        `;
            $('#material-details').append(item);
            itemIndex++;
        }

        function removeItem(e) {
            $(e).parent().parent().remove();
        }
    </script>
@endpush
