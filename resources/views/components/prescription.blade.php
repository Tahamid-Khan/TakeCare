<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information</title>
    <style>
        .border-gray {
            border-color: #e5e7eb !important;
        }

        .fw-bold {
            font-weight: bold;
        }

        .h1 {
            font-size: 1.75rem;
            margin-bottom: 0.2rem;
        }

        .h3 {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .h5 {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .h6 {
            font-size: 1rem;
            margin-bottom: -0.5rem;
        }

        .text-muted {
            color: #6c757d;
        }

        .text-secondary {
            color: #6c757d;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .my-3 {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .pb-2 {
            padding-bottom: 0.5rem;
        }

        .border-bottom {
            border-bottom: 1px solid #e5e7eb;
        }

        .pl-2 {
            padding-left: 0.5rem;
        }

        .pl-4 {
            padding-left: 1rem;
        }

        .pl-5 {
            padding-left: 3.5rem;
        }

        .small {
            font-size: 0.875rem;
        }

        .height-10 {
            height: 10px;
        }

        .p-2 {
            padding-top: 1px;
            padding-left: 10px;
        }

        .rounded-lg {
            border-radius: 0.5rem;
        }

        .shadow-lg {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .my-5 {
            margin-top: 3rem;
            margin-bottom: 3rem;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        .ms-3 {
            margin-left: 1rem;
        }

        .ms-4 {
            margin-left: 1.5rem;
        }

        .border {
            border: 1px solid black;
        }

        .justify-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        td {
            vertical-align: top !important;
        }

        .info-section {
            width: 245px !important;
        }

        .bl {
            border-left: 1px solid #e5e7eb !important;
        }

        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        .bottom-0 {
            bottom: 0;
        }

        .right-0 {
            right: 0;
        }

        .text-blue-600 {
            color: blue;
        }

        .font-normal {
            font-weight: 400;
        }
    </style>
</head>

<body>
<div>
    <div class="mb-2">
        <h1 class="h1 fw-bold">
            {{ $patientData->doctor->name }} <br>
            <span class="small"><span>{{ $patientData->doctor->qualification }}</span>
                    <br><span class="font-normal">{{ $patientData->doctor->position }}</span>
                    <br><span class="font-normal">{{ $patientData->doctor->specialization }}</span>
                    <br><span class="font-normal">Hospital Name</span><br>
                </span>
        </h1>
        {{-- <h2 class="">{{ $patientData->doctor->specialization }}</h2>
        <h3 class="text-muted">Designation</h3> --}}
    </div>

    <div class="border-bottom">
        <h1 class="h5 pb-2 border-bottom fw-bold">Patient Info</h1>
        <table width="100%" class="small">
            <tr>
                <td>
                    <p><strong>Name:</strong> {{ $patientData->patient->name }}</p>
                </td>
                <td>
                    <p><strong>Age:</strong> {{ $patientData->patient->age }}</p>
                </td>
                <td>
                    <p><strong>Blood Group:</strong> AB+</p>
                </td>
                <td>
                    <p><strong>Date:</strong> {{ $patientData->created_at->format('d-m-Y') }}</p>
                </td>
            </tr>
        </table>
    </div>


    @php
        $prescription = optional($patientData->opdPrescription)->prescription;
        $prescriptionData = $prescription ? json_decode($prescription, true) : [];
//        dd($prescriptionData);
    @endphp

    <div class="">
        <table width="100%">
            <tr>
                <td class="info-section">
                    <div class="p-2 bg-gray-100 rounded-lg">
                        <h2 class="h6 fw-bold">C/C</h2>
                        <hr>
                        <ul class="pl-2 small height-10">{{ $prescriptionData['cc'] ?? '' }}</ul>
                    </div>
                    <div class="p-2 bg-gray-100">
                        <h2 class="h6 fw-bold">H/O</h2>
                        <hr>
                        <ul class="pl-2 small height-10">{{ $prescriptionData['ho'] ?? '' }}</ul>
                    </div>
                    <div class="p-2 bg-gray-100 rounded-lg">
                        <h2 class="h6 fw-bold">O/E</h2>
                        <hr>
                        <ul class="pl-2 small">
                            <li class="my-2"><strong>Anemia:</strong>
                                {{ $prescriptionData['oe']['anemia'] ?? '' }}</li>
                            <li class="my-2"><strong>Jaundice:</strong>
                                {{ $prescriptionData['oe']['jaundice'] ?? '' }}</li>
                            <li class="my-2"><strong>Edema:</strong> {{ $prescriptionData['oe']['edema'] ?? '' }}
                            </li>
                            <li class="my-2"><strong>BP:</strong> {{ $prescriptionData['oe']['bp'] ?? '' }}</li>
                            <li class="my-2"><strong>Temperature:</strong>
                                {{ $prescriptionData['oe']['temp'] ?? '' }}</li>
                            <li class="my-2"><strong>Heart:</strong> {{ $prescriptionData['oe']['heart'] ?? '' }}
                            </li>
                            <li class="my-2"><strong>Lung:</strong> {{ $prescriptionData['oe']['lung'] ?? '' }}
                            </li>
                            <li class="my-2"><strong>Liver:</strong> {{ $prescriptionData['oe']['liver'] ?? '' }}
                            </li>
                            <li class="my-2"><strong>Spleen:</strong>
                                {{ $prescriptionData['oe']['spleen'] ?? '' }}</li>
                        </ul>
                    </div>
                    <div class="p-2 bg-gray-100">
                        <h2 class="h6 fw-bold">Inv</h2>
                        <hr>
                        <ul class="pl-2 small">
                            <li class="my-2"><strong>Hb:</strong> {{ $prescriptionData['inv']['hb'] ?? '' }}</li>
                            <li class="my-2"><strong>HbsAg:</strong>
                                {{ $prescriptionData['inv']['hbsAg'] ?? '' }}</li>
                            <li class="my-2"><strong>TC:</strong> {{ $prescriptionData['inv']['tc'] ?? '' }}</li>
                            <li class="my-2"><strong>DC:</strong> {{ $prescriptionData['inv']['dc'] ?? '' }}</li>
                            <li class="my-2"><strong>ESR:</strong> {{ $prescriptionData['inv']['esr'] ?? '' }}
                            </li>
                            <li class="my-2"><strong>Urine RE:</strong>
                                {{ $prescriptionData['inv']['urineRE'] ?? '' }}</li>
                            <li class="my-2"><strong>Blood Sugar:</strong>
                                {{ $prescriptionData['inv']['bloodSugar'] ?? '' }}</li>
                            <li class="my-2"><strong>Blood Urea:</strong>
                                {{ $prescriptionData['inv']['bloodUrea'] ?? '' }}</li>
                            <li class="my-2"><strong>Serum Creatinine:</strong>
                                {{ $prescriptionData['inv']['serumCreatinine'] ?? '' }}</li>
                            <li class="my-2"><strong>RBS:</strong> {{ $prescriptionData['inv']['rbs'] ?? '' }}
                            </li>
                        </ul>
                    </div>
                    <div class="p-2 bg-gray-100 rounded-lg">
                        <h2 class="h6 fw-bold">Adv</h2>
                        <hr>
                        <ul class="pl-2 small height-10">{!! $prescriptionData['adv'] ?? '' !!}</ul>
                    </div>
                </td>

                <td class="bl relative">
                    <div class="mb-4 pl-2">
                        <h2 class="h3 fw-bold">Rx</h2>
                    </div>

                    @if (@isset($prescriptionData['items']) && count($prescriptionData['items']) > 0)
                        <div class="pl-5">
                            @foreach ($prescriptionData['items'] as $item)
                                <div class="mb-4">
                                    <strong>{{ $loop->iteration }}. {{ $item['medicine'] }}</strong>
                                    <div class="ms-4 pl-4">
                                        <span>{{ $item['schedule'] }}</span>
                                        ---->
                                        @if ($item['takingTime'] == 'before')
                                            <span class="ms-3 small"><i>[Before Meal]</i></span>
                                        @else
                                            <span class="ms-3 small"><i>[After Meal]</i></span>
                                        @endif
                                        ---->
                                        @if ($item['duration'] == '14')
                                            <span class="ms-3 small"><i>14 Days</i></span>
                                        @elseif ($item['duration'] == '7')
                                            <span class="ms-3 small"><i>7 Days</i></span>
                                        @elseif ($item['duration'] == '30')
                                            <span class="ms-3 small"><i>1 Month</i></span>
                                        @elseif ($item['duration'] == '60')
                                            <span class="ms-3 small"><i>2 Month</i></span>
                                        @else
                                            <span class="ms-3 small"><i>{{ $item['duration'] }} Days</i></span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-4 text-center fw-bold text-blue-600">{{ $prescriptionData['advice'] ?? '' }}</div>

                    <div class="mt-4 justify-end absolute bottom-0 right-0">
                        <div class="text-center">
                            <p>_________________________</p>
                            <p class="h6 fw-semibold">{{ $patientData->doctor->name }}</p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>

</html>
