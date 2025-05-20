@extends('layouts.app')
@section('mainContent')

    <style>
        .border-left-primary {
            border-left: .25rem solid #4e73df !important;
        }

        .border-left-success {
            border-left: .25rem solid #1cc88a !important;
        }

        .border-left-info {
            border-left: .25rem solid #36b9cc !important;
        }

        .border-left-warning {
            border-left: .25rem solid #f6c23e !important;
        }

        .custom-text-gray {
            color: #5a5c69 !important;
        }

        .patient-card-header {
            background-color: #819BE7 !important;
            color: white !important;
        }

        .ot-card-header {
            background-color: #EC7E74 !important;
            color: white !important;
        }
    </style>
    <div class="content-wrapper">
        <section class="content p-4">
            <div>
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-12 col-md-3">
                        <div class="card border-left-primary p-3 shadow">
                            <h3 class="mb-2 h6 text-uppercase text-primary font-weight-bold">Doctor</h3>
                            <p class="h4 font-weight-bold custom-text-gray">15</p>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-12 col-md-3">
                        <div class="card border-left-success p-3 shadow">
                            <h3 class="mb-2 h6 text-uppercase text-success font-weight-bold">Total Patient</h3>
                            <p class="h4 font-weight-bold custom-text-gray">564</p>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-12 col-md-3">
                        <div class="card border-left-info p-3 shadow">
                            <h3 class="mb-2 h6 text-uppercase text-info font-weight-bold">Nurse</h3>
                            <p class="h4 font-weight-bold custom-text-gray">34</p>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-12 col-md-3">
                        <div class="card border-left-warning p-3 shadow">
                            <h3 class="mb-2 h6 text-uppercase text-warning font-weight-bold">Total Staff</h3>
                            <p class="h4 font-weight-bold custom-text-gray">56</p>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="col-12 col-md-3">
                        <div class="card border-left-primary p-3 shadow">
                            <h3 class="mb-2 h6 text-uppercase text-primary font-weight-bold">Total Departments</h3>
                            <p class="h4 font-weight-bold custom-text-gray">7</p>
                        </div>
                    </div>

                    <!-- Card 6 -->
                    <div class="col-12 col-md-3">
                        <div class="card border-left-success p-3 shadow">
                            <h3 class="mb-2 h6 text-uppercase text-success font-weight-bold">Total Wards</h3>
                            <p class="h4 font-weight-bold custom-text-gray">12</p>
                        </div>
                    </div>

                    <!-- Card 7 -->
                    <div class="col-12 col-md-3">
                        <div class="card border-left-info p-3 shadow">
                            <h3 class="mb-2 h6 text-uppercase text-info font-weight-bold">Total Beds</h3>
                            <p class="h4 font-weight-bold custom-text-gray">500</p>
                        </div>
                    </div>

                    <!-- Card 8 -->
                    <div class="col-12 col-md-3">
                        <div class="card border-left-warning p-3 shadow">
                            <h3 class="mb-2 h6 text-uppercase text-warning font-weight-bold">Total Store Items</h3>
                            <p class="h4 font-weight-bold custom-text-gray">5000</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="row">
                        <div class="row justify-content-between col-12">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header patient-card-header">Today's Patient Status</div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <canvas id="patientsDoughnutChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header ot-card-header">Today's OT Status</div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <canvas id="operationsDoughnutChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Current ICU Patient</h2>
                                    <table class="table table-bordered table-striped" id="classList">
                                        <thead>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Gender</th>
                                        <th>Assigned Doctor</th>
                                        <th>ICU/HDU</th>
                                        <th>Bed No</th>
                                        </thead>

                                        <tbody>
                                        @foreach ($patientsData as $item)
                                            <tr>
                                                <td>{{ $item->patient->patient_id }}</td>
                                                <td>{{ $item->patient->name }}</td>
                                                <td>{{ $item->patient->gender }}</td>
                                                <td>{{ $item->doctor->name }}</td>
                                                <td>{{ $item->isICU == 1 ? "ICU" : "HDU" }}</td>
                                                <td>{{ $item->bed->bed_number }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="row justify-content-between col-12">
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Emergency Patient</h2>
                                    <table class="table table-bordered table-striped" id="classList2">
                                        <thead>
                                        <th>Patient ID</th>
                                        <th>Patient Name</th>
                                        <th>Age</th>
                                        <th>Mobile</th>
                                        <th>Patient Type</th>
                                        </thead>

                                        <tbody>

                                        @foreach ($patients as $item)
                                            <tr>
                                                <td>{{ $item->patient->patient_id }}</td>
                                                <td>{{ $item->patient->name }}</td>
                                                <td>{{ $item->patient->age }}</td>
                                                <td>{{ $item->patient->mobile }}</td>
                                                <td>{{ $item->patient->patient_type }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Doctor Wise Operation List</h2>

                                    <table class="table table-bordered table-striped" id="classList3">
                                        <thead>
                                        <th>Doctor ID</th>
                                        <th>Name</th>
                                        <th>Upcoming Operations</th>
                                        </thead>

                                        <tbody>
                                        @foreach($doctors as $item)
                                            <tr>
                                                <td>{{ $item->doctor->doctor_id }}</td>
                                                <td>{{ $item->doctor->name }}</td>
                                                <td>{{ $item->total_operation }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between col-12">
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Scheduled Pathology Test</h2>
                                    <table class="table table-bordered table-striped" id="classList4">
                                        <thead>
                                        <th>Patient ID</th>
                                        <th>Test Name</th>
                                        <th>Status</th>
                                        </thead>


                                        <tbody>
                                        @foreach ($tests as $item)
                                            <tr>
                                                <td>{{ $item->patient->patient_id }}</td>
                                                <td>{{ $item->service->name }}</td>
                                                <td class="capitalize">{{ $item->status }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Scheduled Radiology Test</h2>
                                    <table class="table table-bordered table-striped" id="classList5">
                                        <thead>
                                        <th>Patient ID</th>
                                        <th>Test Name</th>
                                        <th>Status</th>
                                        </thead>


                                        <tbody>
                                        @foreach ($radioTests as $item)
                                            <tr>
                                                <td>{{ $item->patient->patient_id }}</td>
                                                <td>{{ $item->service->name }}</td>
                                                <td class="capitalize">{{ $item->status }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between col-12">
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Available Ambulance</h2>
                                    <table class="table table-bordered table-striped" id="classList6">
                                        <thead>
                                        <th>SL</th>
                                        <th>Ambulance No</th>
                                        <th>Contact No</th>
                                        <th>Driver</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        </thead>

                                        <tbody>
                                        @foreach($availableAmbulances as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->car_number }}</td>
                                                <td>{{ $item->contact_number }}</td>
                                                <td>{{ $item->driver->name }}</td>
                                                <td class="capitalize">{{ $item->category }}</td>
                                                <td class="capitalize">{{ $item->type }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Ambulance On Route</h2>
                                    <table class="table table-bordered table-striped" id="classList7">
                                        <thead>
                                        <th>Ambulance No</th>
                                        <th>Contact No</th>
                                        <th>Driver</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        </thead>

                                        <tbody>
                                        @foreach($onRouteAmbulances as $item)
                                            <tr>
                                                <td>{{ $item->car_number }}</td>
                                                <td>{{ $item->contact_number }}</td>
                                                <td>{{ $item->driver->name }}</td>
                                                <td class="capitalize">{{ $item->category }}</td>
                                                <td class="capitalize">{{ $item->type }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between col-12">
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Natural Death List</h2>
                                    <table class="table table-bordered table-striped" id="classList8">
                                        <thead>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Date</th>
                                        </thead>

                                        <tbody>
                                        @foreach ($naturalDeaths as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->age }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Unnatural Death List</h2>
                                    <table class="table table-bordered table-striped" id="classList9">
                                        <thead>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Date</th>
                                        </thead>

                                        <tbody>
                                        @foreach ($unnaturalDeaths as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->age }}</td>
                                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between col-12">
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Material Request List</h2>
                                    <table class="table table-bordered table-striped" id="classList10">
                                        <thead>
                                        <th>Request ID</th>
                                        <th>Requested From</th>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>In Stock</th>
                                        <th>Qty</th>
                                        <th>Status</th>
                                        </thead>


                                        <tbody>
                                        @foreach ($requests as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td class="capitalize">{{ $item->requested_from }}</td>
                                                <td>{{ $item->product->product_id }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->product->inventory->quantity }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td class="capitalize">{{ $item->status }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive p-4">
                                    <h2 class="h2">Hospital Info</h2>
                                    <table class="table table-bordered table-striped" id="classList11">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Hospital Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Websites</th>
                                            <th>Address</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach ($hospitals as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->website }}</td>
                                                <td>{{ $item->address }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <!-- Date Range Selection -->
                            <div class="row mb-3">
                                <div class="col-auto">
                                    <label for="dateRange" class="form-label me-2">Select Range:</label>
                                    <select id="dateRange" class="form-control w-auto d-inline-block">
                                        <option value="7">Last 7 Days</option>
                                        <option value="10">Last 10 Days</option>
                                        <option value="30">Last 30 Days</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Patients Admitted -->
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-primary text-white text-center">
                                            <h5 class="mb-0">Patients Admitted</h5>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="patientsAdmittedChart" class="w-100"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <!-- Patients Released -->
                                <div class="col-md-6">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-success text-white text-center">
                                            <h5 class="mb-0">Patients Released</h5>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="patientsReleasedChart" class="w-100"></canvas>
                                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Initialize charts
        var ctxAdmitted = document.getElementById('patientsAdmittedChart').getContext('2d');
        var ctxReleased = document.getElementById('patientsReleasedChart').getContext('2d');

        // Function to create the line charts
        function createLineChart(ctx, label, bgColor, borderColor, initialData) {
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: label,
                        data: initialData,
                        backgroundColor: bgColor,
                        borderColor: borderColor,
                        borderWidth: 2,
                        tension: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    responsive: true
                }
            });
        }

        // Initial 7-day data
        var initialPatientsAdmittedData = [12, 19, 3, 5, 2, 3, 7];
        var initialPatientsReleasedData = [2, 3, 7, 12, 19, 3, 5];

        // Create all the charts with initial 7-day data
        var patientsAdmittedChart = createLineChart(ctxAdmitted, 'Patients Admitted', 'rgba(78, 115, 223, 0.1)', 'rgba(78, 115, 223, 1)', initialPatientsAdmittedData);
        var patientsReleasedChart = createLineChart(ctxReleased, 'Patients Released', 'rgba(28, 200, 138, 0.1)', 'rgba(28, 200, 138, 1)', initialPatientsReleasedData);

        // Update charts based on selected date range
        $('#dateRange').on('change', function () {
            let range = $(this).val();
            let labels = [];
            let patientsAdmittedData = [];
            let patientsReleasedData = [];

            // Generate data for the selected date range
            for (let i = range; i > 0; i--) {
                labels.push('Day ' + i);
                patientsAdmittedData.push(Math.floor(Math.random() * 20) + 1);
                patientsReleasedData.push(Math.floor(Math.random() * 20) + 1);
            }

            // Update each chart with new data
            patientsAdmittedChart.data.labels = labels;
            patientsAdmittedChart.data.datasets[0].data = patientsAdmittedData;
            patientsAdmittedChart.update();

            patientsReleasedChart.data.labels = labels;
            patientsReleasedChart.data.datasets[0].data = patientsReleasedData;
            patientsReleasedChart.update();
        });
    </script>


    <script>
        // Patients Doughnut Chart
        var ctx = document.getElementById('patientsDoughnutChart').getContext('2d');
        var patientsDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['ICU Patients', 'HDU Patients', 'POW Patients'],
                datasets: [{
                    data: [15, 10, 20],
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.7)',
                        'rgba(28, 200, 138, 0.7)',
                        'rgba(54, 185, 204, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });

        // Operations Doughnut Chart
        var ctx = document.getElementById('operationsDoughnutChart').getContext('2d');
        var operationsDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed OT', 'Incomplete OT'],
                datasets: [{
                    data: [30, 5],
                    backgroundColor: [
                        'rgba(246, 194, 62, 0.7)',
                        'rgba(231, 74, 59, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <script>
        $(function () {
            const tables = ["classList", "classList2", "classList3", "classList4", "classList5",
                "classList6", "classList7", "classList8", "classList9", "classList10", "classList11"];

            tables.forEach(function(table) {
                $("#" + table).DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "pageLength": 6,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
            });
        });
    </script>
@endpush
