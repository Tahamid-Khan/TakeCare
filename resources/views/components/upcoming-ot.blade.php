<div class="p-4 rounded-lg bg-white shadow-lg">
    <h1 class="mb-4 form-label h3">Incomplete Operations</h1>

    <table class="table table-bordered table-striped" id="upcoming-ot-table">
        <thead>
        <th>Patient ID</th>
        <th>Name</th>
        <th>Operation Name</th>
        <th>Date</th>
        <th>Doctor</th>
        <th>Actions</th>
        </thead>


        <tbody>
        @foreach ($upcomingOTPatients as $item)
            <tr>
                <td>{{ $item->patient->patient_id }}</td>
                <td>{{ $item->patient->name }}</td>
                <td>{{ $item->service->name }}</td>
                <td>{{ $item->operation_date }}  {{ \Carbon\Carbon::parse($item->operation_time)->format('g:i A')}}</td>
                <td>{{ $item->doctor->name }}</td>
                <td>
                    <a href="{{ route('ot.view', ['id'=>$item->id]) }}"
                       class="btn btn-sm btn-info my-2" title="View">
                        <i class="fas fa-eye" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
@push('custom_js')
    <script>
        $(function () {
            $("#upcoming-ot-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
