<h3 class="h3">Patient Health Statistics</h3>
<div class="container my-4">
    <!-- Patient Health Statistics -->
    <div class="mb-6">
        <div class="">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col mt-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title h5">Heart Rate</h3>
                            <canvas id="heartRateChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title h5">Blood Pressure</h3>
                            <canvas id="bloodPressureChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title h5">Temperature</h3>
                            <canvas id="temperatureChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title h5">Respiratory Rate</h3>
                            <canvas id="respiratoryRateChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title h5">Oxygen Saturation</h3>
                            <canvas id="oxygenSaturationChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col mt-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title h5">Pain Level</h3>
                            <canvas id="painLevelChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Heart Rate Chart
    const heartRateCtx = document.getElementById('heartRateChart').getContext('2d');
    const heartRateChart = new Chart(heartRateCtx, {
        type: 'line',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
            datasets: [{
                label: 'Heart Rate (bpm)',
                data: [72, 75, 78, 74, 76],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });

    // Blood Pressure Chart
    const bloodPressureCtx = document.getElementById('bloodPressureChart').getContext('2d');
    const bloodPressureChart = new Chart(bloodPressureCtx, {
        type: 'bar',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
            datasets: [{
                    label: 'Systolic (mmHg)',
                    data: [120, 122, 121, 119, 120],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Diastolic (mmHg)',
                    data: [80, 82, 81, 79, 80],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }
            ]
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

    // Temperature Chart
    const temperatureCtx = document.getElementById('temperatureChart').getContext('2d');
    const temperatureChart = new Chart(temperatureCtx, {
        type: 'line',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
            datasets: [{
                label: 'Temperature (°F)',
                data: [98.6, 98.7, 98.5, 98.6, 98.7],
                borderColor: 'rgba(255, 159, 64, 1)',
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false
                }
            }
        }
    });

    // Respiratory Rate Chart
    const respiratoryRateCtx = document.getElementById('respiratoryRateChart').getContext('2d');
    const respiratoryRateChart = new Chart(respiratoryRateCtx, {
        type: 'bar',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
            datasets: [{
                label: 'Respiratory Rate (breaths/min)',
                data: [16, 17, 16, 15, 16],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
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

    // Oxygen Saturation Chart
    const oxygenSaturationCtx = document.getElementById('oxygenSaturationChart').getContext('2d');
    const oxygenSaturationChart = new Chart(oxygenSaturationCtx, {
        type: 'bar',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
            datasets: [{
                label: 'Oxygen Saturation (%)',
                data: [98, 97, 98, 99, 98],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
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

    // Pain Level Chart
    const painLevelCtx = document.getElementById('painLevelChart').getContext('2d');
    const painLevelChart = new Chart(painLevelCtx, {
        type: 'line',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'],
            datasets: [{
                label: 'Pain Level (0-10)',
                data: [3, 4, 2, 3, 3],
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10
                }
            }
        }
    });
</script>
