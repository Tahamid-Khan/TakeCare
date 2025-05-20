@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Additional Discount For the References</h2>
                <div class="p-4 shadow-lg bg-white">
                    <div class="row">
                        <div class="col-12 p-3">
                            <h3 class="py-3 h3">References List</h3>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Reference Name</th>
                                        <th>Discount (%)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>



                                <tbody>
                                    @foreach ($discounts as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->patient_type }}</td>
                                            <td>{{ $item->discount }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                                        data-target="#editReferenceModal"
                                                        data-id="{{ $item->id }}"
                                                        data-name="{{ $item->patient_type }}"
                                                        data-amount="{{ $item->discount }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <!-- Edit Reference Modal -->
                        <div class="modal fade" id="editReferenceModal" tabindex="-1" role="dialog"
                            aria-labelledby="editReferenceModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="editReferenceModalLabel">Update Reference</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('account.edit-reference-discount') }}" method="POST">@csrf
                                            <input type="hidden" id="edit-id" name="id">
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-reference-name" class="form-label">Reference Name</label>
                                                    <input type="text" id="edit-reference-name"  class="form-control" disabled>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-amount" class="form-label">Discount</label>
                                                    <input type="text" id="edit-amount" name="discount" class="form-control">
                                                </div>


                                                <div class="col-auto md:mt-4 d-flex align-items-center">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                "filter": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });

        $('#editReferenceModal').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let name = button.data('name');
            let amount = button.data('amount');

            let modal = $(this);
            modal.find('.modal-body #edit-id').val(id);
            modal.find('.modal-body #edit-reference-name').val(name);
            modal.find('.modal-body #edit-amount').val(amount);
        });
    </script>
@endpush
