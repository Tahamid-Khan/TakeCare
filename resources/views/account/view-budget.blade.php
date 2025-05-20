@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Budget List</h2>
                <div class="p-4">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h2 class="py-3 text-2xl font-bold text-gray-800">Budget From</h2>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>SL</th>
                                <th>Month</th>
                                <th>Department</th>
                                <th>Total Amount</th>
                                </thead>

                                <tbody>
                                @foreach($budgets as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->forMonth)->format('M, Y') }}</td>
                                        <td>{{ $item->fundDepartment->name }}</td>
                                        <td><span class="taka-small">&#2547;</span>{{ number_format($item->amount, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 col-md-6 p-4">
                            <h2 class="py-3 text-2xl font-bold text-gray-800">Show Budget</h2>

                            <form action="" method="GET">
                                <div class="row mb-4">
                                    <!--Select Department-->
                                    <div class="col-md-7 mb-3">
                                        <label for="department" class="form-label">Select Department</label>
                                        <select id="department" name="department" class="form-select form-control">
                                            <option disabled selected>Select a department</option>
                                            @foreach($fundDepartments as $department)
                                                <option class="capitalize"
                                                        value="{{ $department->id }}">{{ $department->name . " - " . $department->fund->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!--Select Month-->
                                    <div class="col-md-5 mb-3">
                                        <label for="month" class="form-label">Select Month</label>
                                        <input type="month" class="form-control" id="month" name="month"
                                               value="{{ \Carbon\Carbon::now()->format('Y-m') }}">
                                    </div>
                                    <div class="col-auto md:mt-4 d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary">Show Budget</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <style>
                    .col-12, .col-xl-4 {
                        padding-right: 0 !important;
                    }
                </style>
                @if(isset($budgetDetails))
                    @php
                        $details = json_decode($budgetDetails->items);

                    @endphp
                    <div class="container mx-auto rounded border p-4 shadow-lg bg-white mt-8">
                        <h2 class="py-3 text-3xl font-bold text-gray-800">Budget
                            for {{ $budgetDetails->fundDepartment->name }}</h2>
                        <div class="row">
                            <div class="col-12">
                                <table class="table-auto w-full border-collapse border border-gray-200" id="classList">
                                    <thead class="bg-gray-100">
                                    <tr>
                                        <th scope="col" class="border border-gray-200 px-4 py-2 text-left">Sl</th>
                                        <th scope="col" class="border border-gray-200 px-4 py-2 text-left">Item Name
                                        </th>
                                        <th scope="col" class="border border-gray-200 px-4 py-2 text-right">
                                            Estimated Amount
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($details as $item)
                                        <tr>
                                            <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                                            <td class="border border-gray-200 px-4 py-2">{{ $item->name }}</td>
                                            <td class="border border-gray-200 px-4 py-2 text-right"><span class="taka-small">&#2547;</span>{{ number_format($item->budget, 2) }}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 mt-2 d-flex justify-content-end">
                                <div class="col-xl-4">
                                    <table class="table-auto w-full border-collapse border-gray-200">
                                        <tbody>
                                        <tr class="border-r-2">
                                            <td class="px-4 py-2 font-bold">Total Bill Amount</td>
                                            <td class="border-t-2 border-black px-4 py-2 text-right"><span class="taka-small">&#2547;</span>{{ number_format($budgetDetails->amount, 2) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "filter": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
