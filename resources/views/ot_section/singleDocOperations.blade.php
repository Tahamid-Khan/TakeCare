@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <h2 class="card-header h2">All Operations</h2>

                <div class="p-3 mt-4">
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

                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="custom-content-below-current-upcoming-ot"
                             role="tabpanel"
                             aria-labelledby="custom-content-below-current-upcoming-ot-tab">
                            @include('ot_section.upcoming-ot')
                        </div>

                        <div class="tab-pane fade" id="custom-content-below-previous-ot" role="tabpanel"
                             aria-labelledby="custom-content-below-previous-ot-tab">
                            @include('ot_section.previous-ot')
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
