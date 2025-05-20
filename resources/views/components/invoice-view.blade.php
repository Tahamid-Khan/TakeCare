@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="container card px-4 py-5">

                <h2 class="py-3 text-3xl font-bold text-gray-800">Invoice</h2>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <p>Invoice Date: <strong>July 29, 2024</strong></p>
                        <p>Invoice Number: <strong>#INV-12345</strong></p>
                    </div>
                </div>

                <div class="row border border-black mb-4 p-2">
                    <div class="col-md-6">
                        <p class="py-2">Patient Name: <span></span></p>
                        <p class="py-2">Patient ID: <span></span></p>
                        <p class="py-2">Consultant: <span></span></p>
                        <p class="py-2">Address: <span></span></p>
                    </div>
                    <div class="col-md-6">
                        <p class="py-2">Age: <span></span></p>
                        <p class="py-2">Gender: <span></span></p>
                        <p class="py-2">Bed No: <span></span></p>
                        <p class="py-2">Discharge Type: <span></span></p>
                    </div>
                </div>

                <style>
                    .col-12, .col-xl-4 {
                        padding-right: 0px !important;
                    }
                    .minw-100 {
                        min-width: 100px !important;
                    }
                </style>

                <div class="row">
                    <div class="col-12">
                        <table class="table-auto w-full border-collapse border border-gray-200" id="classList">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th scope="col" class="border border-gray-200 px-4 py-2 text-left">Sl</th>
                                    <th scope="col" class="border border-gray-200 px-4 py-2 text-left">Services</th>
                                    <th scope="col" class="border border-gray-200 px-4 py-2 text-right minw-100">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-200 px-4 py-2">1</td>
                                    <td class="border border-gray-200 px-4 py-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor temporibus in sequi vitae optio at, enim fuga tempora commodi ea.</td>
                                    <td class="border border-gray-200 px-4 py-2 text-right">500</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-200 px-4 py-2">2</td>
                                    <td class="border border-gray-200 px-4 py-2">ECO</td>
                                    <td class="border border-gray-200 px-4 py-2 text-right">300</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-2 d-flex justify-content-end">
                        <div class="col-xl-4">
                            <table class="table-auto w-full border-collapse border-gray-200">
                                <tbody>
                                    <tr class="border-r-2">
                                        <td class="px-4 py-2">Total Bill Amount</td>
                                        <td class="border-t-2 border-black px-4 py-2 text-right">800</td>
                                    </tr>
                                    <tr class="border-r-2">
                                        <td class="px-4 py-2">Discount</td>
                                        <td class="px-4 py-2 text-right">0.00</td>
                                    </tr>
                                    <tr class="border-r-2">
                                        <td class="px-4 py-2 font-bold">Net Bill Amount</td>
                                        <td class="border-t-2 border-black px-4 py-2 text-right font-bold">800</td>
                                    </tr>
                                    <tr class="border-r-2">
                                        <td class="px-4 py-2">Advance Payment</td>
                                        <td class="px-4 py-2 text-right">200</td>
                                    </tr>
                                    <tr class="border-r-2">
                                        <td class="px-4 py-2">Due</td>
                                        <td class="px-4 py-2 text-right">0.00</td>
                                    </tr>
                                    <tr class="border-t-2 border-black">
                                        <td class="px-4 py-2 font-bold">Receivable Amount</td>
                                        <td class="px-4 py-2 text-right font-bold">600</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


                <div class="row mt-4">
                    <div class="col-md-6">
                        <p><strong>In Words:</strong></p>
                        <p>Six Hundred taka Only</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <p><strong>Notes:</strong></p>
                        <p>Thank you. We wish you better health.</p>
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
                "filter": false,
                "paging": false,
                "info": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
