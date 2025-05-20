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
            <a class="nav-link text-secondary" id="custom-content-below-previous-medicine-tab" data-toggle="pill"
                href="#custom-content-below-previous-medicine" role="tab"
                aria-controls="custom-content-below-previous-medicine" aria-selected="false">Previous Medicine</a>
        </li>

        {{-- Medicine Circle --}}
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-medicine-circle-tab" data-toggle="pill"
                href="#custom-content-below-medicine-circle" role="tab"
                aria-controls="custom-content-below-medicine-circle" aria-selected="false">Medicine Circle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-report-summary-tab" data-toggle="pill"
                href="#custom-content-below-report-summary" role="tab"
                aria-controls="custom-content-below-report-summary" aria-selected="false">Report
                Summary</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-secondary" id="custom-content-below-referral-form-tab" data-toggle="pill"
                href="#custom-content-below-referral-form" role="tab"
                aria-controls="custom-content-below-referral-form" aria-selected="false">Referral Form</a>
        </li>
    </ul>


    <div class="tab-content card p-4" id="custom-content-below-tabContent">
        <div class="tab-pane fade show active" id="custom-content-below-current-state" role="tabpanel"
            aria-labelledby="custom-content-below-current-state-tab">
            @include('components.patient-current-state')
        </div>


        <div class="tab-pane fade" id="custom-content-below-previous-history" role="tabpanel"
            aria-labelledby="custom-content-below-previous-history-tab">
            @include('components.previous-history')
        </div>


        <div class="tab-pane fade" id="custom-content-below-previous-medicine" role="tabpanel"
            aria-labelledby="custom-content-below-previous-medicine-tab">
            @include('components.previous-medicine')
        </div>


        {{-- Medicine Circle --}}
        <div class="tab-pane fade" id="custom-content-below-medicine-circle" role="tabpanel"
            aria-labelledby="custom-content-below-medicine-circle-tab">
            @include('components.medicine-circle')
        </div>

        <div class="tab-pane fade" id="custom-content-below-report-summary" role="tabpanel"
            aria-labelledby="custom-content-below-report-summary-tab">
            @include('components.patient-report-summary')
        </div>
        <div class="tab-pane fade" id="custom-content-below-referral-form" role="tabpanel"
            aria-labelledby="custom-content-below-referral-form-tab">
            @include('components.referral-form')
        </div>
    </div>
</div>
