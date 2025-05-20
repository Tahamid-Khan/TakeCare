<style type="text/css">
    .invoice-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
    }

    .invoice-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .invoice-header h2 {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .invoice-info {
        margin-bottom: 30px;
    }

    .invoice-info strong {
        font-weight: bold;
    }

    .invoice-details {
        display: flex;
        justify-content: space-between;
        border: 1px solid #000;
        padding: 20px;
        margin-bottom: 30px;
        background-color: #fff;
    }

    .invoice-details div {
        width: 45%;
    }

    .invoice-details p {
        margin: 8px 0;
        font-size: 14px;
    }

    .invoice-details span {
        font-weight: bold;
        color: #333;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    .invoice-table th {
        background-color: #e9e9e9;
        font-weight: bold;
    }

    .invoice-table td {
        font-size: 14px;
    }

    .invoice-table .text-right {
        text-align: right;
    }

    .summary-table {
        width: 50%;
        margin-left: auto;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .summary-table td {
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
    }

    .summary-table .bold {
        font-weight: bold;
    }

    .summary-table .text-right {
        text-align: right;
    }

    .summary-table .total,
    .summary-table .receivable {
        border-top: 2px solid #000;
        font-weight: bold;
    }

    .footer-section {
        margin-top: 40px;
        font-size: 14px;
    }

    .footer-section p {
        margin: 5px 0;
    }

    .footer-section .bold {
        font-weight: bold;
    }

    @media print {

        /* style sheet for print goes here */
        .hide-from-printer {
            display: none;
        }

        .pagebreak {
            clear: both;
            page-break-after: always;
        }
    }
</style>
{{-- Print Button --}}
<div class="text-right">
    <button class="hide-from-printer" onclick="printpage()">Print</button>
</div>

<script>
    function printpage() {
        window.print();
    }
</script>

@if($lists == null)
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>Invoice</h2>
        </div>

        <div class="invoice-info">
            <table style="width: 100%;">
                <tr>
                    <td>Invoice Number: <strong>{{ $invoice->invoice_number }}</strong></td>
                    <td style="text-align: right;">Invoice Date: <strong>{{ $invoice->invoice_date }}</strong>
                    </td>
                </tr>
            </table>
        </div>

        {{--    <div class="invoice-details"> --}}
        {{--        <div> --}}
        {{--            <p>Patient Name: <span>{{ patient_name }}</span></p> --}}
        {{--            <p>Patient ID: <span>{{ patient_id }}</span></p> --}}
        {{--            <p>Consultant: <span>{{ consultant_name }}</span></p> --}}
        {{--            <p>Address: <span>{{ address }}</span></p> --}}
        {{--        </div> --}}
        {{--        <div> --}}
        {{--            <p>Age: <span>{{ age }}</span></p> --}}
        {{--            <p>Gender: <span>{{ gender }}</span></p> --}}
        {{--            <p>Bed No: <span>{{ bed_no }}</span></p> --}}
        {{--            <p>Discharge Type: <span>{{ discharge_type }}</span></p> --}}
        {{--        </div> --}}
        {{--    </div> --}}

        <table class="invoice-table">
            <thead>
            <tr>
                <th>Particular</th>
                <th class="text-right">Amount</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $invoice->service_name }}</td>
                <td class="text-right">{{ $invoice->total_price }}</td>
            </tr>
            </tbody>
        </table>

        <table class="summary-table">
            <tbody>
            <tr>
                <td class="bold">Discount</td>
                <td class="text-right bold">{{ $invoice->discount }}</td>
            </tr>
            <tr>
                <td>Payable</td>
                <td class="text-right">{{ $invoice->final_price }}</td>
            </tr>
            <tr class="total">
                <td class="bold">Due</td>
                <td class="text-right bold">0</td>
            </tr>
            </tbody>
        </table>

        <div class="footer-section">
            {{-- <p><strong>In Words:</strong> Six Hundred taka Only</p> --}}
            <p><strong>Notes:</strong> Thank you. We wish you better health.</p>
        </div>
    </div>
@else
{{--    @php--}}
{{--        $counter = 0;--}}
{{--    @endphp--}}
{{--    @for($i = 0; $i < 3; $i++)--}}
        <div class="invoice-container">
            <div class="invoice-header">
                <h2>Invoice</h2>
            </div>

            <div class="invoice-info">
                <table style="width: 100%;">
                    <tr>
                        <td>Invoice Number: <strong>{{ $lists->patientInvoice->invoice_number }}</strong></td>
                        <td style="text-align: right;">Invoice Date:
                            <strong>{{ $lists->patientInvoice->invoice_date }}</strong>
                        </td>
                    </tr>
                </table>
            </div>

            {{--    <div class="invoice-details"> --}}
            {{--        <div> --}}
            {{--            <p>Patient Name: <span>{{ patient_name }}</span></p> --}}
            {{--            <p>Patient ID: <span>{{ patient_id }}</span></p> --}}
            {{--            <p>Consultant: <span>{{ consultant_name }}</span></p> --}}
            {{--            <p>Address: <span>{{ address }}</span></p> --}}
            {{--        </div> --}}
            {{--        <div> --}}
            {{--            <p>Age: <span>{{ age }}</span></p> --}}
            {{--            <p>Gender: <span>{{ gender }}</span></p> --}}
            {{--            <p>Bed No: <span>{{ bed_no }}</span></p> --}}
            {{--            <p>Discharge Type: <span>{{ discharge_type }}</span></p> --}}
            {{--        </div> --}}
            {{--    </div> --}}

            <table class="invoice-table">
                <thead>
                <tr>
                    <th>Particular</th>
                    <th class="text-right">Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $lists->patientInvoice->service_name }}</td>
                    <td class="text-right">{{ $lists->patientInvoice->total_price }}</td>
                </tr>
                </tbody>
            </table>

            <table class="summary-table">
                <tbody>
                <tr>
                    <td class="bold">Discount</td>
                    <td class="text-right bold">{{ $lists->patientInvoice->discount }}</td>
                </tr>
                <tr>
                    <td>Payable</td>
                    <td class="text-right">{{ $lists->patientInvoice->final_price }}</td>
                </tr>
                <tr>
                    <td>Paid</td>
                    <td class="text-right">{{ $lists->paid_now }}</td>
                </tr>
                <tr class="total">
                    <td class="bold">Due</td>
                    <td class="text-right bold">{{ $lists->due }}</td>
                </tr>
                </tbody>
            </table>

            <div class="footer-section">
                @if($lists->due == 0)
                    <div>
                        <svg width="150" height="94" xmlns="http://www.w3.org/2000/svg">
                            <g transform="rotate(-10, 75, 37.5)">
                                <rect x="14" y="16" width="120" height="60" stroke="red" stroke-width="6" fill="none"/>
                                <text x="50%" y="50%" text-anchor="middle" fill="red" font-size="30" font-family="Arial"
                                      font-weight="bold" dy=".35em">PAID
                                </text>
                            </g>
                        </svg>
                    </div>
                @endif
                {{-- <p><strong>In Words:</strong> Six Hundred taka Only</p> --}}
                <p><strong>Notes:</strong> Thank you. We wish you better health.</p>
            </div>
        </div>
{{--        @php--}}
{{--            $counter++;--}}
{{--        @endphp--}}
{{--        @if ($counter < 3)--}}
{{--            <div class="pagebreak"></div>--}}
{{--        @endif--}}
{{--    @endfor--}}
@endif
