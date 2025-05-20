<div>
    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active text-secondary" id="custom-content-below-current-state-tab" data-toggle="pill"
                href="#custom-content-below-current-state" role="tab"
                aria-controls="custom-content-below-current-state" aria-selected="true">Patient Current State</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-previous-history-tab" data-toggle="pill"
                href="#custom-content-below-previous-history" role="tab"
                aria-controls="custom-content-below-previous-history" aria-selected="false">Previous History</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-operation-history-tab" data-toggle="pill"
                href="#custom-content-below-operation-history" role="tab"
                aria-controls="custom-content-below-operation-history" aria-selected="false">Operation List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-previous-medicine-tab" data-toggle="pill"
                href="#custom-content-below-previous-medicine" role="tab"
                aria-controls="custom-content-below-previous-medicine" aria-selected="false">Previous Medicine</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-report-summary-tab" data-toggle="pill"
                href="#custom-content-below-report-summary" role="tab"
                aria-controls="custom-content-below-report-summary" aria-selected="false">Report
                Summary</a>
        </li>

    </ul>


    <div class="tab-content card p-4" id="custom-content-below-tabContent">
        <div class="tab-pane fade show active" id="custom-content-below-current-state" role="tabpanel"
            aria-labelledby="custom-content-below-current-state-tab">
            @include('ot_section.patient-current-state')
        </div>


        <div class="tab-pane fade" id="custom-content-below-previous-history" role="tabpanel"
            aria-labelledby="custom-content-below-previous-history-tab">
            @include('ot_section.previous-history')
        </div>


        <div class="tab-pane fade" id="custom-content-below-operation-history" role="tabpanel"
            aria-labelledby="custom-content-below-operation-history-tab">
            @include('ot_section.operation-list')
        </div>


        <div class="tab-pane fade" id="custom-content-below-previous-medicine" role="tabpanel"
            aria-labelledby="custom-content-below-previous-medicine-tab">
            @include('ot_section.previous-medicine')
        </div>


        <div class="tab-pane fade" id="custom-content-below-report-summary" role="tabpanel"
            aria-labelledby="custom-content-below-report-summary-tab">
            @include('ot_section.patient-report-summary')
        </div>
    </div>
</div>
