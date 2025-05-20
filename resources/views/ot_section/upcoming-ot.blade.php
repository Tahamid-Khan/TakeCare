<div class="p-4 rounded-lg bg-white shadow-lg">
    <h1 class="mb-4 form-label h3">Incomplete Operations</h1>

    <table class="table table-bordered table-striped" id="upcoming-ot-table">
        <thead>
            <th>Patient ID</th>
            <th>Name</th>
            <th>Operation Name</th>
            <th>Date</th>
            <th>Doctor</th>
            <th>Payment Status</th>
        </thead>


        <tbody>
            @foreach ($upcomingOTPatients as $item)
                <tr>
                    <td>{{ $item->patient->patient_id }}</td>
                    <td>{{ $item->patient->name }}</td>
                    <td>{{ $item->service->name }}</td>
                    <td>{{ $item->operation_date }} {{ $item->operation_time }}</td>
                    <td>{{ $item->doctor->name }}</td>
                    <td class="capitalize"> {{ $item->invoice->payment_status ?? 'Not Available' }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>
</div>
@push('custom_js')
    <script>
        $(function() {
            $("#upcoming-ot-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
