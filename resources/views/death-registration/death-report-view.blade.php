<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Death Certificate Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .certificate-container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid black;
            padding: 20px;
        }

        .header-title {
            font-weight: bold;
            text-align: center;
        }

        .section-title {
            margin-top: 20px;
            font-weight: bold;
        }

        .list-group-item {
            border: none;
            padding: 5px 0;
        }

        .signature {
            margin-top: 30px;
        }
    </style>
</head>

<body>
<div class="certificate-container">
    <div class="header text-center">
        <h4 class="h2">Hospital Name</h4>
        <div>Uttara, Dhaka</div>
        <div>Phone: +880 3424242</div>
        <div>Email: test@gmail.com</div>
        <h5 class="header-title">Death Certificate Form</h5>
    </div>

    <!-- Deceased Information -->
    <div class="section-title">1. Name of the deceased person in full (block letters):</div>
    <ul class="list-group">
        <li class="list-group-item text-uppercase">{{ $data->name ?? '' }}</li>
    </ul>

    <div class="row">
{{--        <div class="col-6">--}}
{{--            <div class="section-title">2. Patient ID:</div>--}}
{{--            <ul class="list-group">--}}
{{--                <li class="list-group-item">P45435</li>--}}
{{--            </ul>--}}
{{--        </div>--}}
        <div class="col-6">
            <div class="section-title">2. Age:</div>
            <ul class="list-group">
                <li class="list-group-item">{{ $data->age ?? ''  }}</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="section-title">3. Father's name:</div>
            <ul class="list-group">
                <li class="list-group-item">{{ $data->fathers_name ?? ''  }}</li>
            </ul>
        </div>
        <div class="col-6">
            <div class="section-title">Mother's name:</div>
            <ul class="list-group">
                <li class="list-group-item">{{ $data->mothers_name ?? '' }}</li>
            </ul>
        </div>
        <div class="col-6">
            <div class="section-title">Spouse's name:</div>
            <ul class="list-group">
                <li class="list-group-item">{{ $data->spouses_name ?? ''  }}</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="section-title">4. Nationality (Present):</div>
            <ul class="list-group">
                <li class="list-group-item">{{ $data->nationality ?? ''  }}</li>
            </ul>
        </div>

        <div class="col-6">
            <div class="section-title">5. Gender:</div>
            <ul class="list-group">
                <li class="list-group-item">{{ $data->gender ?? ''  }}</li>
            </ul>
        </div>
    </div>

    <div class="row">

        <div class="col-6">
            <div class="section-title">6. Date of birth:</div>
            <ul class="list-group">
                <li class="list-group-item">{{ Carbon\Carbon::parse($data->dob)->format('d-m-Y') ?? ''  }}</li>
            </ul>
        </div>
        <div class="col-6">
            <div class="section-title">7. Religion:</div>
            <ul class="list-group">
                <li class="list-group-item">{{ $data->religion ?? ''  }}</li>
            </ul>
        </div>
    </div>

    <div class="section-title">8. Address:</div>
    <ul class="list-group">
        <li class="list-group-item text-uppercase">{{ $data->address ?? ''  }}
        </li>
    </ul>

    <div class="row">
        <div class="col-6">
            <div class="section-title">9. Date of death:</div>
            <ul class="list-group">
                <li class="list-group-item">August 15, 2024</li>
            </ul>
        </div>
        <div class="col-6">
            <div class="section-title">10. Time of death:</div>
            <ul class="list-group">
                <li class="list-group-item">--</li>
            </ul>
        </div>
    </div>

    <div class="section-title">11. Cause of death:</div>
    <ul class="list-group">
        <li class="list-group-item">Natural Causes</li>
    </ul>

    <!-- Death Details -->
    <div class="section-title">12. Details of the death:</div>
    <ul class="list-group">
        <li class="list-group-item">The deceased was admitted to the hospital on August 10, 2024, with a high fever and
            cough. He was diagnosed with pneumonia and was treated with antibiotics. However, his condition worsened
            over the next few days, and he passed away on August 15, 2024.
        </li>
    </ul>

    <!--Law Enforcement Details-->
    <div class="row">
        <div class="col-6">
            <div class="section-title">13. Was the death reported to the police?</div>
            <ul class="list-group">
                <li class="list-group-item">Yes</li>
            </ul>
        </div>
        <div class="col-6">
            <div class="section-title">14. Police Station:</div>
            <ul class="list-group">
                <li class="list-group-item">Uttara Police Station</li>
            </ul>
        </div>

        <div class="col-6">
            <div class="section-title">15. Case Number:</div>
            <ul class="list-group">
                <li class="list-group-item">123456</li>
            </ul>
        </div>

        <div class="col-6">
            <div class="section-title">16. Reporting Officer's Name:</div>
            <ul class="list-group-item">John Doe</ul>
        </div>

        <div class="col-6">
            <div class="section-title">17. Officer's Contact Number:</div>
            <ul class="list-group-item">
                <li class="list-group-item">+880 1234 567890</li>
            </ul>
        </div>
    </div>

    <!-- Next of Kin Details -->
    <div class="section-title">18. Particulars of the next of kin to receive the dead body:</div>
    <div class="row">
        <div class="col-6">
            <div class="section-title">Name:</div>
            <ul class="list-group-item">
                <li class="list-group-item">Adam Smith</li>
            </ul>
        </div>

        <div class="col-6">
            <div class="section-title">Relationship:</div>
            <ul class="list-group-item">
                <li class="list-group-item">Unknown</li>
            </ul>
        </div>

        <div class="col-6">
            <div class="section-title">Contact Number:</div>
            <ul class="list-group-item">
                <li class="list-group-item">+880 1234 567890</li>
            </ul>
        </div>

        <div class="col-6">
            <div class="section-title">National ID Number:</div>
            <ul class="list-group-item">
                <li class="list-group-item">1234567890</li>
            </ul>
        </div>

        <div class="col-6">
            <div class="section-title">Address:</div>
            <ul class="list-group-item">
                <li class="list-group-item">Unknown</li>
            </ul>
        </div>
    </div>

    <!-- Enclosures -->
    <div class="section-title">I do hereby enclose the following:</div>
    <ul class="list-group">
        <li class="list-group-item">Death Certificate from the hospital</li>
        <li class="list-group-item">Photocopy of the passport of the deceased</li>
        <li class="list-group-item">ID of the next of kin/relative/custodian of the deceased in the foreign country</li>
        <li class="list-group-item">Confirmation that the above information is true and no death certificate was issued
            for the above person before
        </li>
    </ul>

    <div class="signature">
        <div class="row">
            <div class="col-6">
                <p><strong>Signature of the applicant:</strong> _____________________</p>
            </div>
            <div class="col-6 text-end">
                <p><strong>Date:</strong> _____________________</p>
            </div>
        </div>
    </div>
</div>
</body>

</html>
