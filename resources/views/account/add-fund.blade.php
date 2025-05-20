@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">ADD Fund</h2>
                <div class="mb-4">
                    <div class="card-body">
                        <form action="" method="POST">@csrf
                            <div class="row">
                                <div class="col-12 col-md-4 form-group">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control"
                                           value="{{ \Carbon\Carbon::now()->toDateString() }}" id="date" name="date">
                                </div>

                                <div class="col-12 col-md-4 form-group">
                                    <label for="fund-type">Fund Type</label>
                                    <select class="form-control" id="fund-type" name="fund_id">
                                        <option selected disabled>Please Select</option>
                                        @foreach($fundDepartments as $item)
                                            <option class="capitalize"
                                                    value="{{ $item->id }}">{{ $item->fund->type }} Fund - {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-4 form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount">
                                </div>

                                <div class="col-12 form-group">
                                    <label for="note">Note</label>
                                    <textarea id="note" name="note" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Add Fund</button>

                        </form>
                    </div>
                </div>

                <div class="p-4">
                    <table class="table table-bordered table-striped" id="classList">
                        <thead>
                        <th>Date</th>
                        <th>Fund</th>
                        <th>Department</th>
                        <th>Amount</th>
                        <th>Note</th>
                        </thead>

                        <tbody>
                        @foreach($approvedFunds as $item)
                            <tr>
                                <td>{{ $item->date }}</td>
                                <td class="capitalize">{{ $item->fundDepartment->fund->type }}</td>
                                <td class="capitalize">{{ $item->fundDepartment->name }}</td>
                                <td><span class="taka-small">&#2547;</span>{{$item->amount}}</td>
                                <td>{{ $item->note }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
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
