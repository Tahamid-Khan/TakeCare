<style type="text/css">
    .slip-container {
        width: 350px;
        border: 1px solid #000;
        padding: 20px;
        margin: 20px auto;
    }

    .text-center {
        text-align: center;
    }

    .my-3 {
        margin-top: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .mt-2 {
        margin-top: 0.5rem;
    }

    .mt-3 {
        margin-top: 0.75rem;
    }

    .info-container {
        margin-top: 40px;
        margin-bottom: 30px;
    }

    .info-left, .info-right {
        display: inline-block;
        width: 48%;
    }

    .info-left {
        float: left;
    }

    .info-right {
        float: right;
        text-align: right;
    }

    .footer-text {
        font-size: 0.8rem;
        margin-top: 20px;
    }
</style>

@php
    $patient_id = $patientLists[0]->patient->patient_id;
@endphp

<div class="slip-container">
    <div class="text-center">
        <h1 class="mb-2"><strong>OPD Slip</strong></h1>
        <h2 class="my-2"><strong>Token# <span>{{ $patientLists[0]->serial }}</span></strong></h2>
        <span class="barcode">
            <img src="data:image/png;base64, {{ DNS1D::getBarcodePNG("$patient_id", 'C39+', 1, 33, array(1, 1, 1), true) }}" alt="barcode" />
        </span>
    </div>
    <div class="info-container">
        <div class="info-left"><strong>Slip Date:</strong> <span>{{ $patientLists[0]->date }}</span></div>
        <div class="info-right"><strong>Room:</strong> <span>23</span></div>
    </div>
    <hr>
    <div class="mt-2">
        <div><strong>Patient:</strong> <span>{{ $patientLists[0]->patient->name }}</span></div>
    </div>
    <div class="mt-2">
        <div><strong>Age:</strong> <span>{{ $patientLists[0]->patient->age }}</span></div>
    </div>
    <div class="mt-2">
        <div><strong>Gender:</strong> <span>{{ $patientLists[0]->patient->gender }}</span></div>
    </div>
    <div class="mt-3">
        <div><strong>Assign Doctor:</strong> <span>{{ $patientLists[0]->doctor->name }}</span></div>
    </div>
    <hr>
    <div class="mt-2">
        <div><strong>Type: </strong><span>{{ $patientLists[0]->patient->patient_type }}</span></div>
    </div>
    <div class="footer-text text-center">TakeCare</div>
</div>
