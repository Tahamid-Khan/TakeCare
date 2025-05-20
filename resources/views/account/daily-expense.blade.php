@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .bg-danger-light {
            background-color: #f8d7da;
        }

        .bg-warning-light {
            background-color: #fff3cd;
        }

        .bg-success-light {
            background-color: #d4edda;
        }

        .bg-primary-light {
            background-color: #d1ecf1;
        }

        .text-2xl {
            font-size: 1.5rem;
        }

        .text-lg {
            font-size: 1.25rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .display-4 {
            font-size: 2rem;
            font-weight: 700;
        }

        .shadow-md {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .recent-box {
            max-height: 203px;
            overflow-y: auto;
        }
    </style>


    <div class="content-wrapper">
        <section class="content">
            <div class="mb-4 rounded-lg bg-white p-4 shadow-md">
                <h2 class="mb-4 text-xl font-semibold">Daily Expense</h2>

                <div class="row mb-4">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                    <h3 class="mb-2 lg:text-lg font-semibold">Today's Total Expense</h3>
                                    <p class="display-4 text-danger">5000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row rounded-lg bg-white shadow-lg py-4 px-2">
                    <div class="col-12 col-xl-6 mb-4">
                        <h1 class="mb-4 form-label text-xl font-semibold">Add Expense</h1>

                        <div class="card p-4">
                            <form action="">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control"
                                        value="{{ \Carbon\Carbon::now()->toDateString() }}" id="date" name="date">
                                </div>

                                <div class="form-group">
                                    <label for="fund-includes">Fund Includes</label>
                                    <select class="form-control" id="fund-includes" name="fund_includes">
                                        <option selected disabled>Please Select</option>
                                        <option value="icu">ICU Bills</option>
                                        <option value="dressing">Dressing Bills</option>
                                        <option value="ambulance">Ambulance Bills</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount">
                                </div>

                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea id="note" name="note" cols="30" rows="5" class="form-control"></textarea>
                                </div>


                                <button type="submit" class="btn btn-primary">Add Expense</button>

                            </form>
                        </div>

                    </div>

                    {{-- Expense List --}}
                    <div class="col-12 col-xl-6">
                        <h1 class="mb-4 form-label text-xl font-semibold">Today's Expenses</h1>

                        <div class="card p-4">
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                    <th>Date</th>
                                    <th>Fund Includes</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td>25 July 2024</td>
                                        <td>ICU</td>
                                        <td>5000</td>
                                        <td>Fund from xyz organization</td>
                                    </tr>
                                </tbody>
                            </table>
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
    </script>
@endpush
