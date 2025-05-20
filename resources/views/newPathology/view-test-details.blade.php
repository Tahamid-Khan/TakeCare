@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="row justify-content-between align-items-center px-4 py-2">
                                <h3 class="h3">Test Details</h3>

                                <div class="mr-2">
                                    <div class="row align-items-end pl-3">
                                        <!--Test ID-->
{{--                                        <div class="form-group">--}}
{{--                                            <div>{!! DNS1D::getBarcodeSVG ("$test->id", 'C39', 1) !!}</div>--}}
{{--                                        </div>--}}

                                        <!--Print Sticker Button-->
{{--                                        <div class="form-group ml-3">--}}
{{--                                            <button type="button" class="btn btn-success"--}}
{{--                                                    id="print_sticker">Print Sticker--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="card p-4">
                                <div class="row mb-4">
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>Patient ID
                                                :</strong> {{ $test->patient->patient_id }} </p>
                                        <p class="my-2"><strong>Name
                                                :</strong> {{ $test->patient->name }} </p>
                                        <p class="my-2"><strong>Gender
                                                :</strong> {{ $test->patient->gender }} </p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>Age :</strong> {{ $test->patient->age }} yrs old
                                        </p>
                                        <p class="my-2"><strong>Mobile
                                                : </strong>{{ $test->patient->mobile }} </p>
                                        <p class="my-2"><strong>Ref. Doctor
                                                : </strong> {{ $test->doctor->name ?? '' }} </p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <p class="my-2"><strong>Patient Type
                                                : </strong>{{ $test->patient->patient_type }} </p>
                                        <p class="my-2"><strong>Reference
                                                : </strong>{{ $test->patient->reference }} </p>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('pathology.updateTestStatus', $test->id) }}" class="p-2"
                                  method="POST">@csrf
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
                                                    <textarea class="form-control" id="remarks" name="remarks"
                                                              rows="3"></textarea>
                                                </div>

                                            </div>

                                            <div class="my-4">
                                                <div id="material-section">
                                                    <div class="form-row align-items-center mb-3">
                                                        <div class="col-6 col-md-2 mb-2">
                                                            <label for="" class="">Material Name</label>
                                                        </div>

                                                        <div class="col-3 col-md-2 mb-2">
                                                            <label for="" class="">ID</label>
                                                        </div>
                                                        <div class="col-12 col-md-2 mb-2">
                                                        </div>
                                                    </div>
                                                    <div class="form-row align-items-center mb-3">
                                                        <div class="col-12 col-md-2 mb-2">
                                                            {{--                                                            <input type="text" class="form-control material-name" id="material-name-0"--}}
                                                            {{--                                                                   name="materials[0][name]" placeholder="Material Name">--}}
                                                            <select class="form-control material-name"
                                                                    id="material-name-0"
                                                                    name="materials[0][name]" required>
                                                                <option value="">Select Material</option>
                                                                <option value="test_tube">Test Tube</option>
                                                                <option value="glass_slide">Glass Slide</option>
                                                                <option value="sample_container">Sample Container
                                                                </option>
                                                                <option value="swab">Swab</option>
                                                                <option value="biopsy_needle">Biopsy Needle</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 col-md-2 mb-2">
                                                            <input type="text" class="form-control" id="id-0"
                                                                   name="materials[0][id]"
                                                                   placeholder="ID">
                                                        </div>
                                                        <div class="col-12 col-md-2 mb-2">
                                                            <button type="button" class="btn btn-danger"
                                                                    onclick="removeItem(this)">
                                                                &times;
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary mb-4"
                                                        onclick="addMaterial()">
                                                    <i class="fa fa-plus"></i>
                                                </button>

                                                <div class="mb-4">
                                                    <div id="material-details">
                                                        <!-- Dynamic list of material will be displayed here -->
                                                    </div>
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
@push('custom_js')
    <script>
        $('#print_sticker').click(function () {
            let test_id = '{{ $test->test_id }}';
            $.ajax({
                url: '{{ url('print-sticker') }}/' + test_id,
                type: 'GET',
                success: function (response) {
                    window.open(response.url, '_blank');
                },
                error: function (error) {
                    // console.log(error);
                }
            });
        });
    </script>

    <script>
        let materialCount = 1;

        function addMaterial() {
            let materialSection = document.getElementById('material-section');
            let material = document.createElement('div');
            material.className = 'form-row align-items-center mb-3';
            material.innerHTML = `
                <div class="col-12 col-md-2 mb-2">
                    <select class="form-control material-name" id="material-name-${materialCount}"
                            name="materials[${materialCount}][name]" required>
                        <option value="">Select Material</option>
                        <option value="Test Tube">Test Tube</option>
                        <option value="Glass Slide">Glass Slide</option>
                        <option value="Sample Container">Sample Container</option>
                        <option value="Swab">Swab</option>
                        <option value="Biopsy Needle">Biopsy Needle</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 mb-2">
                    <input type="text" class="form-control" id="id-${materialCount}" name="materials[${materialCount}][id]"
                           placeholder="ID">
                </div>
                <div class="col-12 col-md-2 mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                        &times;
                    </button>
                </div>
            `;
            materialSection.appendChild(material);
            materialCount++;
        }

        function removeItem(item) {
            item.parentElement.parentElement.remove();
        }
    </script>
@endpush
