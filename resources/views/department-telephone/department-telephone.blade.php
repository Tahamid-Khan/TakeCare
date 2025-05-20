@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">All Department Telephone Numbers</h2>

                <div class="p-4">
                    <div class="">
                        <div class="">
                            <h3 class="py-3 h3">Telephone List</h3>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>SL</th>
                                <th>Department Name</th>
                                <th>Telephone Number</th>
                                </thead>

                                <tbody>
                                    @foreach ($lists as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <a href="tel:{{ $item->phone_number }}">{{ $item->phone_number }}</a></td>
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
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                'sort': false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
