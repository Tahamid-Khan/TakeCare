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

        .value-card {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.39;
        }

        .shadow-md {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>


    <div class="content-wrapper">
        <section class="content">
            <div class="mb-4 rounded-lg bg-white p-4 shadow-md">
                <h2 class="h2 font-weight-bold">{{ $fundDepartment->name }} Bills</h2>

                <div class="row mb-4">
                    <!-- Card 1 -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="rounded-lg bg-danger-light p-3 shadow">
                            <h3 class="mb-2 h5">Available Fund</h3>
                            <p class="value-card text-danger"><span
                                    class="taka-large">&#2547;</span>{{ $fundDepartment->balance }}</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="rounded-lg bg-primary-light p-3 shadow">
                            <h3 class="mb-2 h5">Previous Budget</h3>
                            <p class="value-card text-primary"><span
                                    class="taka-large">&#2547;</span>{{ $budget  ? $budget->amount : '0' }}</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="rounded-lg bg-success-light p-3 shadow">
                            <h3 class="mb-2 h5">Total Expense</h3>
                            <p class="value-card text-success"><span
                                    class="taka-large">&#2547;</span>{{ $budget  ? $budget->expense : '0' }}</p>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-12 col-md-3 mb-4">
                        <div class="rounded-lg bg-warning-light p-3 shadow">
                            <h3 class="mb-2 h5">Remaining</h3>
                            <p class="value-card text-warning"><span
                                    class="taka-large">&#2547;</span>{{ $budget ? number_format($budget->amount - $budget->expense, 2, '.', ',')   : '0' }}
                            </p>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <h3 class="h3">Most Recent Expenses</h3>
                            <div>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addExpense">Add
                                    Expense
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="p-4">
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>Date</th>
                            <th>Purpose</th>
                            <th>Expense</th>
                            </thead>

                            <tbody>
                            @foreach($expenses as $item)
                                <tr>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->purpose }}</td>
                                    <td><span
                                            class="taka-small">&#2547;</span>{{ number_format($item->amount, 2, '.', ',') }}
                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{-- Add Expense Popup Modal --}}
                        <div class="modal fade" id="addExpense" tabindex="-1" role="dialog"
                             aria-labelledby="addExpenseLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('account.add-expense') }}" method="POST">@csrf
                                        <input type="hidden" name="budget_id"
                                               value="{{ $budget ? $budget->id : null }}">
                                        <input type="hidden" name="department_id" value="{{ $fundDepartment->id }}">
                                        <div class="modal-header">
                                            <h3 class="h3" id="exampleModalLabel">Add Expense</h3>
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
                                                <input type="number" class="form-control" name="expense"
                                                       id="expenseAmount"
                                                       placeholder="Expense Amount">
                                            </div>

                                            <div class="mb-3 form-group">
                                                <label for="expensePurpose" class="form-label">Purpose</label>
                                                <textarea name="purpose" id="expensePurpose" cols="30" rows="5"
                                                          class="form-control"></textarea>
                                            </div>

                                            <button type="submit"
                                                    class="btn btn-primary" {{ $budget ? '' : 'disabled' }}>Add
                                            </button>
                                            @if(!$budget)
                                                <p class="text-danger mt-2">*No recent Budget set to add expense</p>
                                            @endif
                                        </div>
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
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        $(function () {
            $("#classList-2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
