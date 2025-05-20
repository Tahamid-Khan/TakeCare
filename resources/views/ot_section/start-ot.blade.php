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
                                <h3 class="h3">Start OT</h3>
                            </div>

                            @php
                            $errors = Session::get('errors');
                            if ($errors && $errors->first('anesthesia_time'))
                                {
                                    Alert::toast("Anesthesia time must be after Operation start time", 'error');
                                }
                            @endphp

                            <div class="container mt-4">
                                <form action="{{ route('ot.end', ['id'=>$operationData->id ]) }}" method="POST">@csrf

                                    <div class="row">

                                        <input type="text" hidden value="{{ $operationData->patient->id }}"
                                               name="patient_id">

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="patient-id">Patient ID</label>
                                            <input type="text" disabled class="form-control" id="patient-id"
                                                   value="{{ $operationData->patient->patient_id }}">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="start-time">Operation Start Time*</label>
                                            <input type="time" class="form-control" id="start-time" name="start_time"
                                                   value="{{ $operationData->operation_start_time }}">
                                            {{--                                            <input type="text" class="form-control" id="start-time" name="start_time" readonly>--}}
                                        </div>


                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="anesthesia-time">Anesthesia Given At*</label>
                                            <input type="time" class="form-control" id="anesthesia-time"
                                                   value="{{ old('anesthesia_time','')}}"
                                                   name="anesthesia_time">
                                        </div>


                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="end-time">Operation End Time*</label>
                                            {{--                                            <input type="time" class="form-control" id="end-time" name="end_time" readonly>--}}
                                            <input type="text" class="form-control"
                                                   placeholder="End Time will be set upon operation conclusion"
                                                   readonly>
                                        </div>


                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea class="form-control" id="remarks" name="remarks"
                                                      rows="3">{{ old('remarks','') }}</textarea>
                                        </div>
                                    </div>

                                    <div>
                                        <div id="material-section">
                                            <div class="form-row align-items-center">
                                                <div class="col-12 col-md-4">
                                                    <h6 class="h6"><strong>Materials Used in OT</strong></h6>
                                                </div>
                                            </div>

                                            <div class="form-row align-items-center mb-3">
                                                <div class="col-10 col-md-4 mb-2">
                                                    <input type="text" class="form-control item-name" id="item-name-0"
                                                           name="material_used[0][name]" placeholder="Materials Used">
                                                </div>

                                                <div class="col-2 mb-2">
                                                    <button type="button" class="btn btn-danger"
                                                            onclick="removeItem(this)">&times;
                                                    </button>
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


                                    <div >
                                        <div id="manual-service-section">
                                            <div class="form-row align-items-center mb-3">
                                                <div class="col-12 col-md-2 mb-2">
                                                    <label for="" class="">Manual Service Name</label>
                                                </div>


                                                <div class="col-12 col-md-2 mb-2">
                                                    <label for="" class="">Amount</label>
                                                </div>
                                                <div class="col-12 col-md-2 mb-2">
                                                </div>
                                            </div>
                                            <div class="form-row align-items-center mb-3">
                                                <div class="col-12 col-md-2 mb-2">
                                                    <input type="text" class="form-control manual-item-name" id="manual-item-name-0"
                                                           name="manual_services[0][name]" placeholder="Service Name">
                                                </div>



                                                <div class="col-12 col-md-2 mb-2">
                                                    <input type="number" class="form-control" id="manual-amount-0"
                                                           name="manual_services[0][amount]" placeholder="Amount">
                                                </div>

                                                <div class="col-12 col-md-2 mb-2">
                                                    <button type="button" class="btn btn-danger" onclick="removeManualItem(this)">
                                                        &times;
                                                    </button>
                                                </div>

                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-primary mb-4" onclick="addManualItem()"><i class="fas fa-plus"></i></button>

                                        <div class="mb-4">
                                            <div id="manual-invoice-details">
                                                <!-- Dynamic list of manual services will be displayed here -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-primary">Conclude</button>
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
    {{-- <script>
        $(function() {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script> --}}

    <script>
        let manualItemCount = 1;
        function addManualItem() {
            const itemContainer = document.createElement('div');
            itemContainer.classList.add('form-row', 'align-items-center', 'mb-3');
            itemContainer.innerHTML = `
                <div class="col-12 col-md-2 mb-2">
                    <input type="text" class="form-control manual-item-name" id="manual-item-name-${manualItemCount}" name="manual_services[${manualItemCount}][name]" placeholder="Service Name">
                </div>



        <div class="col-12 col-md-2 mb-2">
            <input type="number" class="form-control" id="manual-amount-${manualItemCount}" name="manual_services[${manualItemCount}][amount]" placeholder="Amount">
                </div>

                <div class="col-12 col-md-2 mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeManualItem(this)">
                        &times;
                    </button>
                </div>`;
            document.getElementById('manual-service-section').appendChild(itemContainer);
            manualItemCount++;
            calculateTotal();
        }
        // Remove item and recalculate total
        function removeManualItem(button) {
            button.closest('.form-row').remove();
            calculateTotal();
        }


        let itemIndex = 1;

        function addItem() {
            let item = `
                <div class="form-row align-items-center mb-3">
                    <div class="col-10 col-md-4 mb-2">
                        <input type="text" class="form-control item-name" id="item-name-${itemIndex}" name="material_used[${itemIndex}][name]" placeholder="Materials Used">
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
