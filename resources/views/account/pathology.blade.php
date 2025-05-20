@extends('layouts.app')

@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <div class="content-wrapper" style="background-color:white;">
       <section class="content">
           <div class="container-fluid">
               <div class="row">
               <div class="col-md-4">
               <div class="card">
                    <div class="card-body btn-info">
                        <h5 class="card-title">Today's Paid Amount</h5>
                        <p class="card-text text-bold" id="todayPaidAmount" style="font-size: 20px;">{{ number_format($todayPaidAmount ?? 0) }} <span style="font-size: 16px;">TK</span></p>
                    </div>
                </div>

                    <div class="card">
                        <div class="card-body btn-success">
                            <h5 class="card-title">Today's Cash Paid Amount</h5>
                            <p class="card-text text-bold" id="todayCashAmount"  style="font-size: 20px;">{{ $todayCashAmount ?? 0 }} TK</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body btn-secondary">
                            <h5 class="card-title">Today's Bkash Paid Amount</h5>
                            <p class="card-text text-bold" id="todayBkashAmount"  style="font-size: 20px;">{{ $todayBkashAmount ?? 0 }} TK</p>
                        </div>
                    </div>
                </div>

            <!-- Month-wise Paid Amounts -->
            <div class="col-md-3">
                <div class="card">
                        <div class="card-body" style="max-height: 300px; overflow-y: auto; background-color:light-yellow">
                            <h5 class="card-title">Month-wise Paid Amounts </h5>
                            <div class="form-group">
                                <label for="monthSelector">Select Month:</label>
                                <select class="form-control" id="monthSelector" name="monthSelector" onchange="updateMonthlyPayments()">
                                    <option value="0">All Months</option>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                    @endfor
                                </select>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th> Paid</th>
                                    </tr>
                                </thead>
                                <tbody id="monthPaidTable">
                                    <!-- Dynamically populate data here -->
                                </tbody>
                            </table>
                        </div>
                  
                </div>
            </div>

            <!-- Monthly Payments Trend Graph -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Monthly Payments Trend</h5>
                        <canvas id="monthlyPaymentsChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        
                   <div class="col-12">
                       <div class="card">
                        <!-- Date filter form -->
                        <form action="{{ route('account.pathology') }}" method="GET">
                            @csrf
                            <div class="row ml-2 mt-2">
                                <div class="col-md-3">
                                <label for="doctor">Doctor</label>
                                    <select class="form-control" name="doctor" id="doctor" autofocus>
                                        <option value="" selected disabled hidden>---</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ request('doctor') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="form-group row">
                                <div class="col-12 mt-4 text-right">
                                    <button type="submit"  name="submit" value="filter" class="btn btn-info">Filter</button>
                                    <a class="btn btn-secondary mr-2" href="{{route('account.pathology')}}">Reset</a>
                                    <button type="submit"  name="submit" value="pdf" class="btn btn-danger">PDF</button>
                                    <button type="submit"  name="submit" value="excel" class="btn btn-success">Excel</button>
                                </div>
                            </div>
                            </div>
                        </form>
                           <div class="card-header">
                               <h3 class="card-title">Pathology Lists</h3>
                           </div>
                           <div class="card-body">
                               <table class="table table-bordered table-striped" id="classList">
                               <thead>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>patientId</th>
                                        <th>Doctor</th>
                                        <th>Info</th>
                                        <th>Reference</th>
                                        <th>Test Details</th>
                                        <th>Remark</th>
                                        <th>Created Date</th>
                                        <th>Delivery</th>
                                        <th>Account</th>
                                        <th>Total</th>
                                        <th>Discount </th>
                                        <th>Payable</th>
                                        <th>Total Paid</th>
                                        <th>Due</th>
                                    </thead>

                                   <tbody>
                                   @php
                                       $i=1;
                                   @endphp
                                   @foreach($lists as $k=>$testList)
                                       <tr>
                                           <td>{{$testList->pathology_id}}</td>
                                           <td>@if($testList->type == 0)
                                           OPD
                                           @else
                                           IPD
                                           @endif
                                            </td>
                                            <td>{{$testList->patient->patient_id}}</td>
                                            <td>{{$testList->doctor->name}}</td>
                                           <td>{{$testList->name}}
                                           {{$testList->mobile}}
                                           {{$testList->gender}},
                                           Age:{{$testList->age}}
                                           </td>
                                           <td>{{$testList->reference}}</td>
                                           <td>
                                            @php
                                                $testListDetails = json_decode($testList->test_list_details);
                                            @endphp

                                            @foreach ($testListDetails as $test)
                                                <p>{{ $test->name }},
                                                {{ $test->price }}TK, {{ $test->days }}Days</p>
                                            @endforeach
                                        </td>
                                           <td>{{$testList->remark}}</td>
                                           <td>{{$testList->date}}</td>
                                           <td>{{$testList->delivery_date}}
                                            Time: {{$testList->delivery_time}}
                                           </td>
                                           <td>
                                           @if($testList->account == 1)
                                           Cash
                                           @else
                                           Bkash
                                           @endif
                                           </td>
                                            <td>{{$testList->total}} TK</td>
                                            <td>{{$testList->discount}} %</td>
                                            <td>{{$testList->payable}} TK</td>
                                           <td>{{$testList->paid}} TK</td>
                                           <td>{{$testList->due}} TK</td>
                                       </tr>
                                   @endforeach
                                   </tbody>
                               </table>
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
        // Mock data for demonstration purposes
        const todayPaidAmount = @json($todayPaidAmount);
        const monthPaidData = @json($monthPaidData);
    
        // Set today's paid amount
        document.getElementById('todayPaidAmount').innerText = `${todayPaidAmount} TK`;

        // Populate month-wise paid amounts table
        const monthPaidTable = document.getElementById('monthPaidTable');
        monthPaidData.forEach(entry => {
            const row = monthPaidTable.insertRow();
            row.innerHTML = `<td>${entry.month}</td><td>${entry.amount} TK</td>`;
        });


        

        // Draw monthly payments trend chart
        const ctx = document.getElementById('monthlyPaymentsChart').getContext('2d');
        const monthlyPaymentsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthPaidData.map(entry => entry.month),
                datasets: [{
                    label: 'Monthly Payments',
                    data: monthPaidData.map(entry => entry.amount),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
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

        function updateMonthlyPayments() {
            const monthSelector = document.getElementById('monthSelector');
            const selectedMonth = parseInt(monthSelector.value);

            // Filter data based on the selected month
            const filteredMonthPaidData = (selectedMonth === 0) ? monthPaidData :
                monthPaidData.filter(entry => new Date(entry.month + " 1, 2000").getMonth() + 1 === selectedMonth);

            // Update the table
            updateMonthPaidTable(filteredMonthPaidData);

            // Update the chart
            updateMonthlyPaymentsChart(filteredMonthPaidData);
        }

        function updateMonthPaidTable(data) {
            // Clear existing rows
            monthPaidTable.innerHTML = '';

            // Populate month-wise paid amounts table
            data.forEach(entry => {
                const row = monthPaidTable.insertRow();
                row.innerHTML = `<td>${entry.month}</td><td>$${entry.amount}</td>`;
            });
        }

        function updateMonthlyPaymentsChart(data) {
            // Update the chart data
            monthlyPaymentsChart.data.labels = data.map(entry => entry.month);
            monthlyPaymentsChart.data.datasets[0].data = data.map(entry => entry.amount);

            // Update the chart
            monthlyPaymentsChart.update();
        }
    </script>
    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
        function deleteConfirm(id)
        {
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are you sure to delete this record!")) {
                $.ajax({
                    url: 'pathology/delete/' + id,
                    type: 'get',
                    success: function (status)
                    {
                        if(status.status==1){
                            window.location.reload();
                        }
                    }
                })
            }
        }
    </script>
@endpush
