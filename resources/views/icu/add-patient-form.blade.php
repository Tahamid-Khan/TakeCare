@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">Admit Patient to ICU/HDU</h3>
                            </div>


                            <div class="card-body">
                                <form action="{{route('icu.add-patient')}}" method="POST">@csrf
                                    <div class="row">
                                        <input type="text" hidden   value="{{ $patientData->id }}" name="patient_id">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="patient-id">Patient ID</label>
                                            <input type="text" disabled class="form-control" id="patient-id" value="{{ $patientData->patient_id }}">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="phone">Phone No</label>
                                            <input type="text" disabled class="form-control" id="phone" value="{{ $patientData->mobile }}">
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="icu-hdu">Location*</label>
                                            <select required class="form-control" id="icu-hdu" name="isICU">
                                                <option selected disabled>Please Select</option>
                                                <option value="1">ICU</option>
                                                <option value="0">HDU</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="bed-no">Bed No*</label>
                                            <select required class="form-control" id="bed-no" name="bed_no">
                                                <option selected disabled>Please Select</option>
                                                @foreach($beds as $item)
                                                <option value="{{ $item->id }}">{{ $item->bed_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="assign-doctor">Assign Doctor*</label>
                                            <select required class="form-control" id="assign-doctor" name="assign_doctor">
                                                <option selected disabled>Please Select</option>
                                                @foreach($doctors as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

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
{{-- @push('custom_js')
    <script>
        $(function() {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush --}}
