@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <h2 class="card-header h2 font-weight-bold">Hospital Contact Info</h2>
                <div class="rounded border p-4 shadow-lg bg-white">
                    <div class="row">
                        <div class="col-12 p-4">
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Hospital Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Websites</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($hospitals as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->website }}</td>
                                            <td>{{ $item->address }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(function() {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "filter": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
