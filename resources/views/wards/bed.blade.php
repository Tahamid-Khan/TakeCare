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
                            <h2 class="h2 font-weight-bold">Beds</h2>
                            <div>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addBed">Add New
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="p-3">
                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            <th>No</th>
                            <th>Ward Name</th>
                            <th>Bed No</th>
                            <th>Bed Type</th>
                            <th>Bed Status</th>
                            <th>Action</th>
                            </thead>

                            <tbody>
                            @foreach ($beds as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->ward->name }}</td>
                                    <td>{{ $item->bed_number }}</td>
                                    <td>{{ $item->bed_type }}</td>
                                    <td class="capitalize">{{ $item->bed_status }}</td>
                                    <td class="row mr-0">
                                        <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#toggleDiv"
                                                data-id="{{ $item->id }}" data-ward="{{ $item->ward->id }}"
                                                data-bed="{{ $item->bed_number }}" data-type="{{ $item->bed_type }}"
                                                data-status="{{ $item->bed_status }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <form action="{{ route('ward-bed.delete-bed', ['id' => $item->id]) }}"
                                              method="POST" onsubmit="return confirm('Are you sure you want to delete this bed?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>


                            {{-- Bed Edit Popup Modal --}}
                            <div class="modal fade" id="toggleDiv" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('ward-bed.edit-bed') }}" method="POST">@csrf
                                            <div class="modal-header">
                                                <h3 class="h3" id="exampleModalLabel">Update Bed Info</h3>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <input type="hidden" name="bed_id" id="bed-id">
                                                <div class="form-group">
                                                    <label for="bed_number">Bed No</label>
                                                    <input type="number" class="form-control" id="bed_number"
                                                           name="bed_number">
                                                </div>

                                                <div class="form-group">
                                                    <label for="ward_id">Ward No</label>
                                                    <select class="form-control" id="ward_id" name="ward_id">
                                                        <option selected disabled>Please Select</option>
                                                        @foreach ($wards as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="bed_type">Bed Type</label>
                                                    <input type="text" class="form-control" id="bed_type"
                                                           name="bed_type">
                                                </div>

                                                <div class="form-group">
                                                    <label for="bed_status">Bed Status</label>
                                                    <select class="form-control" id="bed_status" name="bed_status">
                                                        <option selected disabled>Please Select</option>
                                                        <option value="occupied">Occupied</option>
                                                        <option value="empty">Empty</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Add modal for department --}}
                            <div class="modal fade" id="addBed" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('ward-bed.add-bed') }}" method="POST">@csrf
                                            <div class="modal-header">
                                                <h3 class="h3" id="exampleModalLabel">Add Bed</h3>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="add-ward-no">Ward Name <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="add-ward-no" name="ward_id" required>
                                                        <option value="">Please Select Ward First</option>
                                                        @foreach ($wards as $item)
                                                            <option value="{{ $item->id }}" data-total-beds="{{ $item->total_beds }}">{{ $item->name }} ({{ $item->total_beds }} beds capacity)</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group" id="bed_no">
                                                    <label for="add-bed-no">Bed No</label>
                                                    <input type="number" class="form-control" name="bed_number"
                                                           id="add-bed-no" required disabled placeholder="Select ward first">
                                                    <small class="form-text text-muted" id="bed-info"></small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="add-bed-type">Bed Type</label>
                                                    <input type="text" class="form-control" id="add-bed-type"
                                                           name="bed_type" required placeholder="e.g., ICU, General, HDU">
                                                </div>

                                                <div class="form-group">
                                                    <label for="add-bed-status">Bed Status</label>
                                                    <select class="form-control" id="add-bed-status" name="bed_status" required>
                                                        <option value="empty" selected>Empty</option>
                                                        <option value="occupied">Occupied</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" id="add-bed-submit" disabled>Add</button>
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
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $('#toggleDiv').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var ward = button.data('ward');
            var bed = button.data('bed');
            var type = button.data('type');
            var status = button.data('status');
            console.log(id, ward, bed, type, status);

            // Update the modal's content.
            var modal = $(this);
            modal.find('.modal-body input[name="bed_id"]').val(id);
            modal.find('.modal-body input[name="bed_number"]').val(bed);
            modal.find('.modal-body select[name="ward_id"]').val(ward);
            modal.find('.modal-body input[name="bed_type"]').val(type);
            modal.find('.modal-body select[name="bed_status"]').val(status);
        });

        // Handle ward selection in Add Bed modal
        $('#add-ward-no').on('change', function() {
            var wardId = $(this).val();
            var wardName = $(this).find('option:selected').text();
            
            if (wardId) {
                // Show loading state
                $('#add-bed-no').prop('disabled', true).val('').attr('placeholder', 'Loading...');
                $('#bed-info').text('Fetching bed information...');
                $('#add-bed-submit').prop('disabled', true);
                
                // Make AJAX call to get next bed number
                $.ajax({
                    url: "{{ route('ward-bed.get-next-bed-number', ':wardId') }}".replace(':wardId', wardId),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#add-bed-no').prop('disabled', false).val(response.next_bed_number);
                            
                            var existingBedsText = '';
                            if (response.existing_beds && response.existing_beds.length > 0) {
                                existingBedsText = '<br><small class="text-muted">Existing beds: ' + response.existing_beds.sort((a,b) => a-b).join(', ') + '</small>';
                            }
                            
                            $('#bed-info').html('<span class="text-success">✓ Next available bed number: ' + response.next_bed_number + '</span><br>' +
                                              '<small>Ward capacity: ' + response.current_beds + '/' + response.total_beds + ' beds</small>' +
                                              existingBedsText);
                            $('#add-bed-submit').prop('disabled', false);
                        } else {
                            $('#add-bed-no').prop('disabled', true).val('').attr('placeholder', 'Ward at capacity');
                            
                            var existingBedsText = '';
                            if (response.existing_beds && response.existing_beds.length > 0) {
                                existingBedsText = '<br><small class="text-muted">Existing beds: ' + response.existing_beds.sort((a,b) => a-b).join(', ') + '</small>';
                            }
                            
                            $('#bed-info').html('<span class="text-danger">✗ ' + response.message + '</span>' + existingBedsText);
                            $('#add-bed-submit').prop('disabled', true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching bed number:', error);
                        $('#add-bed-no').prop('disabled', true).val('').attr('placeholder', 'Error loading');
                        $('#bed-info').html('<span class="text-danger">Error loading bed information. Please try again.</span>');
                        $('#add-bed-submit').prop('disabled', true);
                    }
                });
            } else {
                // Reset form when no ward is selected
                $('#add-bed-no').prop('disabled', true).val('').attr('placeholder', 'Select ward first');
                $('#bed-info').text('');
                $('#add-bed-submit').prop('disabled', true);
            }
        });

        // Reset form when Add Bed modal is closed
        $('#addBed').on('hidden.bs.modal', function () {
            $(this).find('form')[0].reset();
            $('#add-bed-no').prop('disabled', true).attr('placeholder', 'Select ward first');
            $('#bed-info').text('');
            $('#add-bed-submit').prop('disabled', true);
        });

        // Reset form when Add Bed modal is opened
        $('#addBed').on('show.bs.modal', function () {
            $('#add-bed-no').prop('disabled', true).attr('placeholder', 'Select ward first');
            $('#bed-info').text('');
            $('#add-bed-submit').prop('disabled', true);
        });
    </script>
@endpush
