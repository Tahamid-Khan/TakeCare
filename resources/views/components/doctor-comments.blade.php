<div>
    <h1 class="mb-4 form-label h3">Doctor Comments</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="classList2">
            <thead>
            <th>Date Time</th>
            <th>Doctor ID</th>
            <th>Name</th>
            <th>Comments</th>
            </thead>

            <tbody>
            @foreach ($patientSummary as $item)
                <tr>

                    <td>{{ date('j F Y, h:i A', strtotime($item->date_time)) }}</td>
                    <td>{{ $item->doctor->doctor_id }}</td>
                    <td>{{ $item->doctor->name }}</td>
                    <td>{{ $item->summary }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('custom_js')
    <script>
        $(function () {
            $("#classList2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
