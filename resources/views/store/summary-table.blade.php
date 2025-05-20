<div class="row">
    <div class="col-12 col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between">
                    <h3 class="h3 pl-2">Monthly Details</h3>
                    <div><button class="btn btn-primary mr-3">Print Monthly Summary Audit</button></div>
                </div>
            </div>

            <div class="table-responsive p-4">
                <table class="table table-bordered table-striped" id="classList">
                    <thead>
                    <th>Month</th>
                    <th>Item Added</th>
                    <th>Item Removed</th>
                    </thead>

                    @php
                        $monthlyItems = [
                            (object) ['month' => 'January', 'item_added' => 10, 'item_removed' => 5],
                            (object) ['month' => 'February', 'item_added' => 15, 'item_removed' => 7],
                            (object) ['month' => 'March', 'item_added' => 20, 'item_removed' => 10],
                            (object) ['month' => 'April', 'item_added' => 25, 'item_removed' => 15],
                            (object) ['month' => 'May', 'item_added' => 30, 'item_removed' => 20],
                            (object) ['month' => 'June', 'item_added' => 35, 'item_removed' => 25],
                            (object) ['month' => 'July', 'item_added' => 40, 'item_removed' => 30],
                        ];
                    @endphp

                    <tbody>
                    @foreach ($monthlyItems as $item)
                        <tr>
                            <td>{{ $item->month }}</td>
                            <td>{{ $item->item_added }}</td>
                            <td>{{ $item->item_removed }}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-6">
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <h3 class="h3 pl-2">Yearly Details</h3>
                <div><button class="btn btn-primary">Print Yearly Summary Audit</button></div>
            </div>
        </div>
        <div class="table-responsive p-4">
            <table class="table table-bordered table-striped" id="classList2">
                <thead>
                <th>Year</th>
                <th>Item Added</th>
                <th>Item Removed</th>
                </thead>

                @php
                    $yearlyItems = [
                        (object) ['year' => '2021', 'item_added' => 100, 'item_removed' => 50],
                        (object) ['year' => '2022', 'item_added' => 150, 'item_removed' => 70],
                        (object) ['year' => '2023', 'item_added' => 200, 'item_removed' => 100],
                        (object) ['year' => '2024', 'item_added' => 250, 'item_removed' => 150],
                    ];
                @endphp

                <tbody>
                @foreach ($yearlyItems as $item)
                    <tr>
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->item_added }}</td>
                        <td>{{ $item->item_removed }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
    </div>
</div>
@push('custom_js')
    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
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
