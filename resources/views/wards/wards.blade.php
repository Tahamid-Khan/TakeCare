@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .w-45 {
            width: 45%;
        }
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <h2 class=" h2 font-weight-bold">Wards</h2>
                            <div>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addWard">Add New</button>
                            </div>
                        </div>
                    </div>

                    <div class="p-3">
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>No</th>
                            <th>Ward Name</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th>Total Beds</th>
                            <th>Action</th>
                            </thead>

                            @php $i = 1; @endphp
                            <tbody>
                            @foreach ($wards as $item)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="capitalize">{{ $item->location }}</td>
                                    <td class="capitalize">{{ $item->type }}</td>
                                    <td>{{ $item->total_beds }}</td>
                                    <td class="row mr-0">
                                        <button type="button" class="btn btn-sm btn-success mr-2" id="test" data-toggle="modal"
                                                data-target="#toggleDiv" data-id={{ $item->id }}
                                            data-name="{{ $item->name }}" data-location="{{ $item->location }}"
                                                data-type="{{ $item->type }}" data-bed="{{ $item->total_beds }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <form action="{{ route('ward-bed.delete-ward', ['id' => $item->id]) }}"
                                              method="POST">@csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                            @endforeach
                            </tbody>



                            {{-- Ward Edit Popup Modal --}}
                            <div class="modal fade" id="toggleDiv" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('ward-bed.edit-ward') }}" method="POST">@csrf
                                            <div class="modal-header">
                                                <h3 class="h3" id="exampleModalLabel">Update Ward No</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                {{-- <input type="number" name="ward_id" value="1"> --}}
                                                <input type="hidden" name="ward_id" id="ward-id">
                                                <div class="form-group">
                                                    <label for="ward_no">Ward name</label>
                                                    <input type="text" class="form-control" id="ward_no" name="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="location">Location</label>
                                                    <input type="text" class="form-control" id="location" name="location">
                                                </div>

                                                <div class="form-group">
                                                    <label for="ward-type">Type</label>
                                                    <input type="text" class="form-control" id="ward-type" name="type">
                                                </div>

                                                <div class="form-group">
                                                    <label for="bed_number">Total number of beds</label>
                                                    <input type="number" class="form-control" id="bed_number"
                                                           name="bed_number">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Add modal for wards --}}
                            <div class="modal fade" id="addWard" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('ward-bed.add-ward') }}" method="POST">@csrf
                                            <div class="modal-header">
                                                <h3 class="h3" id="exampleModalLabel">Add Ward</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group" id="ward_no">
                                                    <label for="add-ward-name">Ward name</label>
                                                    <input type="text" class="form-control" name="name"
                                                           id="add-ward-name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="add-ward-location">Location</label>
                                                    <input type="text" class="form-control" id="add-ward-location"
                                                           name="location">
                                                </div>
                                                <div class="form-group">
                                                    <label for="add-ward-type">Type</label>
                                                    <input type="text" class="form-control" id="add-ward-type"
                                                           name="type">
                                                </div>

                                                <div class="form-group">
                                                    <label for="add-ward-bed-number">Total number of beds</label>
                                                    <input type="number" class="form-control" id="add-ward-bed-number"
                                                           name="bed_number">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </table>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $('#toggleDiv').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var location = button.data('location');
            var type = button.data('type');
            var total_beds = button.data('bed');
            // console.log(id, name, location, total_beds);

            // Update the modal's content.
            var modal = $(this);
            modal.find('.modal-body input[name="ward_id"]').val(id);
            modal.find('.modal-body input[name="name"]').val(name);
            modal.find('.modal-body input[name="location"]').val(location);
            modal.find('.modal-body input[name="type"]').val(type);
            modal.find('.modal-body input[name="bed_number"]').val(total_beds);
        });
    </script>
@endpush
