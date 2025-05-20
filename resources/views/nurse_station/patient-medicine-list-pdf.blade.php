<style type="text/css">
    #client0rder {
        display: table;
        width: 100%;
        font-size: 11px;
        border-collapse: collapse;
    }

    #client0rder,
    td,
    th {
        border: 1px solid black;
        font-size: 14px;
    }
</style>
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h1 class="card-title">Hospital Invoice</h1>
            <p class="text-muted">Patient Medicine List</p>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <h2 class="h4">Patient Details</h2>
                <p><strong>Name:</strong> {{ $patient->name }}</p>
                <p><strong>Patient ID:</strong> {{ $patient->patient_id }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
            </div>

            <div class="mb-4">
                <h2 class="h4">Medicine List</h2>
                <table class="table table-bordered" id="client0rder">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Schedule</th>
                            <th>Taking time</th>
                            <th>Dose</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    @php $i = 1; @endphp
                    <tbody>
                        @foreach ($patient->patientMedicine as $item)
                            @php
                                $schedule = json_decode($item->schedule);
                            @endphp


                            <tr class="border-bottom mr-3 text-capitalize">
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->medicine_name }}</td>

                                <td>
                                    <small>
                                        {{ in_array('morning', $schedule) ? '1+' : '0+' }}
                                        {{ in_array('afternoon', $schedule) ? '1+' : '0+' }}
                                        {{ in_array('evening', $schedule) ? '1' : '0' }}

                                    </small>
                                </td>
                                <td>
                                    <small>{{ $item->taking_time }} Meal</small>
                                </td>
                                <td>
                                    <small>{{ $item->dose }}</small>
                                </td>
                                <td>
                                    <small>{{ $item->duration }}</small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
