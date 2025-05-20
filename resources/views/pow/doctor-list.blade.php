@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <h1 class="card-header h3 font-weight-bold">Doctor List</h1>
            <div class="p-4 rounded-lg bg-white shadow-lg">

                <table class="table table-bordered table-striped" id="classList">
                    <thead>
                    <th>Doctor ID</th>
                    <th>Name</th>
                    {{--<th>Contact Number</th>--}}
                    <th>Total Assigned Patients</th>
                    <th>Actions</th>
                    </thead>


                    <tbody>
                    @foreach ($doctorList as $item)
                        <tr>
                            <td>{{ $item->doctor->doctor_id }}</td>
                            <td>{{ $item->doctor->name }}</td>
                            {{--<td>{{ $item->contactNumber }}</td>--}}
                            <td>{{ $item->total_assigned_patient }}</td>
                            <td>
                                <a href="{{ route('pow.single-doc-patient-list', ['id' =>$item->doctor_id ]) }}" class="btn btn-sm btn-info my-2" title="View">
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
