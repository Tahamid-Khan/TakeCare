@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="">
                    <h2 class="card-header h2 font-weight-bold">Patient Details</h2>
                    <div class="rounded border p-4 shadow-lg bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="py-2"><strong>Patient Name: </strong> {{ $patientData->name }}<span></span></p>
                                <p class="py-2"><strong>Patient ID: </strong> {{ $patientData->patient_id }}<span></span>
                                </p>
                                <p class="py-2"><strong>Mobile: </strong> {{ $patientData->mobile }} <span></span></p>

                            </div>
                            <div class="col-md-6">
                                <p class="py-2"><strong>Age: </strong>{{ $patientData->age }} <span></span></p>
                                <p class="py-2"><strong>Gender: </strong> {{ $patientData->gender }}<span></span></p>
                                <p class="py-2"><strong>Address: </strong> {{ $patientData->address }} <span></span></p>

                            </div>
                        </div>
                    </div>

                    <div class="rounded border p-4 shadow-lg bg-white mt-8">
                    <h2 class="py-3 h2 font-weight-bold">All Invoices</h2>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice Number</th>
                                        <th>Service Name</th>
                                        <th>Status</th>
                                        <th>Due</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->invoice_date }}</td>
                                            <td>{{ $invoice->invoice_number }}</td>
                                            <td>{{ $invoice->service_name }}</td>
                                            <td class="capitalize">{{ $invoice->payment_status }}</td>
                                            <td><span class="taka-small">&#2547;</span>{{ number_format($invoice->due_amount, 2, '.', ',') }}</td>
                                            <td>
                                                <a href="#show-invoice-table" data-id="{{ $invoice->id }}"
                                                    class="btn btn-sm btn-info my-2 view-button"
                                                    title="View-{{ $invoice->invoice_number }}">
                                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                                </a>
                                                {{-- <form action="{{ route('invoice') }}" method="GET" target="_blank">
                                                    <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                                    <button type="submit" class="btn btn-sm btn-primary my-2"
                                                        title="Print-{{ $invoice->invoice_number }}">
                                                        <i class="fas fa-print" aria-hidden="true"></i>
                                                    </button>
                                                </form> --}}

                                                <a href="{{ route('invoice', ['print_id' => $invoice->id]) }}"
                                                    target="_blank" class="btn btn-sm btn-primary my-2"
                                                    title="Print-{{ $invoice->invoice_number }}">
                                                    <i class="fas fa-print" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <!-- Detail Table and Form -->
                        <div class="mt-8">
                            <div class="row">
                                <div class="col-xl-8">
                                    <section id="show-invoice-table">
                                        <table class="table table-bordered table-striped" id="classList2">
                                            <thead>
                                                <tr>
                                                    <th>Invoice Number</th>
                                                    <th>Service Name</th>
                                                    <th>Discount %</th>
                                                    <th>Total Price</th>
                                                    <th>Due</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </section>
                                </div>
                                <div class="col-xl-4" style="margin-bottom: 20px;">
                                    <form action="{{ route('reception.patient-invoice.store') }}" method="POST"> @csrf
                                        <div class="row">
                                            <!-- Form Fields -->
                                            <div class="col-md-12 form-group">
                                                <label class="sr-only" for="sub-total">Sub Total</label>
                                                <div class="input-group mb-0 mr-sm-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="width: 140px;">Sub Total</div>
                                                    </div>
                                                    <input class="form-control text-success text-right font-weight-bold h6"
                                                        readonly type="text" required id="sub-total" name="sub_total">
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label class="sr-only" for="due">Due</label>
                                                <div class="input-group mb-0 mr-sm-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="width: 140px;">Due</div>
                                                    </div>
                                                    <input class="form-control text-danger text-right font-weight-bold due"
                                                        readonly type="text" id="due" name="due">
                                                </div>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label class="sr-only" for="pay-now">Pay Now</label>
                                                <div class="input-group mb-0 mr-sm-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="width: 140px;">Pay Now</div>
                                                    </div>
                                                    <input class="form-control text-success text-right font-weight-bold"
                                                        type="text" id="pay-now" name="pay_now">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="sr-only" for="mode">Mode</label>
                                                <div class="input-group mb-0 mr-sm-0">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text" style="width: 140px;">Mode</div>
                                                    </div>
                                                    <select type="text" class="form-control" name="mode"
                                                        id="mode">
                                                        <option selected value="cash">Cash</option>
                                                        <option value="bkash">Bkash</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input hidden type="number" name="invoice_id" value="" id="invoice-id">

                                        <button type="submit" class="btn btn-primary add btn-block lidl mt-3"
                                            id="save">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(function() {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
        $(function() {
            $("#classList2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "filter": false,
                "paging": false,
                "info": false,
                'sort': false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const printId = urlParams.get('print_id');

        if (printId) {
            Swal.fire({
                title: 'Invoice Created Successfully',
                text: "Do you want to print the invoice?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Print it!'
            }).then((result) => {
                if (result.isConfirmed) {
                window.open(`/invoice/${printId}`, '_blank');
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            });
        }
    </script>

    <script>
        // Assume invoices data is available on the page as a JavaScript object
        const invoices = @json($invoices); // This converts the $invoices PHP variable into a JavaScript object
        // console.log(invoices);
        document.addEventListener('DOMContentLoaded', function() {
            const viewButtons = document.querySelectorAll('.view-button');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const invoiceId = this.getAttribute('data-id');
                    const invoice = invoices.find(inv => inv.id == invoiceId);

                    if (invoice) {
                        // Populate the detail table
                        document.querySelector('#classList2 tbody').innerHTML = `
                        <tr>
                            <td>${invoice.invoice_number}</td>
                            <td>${invoice.service_name}</td>
                            <td>${invoice.discount}</td>
                            <td><span class="taka-small">&#2547; </span>${invoice.final_price}</td>
                            <td><span class="taka-small">&#2547; </span>${invoice.due_amount}</td>
                        </tr>
                    `;

                        // Populate the form fields
                        document.querySelector('#sub-total').value = invoice.total_price;
                        document.querySelector('#due').value = invoice.due_amount;
                        document.querySelector('#pay-now').value = invoice.due_amount;
                        document.querySelector('#invoice-id').value = invoice.id;
                    }
                });
            });
        });
    </script>
@endpush
