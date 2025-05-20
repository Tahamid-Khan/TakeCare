@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <div class="card-header">
                    <h2 class="h2 font-weight-bold">DB Archive</h2>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('export.db') }}" method="POST" class="">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-3 form-group">
                                <label for="start_date" class="form-label">Start Date:</label>
                                <input type="date" class="form-control" name="start_date" id="start_date">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="end_date" class="form-label">End Date:</label>
                                <input type="date" class="form-control" name="end_date" id="end_date">
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <input type="submit" name="filter" value="Download Filtered Data" class="btn btn-primary">
                            <input type="submit" name="all" value="Download All" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
