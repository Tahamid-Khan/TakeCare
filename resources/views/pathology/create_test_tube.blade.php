@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Test Tube</h3>
                            </div>
                            <form action="{{ route('test.tube.store') }}" class="p-2" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content shampan-heading">
                                                <div class="active tab-pane" id="general-information">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3 form-group">
                                                                <select class="form-control" name="patient_id" id="patient_id" autofocus>
                                                                    <option value="" selected disabled hidden>Patient ID</option>
                                                                    @foreach($patients as $patient)
                                                                        <option value="{{ $patient->id }}">{{ $patient->patient_id }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3 form-group">
                                                                <select class="form-control" name="pathologys_id" id="pathology_id" autofocus>
                                                                    <option value="" selected disabled hidden>Pathology ID</option>
                                                                    @foreach($pathologys as $pathology)
                                                                        <option class="patient-{{ $pathology->patient_id }}" value="{{ $pathology->id }}" style="display: none;">{{ $pathology->pathology_id }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3 form-group">
                                                                <select class="form-control" name="test_list_name" id="test_list_id" autofocus>
                                                                    <option value="" selected disabled hidden>Test Name</option>
                                                                    @foreach($pathologys as $p)
                                                                    @php
                                                                        $testListDetails = json_decode($p->test_list_details);
                                                                    @endphp
                                                                    @foreach ($testListDetails as $test)
                                                                    <option class="testlist-{{ $p->id }}" value="{{ $test->name }}" style="display: none;">{{ $test->name }}</option>
                                                                    @endforeach
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" name="tube_id"  id="tube_id" class="form-control" placeholder="Test Tube Id" required />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12 mt-3 mb-2 text-right">
                                                <button type="submit" class="btn btn-primary">Create</button>
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

<script>
    $(document).ready(function () {
        // On change of patient_id
        $('#patient_id').on('change', function () {
            var selectedPatientId = $(this).val();

            // Hide all pathology_id options
            $('#pathology_id option').hide();

            // Show only the options related to the selected patient_id
            $('.patient-' + selectedPatientId).show();
            
        });
        //$('#test_list_id option').hide();
        // On change of pathology_id
        $('#pathology_id').on('change', function () {
            var selectedPathologyId = $(this).val();

            // Hide all test_list_id options
          //  $('#test_list_id option').hide();

            // Show only the options related to the selected pathology_id
            $('.testlist-' + selectedPathologyId).show();
            
        });
    });
</script>


@endpush
