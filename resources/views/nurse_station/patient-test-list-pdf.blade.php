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
            <h1 class="card-title">Patient Medical Test List</h1>
            <p class="text-muted">Medical Test Details</p>
        </div>

        <div class="card-body">
            <div class="mb-4">
                <h2 class="h4">Patient Details</h2>
                <p><strong>Name:</strong> {{ $patient->name }}</p>
                <p><strong>Patient ID:</strong> {{ $patient->patient_id }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
            </div>

            <div class="mb-4">
                <h2 class="h4">Medical Test List</h2>
                <table class="table table-bordered" id="client0rder">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Test Name</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Results Summary</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Test</td>
                            <td>Completed</td>
                            <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td>
                            <td>Hemoglobin: 13.5 g/dL</td>
                            <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptates, labore.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-end">
                <p class="text-muted">Please consult your doctor for further details.</p>
            </div>
        </div>
    </div>
</div>
