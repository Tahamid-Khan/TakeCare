@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .w-0 {
            width: 0px !important;
        }
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="row rounded-lg bg-white shadow-lg py-4 px-2">
                <div class="col-12 col-xl-6 mb-4">
                    <h2 class="h2">Instrumental Charges</h2>

                    <div class="my-2">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addInstrumentCharge">Add New</button>
                    </div>

                    <table class="table table-bordered table-striped" id="classList">
                        <thead>
                            <th>No</th>
                            <th>Instrument Name</th>
                            <th>Charge</th>
                            <th>Action</th>
                        </thead>

                        @php
                            $instruments = [
                                (object) [
                                    'id' => 1,
                                    'name' => 'Instrument 1',
                                    'charge' => 100,
                                ],
                                (object) [
                                    'id' => 2,
                                    'name' => 'Instrument 2',
                                    'charge' => 200,
                                ],
                            ];
                        @endphp

                        <tbody>
                            @foreach ($instruments as $item)
                                <tr>
                                    <td class="w-0">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->charge }}</td>
                                    <td class="flex">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#editInstrumentCharge"
                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-charge="{{ $item->charge }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <form action="{{ route('ot.delete-charges') }}" method="POST">@csrf
                                            <input type="hidden" name="instrument_id" value="{{ $item->id }}">
                                            <button type="button" class="btn text-danger delete-instrument">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                        {{-- Edit Instrument Charge Popup Modal --}}
                        <div class="modal fade" id="editInstrumentCharge" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('ot.edit-charges') }}" method="POST">@csrf
                                        <div class="modal-header">
                                            <h3 class="h3" id="exampleModalLabel">Edit Instrument Charge</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <input type="hidden" name="instrument_id" id="instrument_id">
                                            <div class="form-group">
                                                <label for="instrument_name">Instrument Name</label>
                                                <input type="text" class="form-control" name="instrument_name" id="edit_instrument_name">
                                            </div>

                                            <div class="form-group">
                                                <label for="charge">Charge</label>
                                                <input type="text" class="form-control" name="instrument_charge" id="edit_charge">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        {{-- Add Instrument Charge Popup Modal --}}
                        <div class="modal fade" id="addInstrumentCharge" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('ot.add-charges') }}" method="POST">@csrf
                                        <div class="modal-header">
                                            <h3 class="h3" id="exampleModalLabel">Add Instrument Charge</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="instrument_name">Instrument Name</label>
                                                <input type="text" class="form-control" name="instrument_name" id="add_instrument_name">
                                            </div>

                                            <div class="form-group">
                                                <label for="charge">Charge</label>
                                                <input type="text" class="form-control" name="instrument_charge" id="add_charge">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </table>
                </div>

                {{-- Gas Charge --}}
                <div class="col-12 col-xl-6">
                    <h2 class="h2">Gas Charges</h2>

                    <div class="my-2">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addGasCharge">Add New</button>
                    </div>
                    <table class="table table-bordered table-striped" id="classList2">
                        <thead>
                            <th>No</th>
                            <th>Gas Name</th>
                            <th>Charge</th>
                            <th>Action</th>
                        </thead>

                        @php
                            $gases = [
                                (object) [
                                    'id' => 1,
                                    'name' => 'Gas 1',
                                    'charge' => 100,
                                ],
                                (object) [
                                    'id' => 2,
                                    'name' => 'Gas 2',
                                    'charge' => 200,
                                ],
                            ];
                        @endphp

                        <tbody>
                            @foreach ($gases as $item)
                                <tr>
                                    <td class="w-0">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->charge }}</td>
                                    <td class="flex">
                                        <button type="button" class="btn" data-toggle="modal"
                                            data-target="#editGas" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-charge="{{ $item->charge }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <form action="{{ route('ot.delete-charges') }}" method="POST">@csrf
                                            <input type="hidden" name="gas_id" value="{{ $item->id }}">
                                            <button type="button" class="btn text-danger delete-gas">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                        {{-- Gas Edit Popup Modal --}}
                        <div class="modal fade" id="editGas" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('ot.edit-charges') }}" method="POST">@csrf
                                        <div class="modal-header">
                                            <h3 class="h3" id="exampleModalLabel">Edit Gas Charge</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <input type="hidden" name="gas_id" id="gas_id">
                                            <div class="form-group">
                                                <label for="gas_name">Gas Name</label>
                                                <input type="text" class="form-control" name="gas_name" id="edit_gas_name">
                                            </div>

                                            <div class="form-group">
                                                <label for="charge">Charge</label>
                                                <input type="text" class="form-control" name="gas_charge" id="edit_gas_charge">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        {{-- Add modal for gas --}}
                        <div class="modal fade" id="addGasCharge" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('ot.add-charges') }}" method="POST">@csrf
                                        <div class="modal-header">
                                            <h3 class="h3" id="exampleModalLabel">Add Gas Charge</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="gas_name">Gas Name</label>
                                                <input type="text" class="form-control" name="gas_name" id="add_gas_name">
                                            </div>

                                            <div class="form-group">
                                                <label for="charge">Charge</label>
                                                <input type="text" class="form-control" name="gas_charge" id="add_gas_charge">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </table>
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
        $(function() {
            $("#classList2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $('#editInstrumentCharge').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var charge = button.data('charge');
            var modal = $(this);

            modal.find('.modal-body input[name="instrument_id"]').val(id);
            modal.find('.modal-body input[name="instrument_name"]').val(name);
            modal.find('.modal-body input[name="instrument_charge"]').val(charge);
        });

        $('#editGas').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var charge = button.data('charge');
            var modal = $(this);

            modal.find('.modal-body input[name="gas_id"]').val(id);
            modal.find('.modal-body input[name="gas_name"]').val(name);
            modal.find('.modal-body input[name="gas_charge"]').val(charge);
        });

        $('.delete-instrument').on('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this instrument charge!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $(this).closest('form').submit();
                }
            })
        });

        $('.delete-gas').on('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this gas charge!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $(this).closest('form').submit();
                }
            })
        });
    </script>
@endpush
