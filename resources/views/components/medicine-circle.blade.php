<div class="">
    <h3 class="h3 mb-4">Medicine Circle</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="classList2">
            <thead>
            <th>Date</th>
            <th>Morning</th>
            <th>Afternoon</th>
            <th>Evening</th>
            <th>Status</th>
            </thead>


            <tbody>
            @foreach ($medicineServeLogs as $key => $item)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $item['morning']  }}</td>
                    <td>{{ $item['afternoon']  }}</td>
                    <td>{{ $item['evening'] }}</td>
                    {{--                            <td>{{ $item['morning'] == 'Yes' && $item['afternoon'] == 'Yes'  && $item['evening'] == 'Yes' ? 'Complete': ( $today !== $key  ? 'Expired' : 'Pending') }}</td>--}}
                    <td><span class="{{ $item['morning'] == 'Yes' && $item['afternoon'] == 'Yes' && $item['evening'] == 'Yes' ? 'px-2 py-1 bg-success rounded' : ($today !== $key ? 'px-2 py-1 bg-danger rounded' : 'px-2 py-1 bg-warning rounded') }}">
                                {{ $item['morning'] == 'Yes' && $item['afternoon'] == 'Yes' && $item['evening'] == 'Yes' ? 'Complete' :
                                    ($today !== $key ? 'Expired' : 'Pending') }}
                                </span>
                    </td>

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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "order": [[0, "desc"]]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
