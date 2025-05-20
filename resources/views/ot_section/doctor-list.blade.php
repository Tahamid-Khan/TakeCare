@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <h1 class="h2 font-weight-bold pl-3">Doctor List</h1>
                        <div><a href="{{ route('ot-list-all') }}" class="btn btn-primary">View All Operations</a></div>
                    </div>
                </div>

                <div class="p-4 rounded-lg">
                    <table class="table table-bordered table-striped" id="classList">
                        <thead>
                        <th>Doctor ID</th>
                        <th>Name</th>
                        <th>Upcoming Operations</th>
                        <th>Actions</th>
                        </thead>

                        <tbody>
                        @foreach($doctors as $item)
                            <tr>
                                <td>{{ $item->doctor->doctor_id }}</td>
                                <td>{{ $item->doctor->name }}</td>
                                <td>{{ $item->total_operation }}</td>
                                <td>
                                    <a href="{{ route('ot.otList', ['id' => $item->doctor_id]) }}"
                                       class="btn btn-sm btn-info my-2" title="View">
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
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
