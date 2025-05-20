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
                                <h3 class="card-title">ADD</h3>
                            </div>


                            <div class="container mt-4">
                                <form action="" method="POST">@csrf
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="select">Select</label>
                                            <select class="form-control" id="select" name="select">
                                                <option selected disabled>Please Select</option>
                                                <option value="select1">select1</option>
                                                <option value="select2">select2</option>
                                                <option value="select3">select3</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="Number">Number</label>
                                            <input type="text" class="form-control" id="Number" name="Number">
                                        </div>

                                        <div class="col-lg-3 col-md-4 col-sm-12 form-group">
                                            <label for="textarea">Textarea</label>
                                            <textarea class="form-control" id="textarea" name="textarea"></textarea>
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
