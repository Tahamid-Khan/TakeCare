<div>
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active text-secondary" id="custom-content-below-patient-status-tab" data-toggle="pill"
                href="#custom-content-below-patient-status" role="tab"
                aria-controls="custom-content-below-patient-status" aria-selected="true">Patient Status</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-operation-details-tab" data-toggle="pill"
                href="#custom-content-below-operation-details" role="tab"
                aria-controls="custom-content-below-operation-details" aria-selected="false">Operation Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-doctor-comments-tab" data-toggle="pill"
                href="#custom-content-below-doctor-comments" role="tab"
                aria-controls="custom-content-below-doctor-comments" aria-selected="false">Doctor's Comments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-patients-statistics-tab" data-toggle="pill"
                href="#custom-content-below-patients-statistics" role="tab"
                aria-controls="custom-content-below-patients-statistics" aria-selected="false">Patient Statistics</a>
        </li>
    </ul>


    <div class="tab-content card p-4" id="custom-content-below-tabContent">
        <div class="tab-pane fade show active" id="custom-content-below-patient-status" role="tabpanel"
            aria-labelledby="custom-content-below-patient-status-tab">
            @include('pow.pow-patient-status')
        </div>

        <div class="tab-pane fade show" id="custom-content-below-operation-details" role="tabpanel"
            aria-labelledby="custom-content-below-operation-details-tab">
            @include('pow.pow-operation-details')
        </div>


        <div class="tab-pane fade" id="custom-content-below-doctor-comments" role="tabpanel"
            aria-labelledby="custom-content-below-doctor-comments-tab">
            @include('components.doctor-comments')
        </div>


        <div class="tab-pane fade" id="custom-content-below-patients-statistics" role="tabpanel"
            aria-labelledby="custom-content-below-patients-statistics-tab">
            @include('components.pow-patient-statistics')
        </div>
    </div>
</div>
