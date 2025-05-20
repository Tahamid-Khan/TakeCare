@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Summary</h2>

                <div class="row p-4">
                    <!-- Monthly Sales Data Chart -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card p-2">
                            <h2 class="h5 font-weight-bold mb-2">Monthly Data</h2>
                            <canvas id="monthlySalesChart"></canvas>
                        </div>
                    </div>

                    <!-- Yearly Sales Data Chart -->
                    <div class="col-12 col-md-6 mb-4">
                        <div class="card p-2">
                            <h2 class="h5 font-weight-bold mb-2">Yearly Data</h2>
                            <canvas id="yearlySalesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            @include('store.summary-table')
        </section>
    </div>
@endsection
@push('custom_js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Sales Data Chart
        var ctx = document.getElementById('monthlySalesChart').getContext('2d');
        var monthlySalesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Monthly Data',
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


        // Yearly Sales Data Chart
        var ctx3 = document.getElementById('yearlySalesChart').getContext('2d');
        var yearlySalesChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['2018', '2019', '2020', '2021', '2022'],
                datasets: [{
                    label: 'Yearly Data',
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
