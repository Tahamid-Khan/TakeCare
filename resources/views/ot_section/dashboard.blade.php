@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .bg-danger-light {
            background-color: #f8d7da;
        }
    </style>
    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Operation Lists</h2>
                <div class="p-4">

                    <div class="row mb-4">
                        <!-- Card 1 -->
                        <div class="col-12 col-md-5 col-xl-3 mb-4">
                            <div class="rounded-lg bg-danger-light p-3 shadow">
                                <h3 class="mb-2 h5">Total Upcoming Operations</h3>
                                <p class="h3 font-weight-bold text-danger">23</p>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-secondary" id="custom-content-below-current-upcoming-ot-tab"
                               data-toggle="pill" href="#custom-content-below-current-upcoming-ot" role="tab"
                               aria-controls="custom-content-below-current-upcoming-ot" aria-selected="true">Incomplete
                                OT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" id="custom-content-below-previous-ot-tab"
                               data-toggle="pill"
                               href="#custom-content-below-previous-ot" role="tab"
                               aria-controls="custom-content-below-previous-ot" aria-selected="false">Complete OT</a>
                        </li>
                    </ul>

                    <div class="tab-content card " id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="custom-content-below-current-upcoming-ot"
                             role="tabpanel"
                             aria-labelledby="custom-content-below-current-upcoming-ot-tab">
                            @include('components.upcoming-ot')
                        </div>

                        <div class="tab-pane fade" id="custom-content-below-previous-ot" role="tabpanel"
                             aria-labelledby="custom-content-below-previous-ot-tab">
                            @include('components.previous-ot')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
