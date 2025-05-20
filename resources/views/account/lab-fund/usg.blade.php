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
                <h2 class="mb-4 text-xl font-semibold">USG</h2>

                <div class="row mb-4">
                    <div class="col-12 col-lg-12">
                    <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                    <h3 class="mb-2 lg:text-lg font-semibold">Available Fund</h3>
                                    <p class="display-4 text-danger">50000</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-primary-light p-3 shadow">
                                    <h3 class="mb-2 lg:text-lg font-semibold">Previous Budget</h3>
                                    <p class="display-4 text-primary">50000</p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-success-light p-3 shadow">
                                    <h3 class="mb-2 lg:text-lg font-semibold">Total Expense</h3>
                                    <p class="display-4 text-success">40000</p>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-warning-light p-3 shadow">
                                    <h3 class="mb-2 lg:text-lg font-semibold">Remaining</h3>
                                    <p class="display-4 text-warning">---</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mb-4 p-2">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addExpense">Add Expense</button>
                </div>

                <table class="table table-bordered table-striped" id="classList">
                    <thead>
                        <th>Date</th>
                        <th>Purpose</th>
                        <th>Income</th>
                        <th>Expense</th>
                        <th>Available Fund</th>
                    </thead>

                    <tbody>
                        <tr>
                            <td>25 July 2024</td>
                            <td>Oxygen Purpose</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                        </tr>
                    </tbody>
                </table>


                {{-- Add Expense Popup Modal --}}
                <div class="modal fade" id="addExpense" tabindex="-1" role="dialog" aria-labelledby="addExpenseLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="" method="POST">@csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control"
                                            value="{{ \Carbon\Carbon::now()->toDateString() }}" id="date"
                                            name="date">
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label for="expenseAmount" class="form-label">Amount</label>
                                        <input type="number" class="form-control" name="expenseAmount" id="expenseAmount" placeholder="Expense Amount">
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label for="expensePurpose" class="form-label">Purpose</label>
                                        <textarea name="purpose" id="expensePurpose" cols="30" rows="5" class="form-control"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    </script>
@endpush
