@extends('layouts.app')
@push('custom_css')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
@endpush

@section('mainContent')
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

        .text-lg {
            font-size: 1.25rem;
        }

        .font-semibold {
            font-weight: 600;
        }

        .value-card {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.39;
        }

        .budget-report h5 {
            margin-bottom: 1rem;
        }

        .budget-report .budget-amount {
            color: #28a745;
            font-weight: bold;
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="p-4 rounded-lg bg-white shadow-lg">
                <div class="row mb-4">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                    <h3 class="mb-2 h5">Doctor</h3>
                                    <p class="h3 font-weight-bold text-danger">15</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-primary-light p-3 shadow">
                                    <h3 class="mb-2 h5">Total Patient</h3>
                                    <p class="h3 font-weight-bold text-primary">2353</p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-success-light p-3 shadow">
                                    <h3 class="mb-2 h5">Operation</h3>
                                    <p class="h3 font-weight-bold text-success">2</p>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-warning-light p-3 shadow">
                                    <h3 class="mb-2 h5">Nurse</h3>
                                    <p class="h3 font-weight-bold text-warning">50</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                    <h3 class="mb-2 h5">Total Staff</h3>
                                    <p class="h3 font-weight-bold text-danger">15</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-primary-light p-3 shadow">
                                    <h3 class="mb-2 h5">Total Rooms</h3>
                                    <p class="h3 font-weight-bold text-primary">20</p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-success-light p-3 shadow">
                                    <h3 class="mb-2 h5">Total Wards</h3>
                                    <p class="h3 font-weight-bold text-success">10</p>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-warning-light p-3 shadow">
                                    <h3 class="mb-2 h5">Total Beds</h3>
                                    <p class="h3 font-weight-bold text-warning">500</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Card 1 -->
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-danger-light p-3 shadow">
                                    <h3 class="mb-2 h5">Appointments</h3>
                                    <p class="h3 font-weight-bold text-danger">130+</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
{{--                            <div class="col-12 col-md-3 mb-4">--}}
{{--                                <div class="rounded-lg bg-primary-light p-3 shadow">--}}
{{--                                    <h3 class="mb-2 lg:text-lg font-semibold">Total Earnings</h3>--}}
{{--                                    <p class="display-4 text-primary"><span class="taka-large">&#2547;</span>4590</p>--}}
{{--                                </div>--}}
{{--                            </div>                            --}}
                            <div class="col-12 col-md-3 mb-4">
                                <div class="rounded-lg bg-primary-light p-3 shadow">
                                    <h3 class="text-lg font-semibold">Total Earnings</h3>
                                    <div class="d-flex align-items-center text-primary">
                                        <div class="taka-large">&#2547;</div>
                                        <div class="value-card">4590</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row mb-4">
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Budget Report</h5>
                                        <canvas id="budgetChart" width="200" height="200"></canvas>
                                        <div class="row mt-3 justify-content-between">
                                            <p class="col-6">Quarter Budget</p>
                                            <p class="col-6 text-end fw-bold"><span class="taka-small">&#2547;</span>35,604.00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-8 col-xl-9">
                                <h1 class="mb-4 form-label text-lg font-semibold">Today's Operation List</h1>
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                    <th>SL</th>
                                    <th>Doctor's Name</th>
                                    <th>Schedule</th>
                                    <th>Operation Type</th>
                                    <th>Operation Room</th>
                                    </thead>


                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dr. Rahim khan</td>
                                        <td>10:00 AM - 12:00 PM</td>
                                        <td>Heart Surgery</td>
                                        <td>Room 1</td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>Dr. Jane Doe</td>
                                        <td>12:00 PM - 2:00 PM</td>
                                        <td>Brain Surgery</td>
                                        <td>Room 2</td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>Dr. John Doe</td>
                                        <td>2:00 PM - 4:00 PM</td>
                                        <td>Eye Surgery</td>
                                        <td>Room 3</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-12">
                            <h1 class="mb-4 form-label text-lg font-semibold">Available Doctor List</h1>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>SL</th>
                                <th>Doctor's ID</th>
                                <th>Doctor's Name</th>
                                <th>Department</th>
                                <th>Type</th>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>DR-001</td>
                                    <td>Dr. John Doe</td>
                                    <td>Cardiology</td>
                                    <td>Permanent</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row ">
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body text-center">
                                        <h2 class="card-title">Earning Reports</h2>
                                        <p class="text-success">5.44% <i class="bi bi-arrow-up-right"></i> +2.4%</p>
                                        <canvas id="earningChart" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Inpatient vs Outpatient Trend</h5>
                                        <canvas id="myChart"></canvas>
                                    </div>
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
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>
    <!-- Page specific script -->
    <script></script>

    <script>
        const budgetCtx = document.getElementById('budgetChart').getContext('2d');
        const budgetChart = new Chart(budgetCtx, {
            type: 'doughnut',
            data: {
                labels: ['Total Spent', 'Received'],
                datasets: [{
                    data: [18470, 31640],
                    backgroundColor: ['#e0e0e0', '#4e73df'],
                    borderColor: ['#e0e0e0', '#4e73df'],
                    borderWidth: 1
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                }).format(context.raw);
                                return label;
                            }
                        }
                    }
                },
                elements: {
                    center: {
                        text: '40% Received',
                        color: '#4e73df',
                        fontStyle: 'Arial',
                        sidePadding: 20
                    }
                }
            }
        });

        const barCtx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Week 42', 'Week 43', 'Week 44', 'Week 45', 'Week 46', 'Week 47', 'Week 48', 'Week 49',
                    'Week 50', 'Week 51', 'Week 52', 'Week 53'
                ],
                datasets: [{
                    label: 'Inpatients',
                    data: [2200, 1800, 1600, 1800, 1000, 2200, 2000, 1800, 2200, 1800, 1600, 2200],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Outpatients',
                    data: [3000, 2800, 2600, 2800, 2000, 2400, 2200, 2000, 2400, 2000, 1800, 2400],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
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


        // Line chart for earnings
        const earningCtx = document.getElementById('earningChart').getContext('2d');
        const data = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Earnings',
                data: [30, 40, 35, 50, 45, 25, 65, 55, 45, 60, 40, 35],
                fill: true,
                backgroundColor: 'rgba(144, 202, 249, 0.2)',
                borderColor: 'rgba(72, 114, 212, 1)',
                tension: 0.4
            }]
        };

        const earningChart = new Chart(earningCtx, {
            type: 'line',
            data: data,
            options: {
                plugins: {
                    legend: {
                        display: true
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + new Intl.NumberFormat('en-US', {
                                    style: 'currency',
                                    currency: 'USD'
                                }).format(context.raw) + 'k';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 6,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
