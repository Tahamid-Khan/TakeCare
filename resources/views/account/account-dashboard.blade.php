@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content">
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

                .pt-2rem {
                    padding-top: 2rem !important;
                }
            </style>
            <div class="mb-4 rounded-lg bg-white p-4 shadow-md">
                {{--                <h2 class="mb-4 text-xl font-semibold">Account Dashboard</h2>--}}

                <div class="row mb-4">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                    <h3 class="mb-2 h5">Available Balance</h3>
                                    <p class="value-card text-danger"><span class="taka-large">&#2547;</span>5000000</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-warning-light p-3 shadow">
                                    <h3 class="mb-2 h5">Board Fund</h3>
                                    <p class="value-card text-warning"><span class="taka-large">&#2547;</span>400000</p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-success-light p-3 shadow">
                                    <h3 class="mb-2 h5">Lab Fund</h3>
                                    <p class="value-card text-success"><span class="taka-large">&#2547;</span>0</p>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-primary-light p-3 shadow">
                                    <h3 class="mb-2 h5">Net Profit</h3>
                                    <p class="h3 font-weight-bold text-primary">-- %</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Print Monthly & Yearly State --}}
                <div class="col-12 card p-4">
                    <h3 class="mb-4 h3">Print Financial Statement</h3>

                    <form action="{{ route('account.statementPDF') }}" method="POST">@csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="year">Select Year:</label>
                                <select class="form-control" id="year" name="year">
                                    <option selected disabled>Please Select</option>
                                    <option>2024</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="month">Select Month:</label>
                                <select class="form-control" id="month" name="month">
                                    <option selected disabled>Please Select</option>
                                    <option>January</option>
                                    <option>February</option>
                                    <option>March</option>
                                </select>
                            </div>

                            <div class="col-md-3 form-group pt-2rem">
                                <button type="submit" class="btn btn-primary">Print Statement</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <!-- Monthly State-->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="bg-white p-4 rounded shadow">
                                <h2 class="h5 font-weight-bold mb-2">Monthly State</h2>
                                <canvas id="monthlyState"></canvas>
                            </div>
                        </div>

                        <!-- Yearly State -->
                        <div class="col-12 col-md-6 mb-4">
                            <div class="bg-white p-4 rounded shadow">
                                <h2 class="h5 font-weight-bold mb-2">Yearly State</h2>
                                <canvas id="yearlyState"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Previous Record --}}
                <div class="card">
                    <h3 class="card-header h3">Previous Records</h3>

                    <div class="p-3">
                        <form action="">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" class="form-control"
                                           value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="end_date" class="form-control"
                                           value="{{ request('end_date') }}">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="fund-includes">Fund Includes</label>
                                    <select class="form-control" id="fund-includes" name="fund_includes">
                                        <option selected disabled>Please Select</option>
                                        <option value="icu">ICU Bills</option>
                                        <option value="dressing">Dressing Bills</option>
                                        <option value="ambulance">Ambulance Bills</option>
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="fund">Fund</label>
                                    <select class="form-control" id="fund" name="fund">
                                        <option selected disabled>Please Select</option>
                                        <option value="board">Board</option>
                                        <option value="lab">Lab</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" name="submit" value="filter" class="btn btn-info">Filter</button>
                        </form>
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>Date</th>
                            <th>Fund</th>
                            <th>Fund Includes</th>
                            <th>Purpose</th>
                            <th>Income</th>
                            <th>Expenditure</th>
                            <th>Available Fund</th>
                            </thead>

                            <tbody>
                            <tr>
                                <td>25 July 2024</td>
                                <td>Board</td>
                                <td>ICU Billings</td>
                                <td>Oxygen Purpose</td>
                                <td>--</td>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            </tbody>
                        </table>
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
                "filter": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly State
        var ctx = document.getElementById('monthlyState').getContext('2d');
        var monthlyState = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Monthly State',
                    data: [201, 138, 120, 126, 138, 139],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        // Yearly State
        var ctx3 = document.getElementById('yearlyState').getContext('2d');
        var yearlyState = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['2018', '2019', '2020', '2021', '2022'],
                datasets: [{
                    label: 'Yearly State',
                    data: [1200, 1500, 1300, 1700, 1600],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
