@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="card">
                <h2 class="card-header h2 font-weight-bold">Medicine</h2>
                <div class="p-4">
                    <div class="">
                        <h3 class="py-3 h3">Add Medicine</h3>
                        <div class="card-body">
                            {{-- Add Medicine --}}
                            <form action="{{ route('add-medicine') }}" method="POST">@csrf
                                <div class="row mb-4">
                                    <div class="col-md-4 form-group">
                                        <label for="add-pharmaceutical-name" class="form-label">Pharmaceutical
                                            Name</label>
                                        <input type="text" id="add-pharmaceutical-name" name="pharmaceutical_name"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-brand-name" class="form-label">Brand Name</label>
                                        <input type="text" id="add-brand-name" name="brand_name" class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-generic-name" class="form-label">Generic Name</label>
                                        <input type="text" id="add-generic-name" name="generic_name"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-strength" class="form-label">Strength</label>
                                        <input type="text" id="add-strength" name="strength" class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-dosage-description" class="form-label">Dosage
                                            Description</label>
                                        <input type="text" id="add-dosage-description" name="dosage_description"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-retail-price" class="form-label">Retail Price(TK.)</label>
                                        <input type="number" id="add-retail-price" name="retail_price"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label for="add-use-for" class="form-label">Use for</label>
                                        <input type="text" id="add-use-for" name="use_for" class="form-control">
                                    </div>


                                    <div class="col-auto md:mt-4 d-flex align-items-center">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="mt-4">
                            <h2 class="h3">Medicine's List</h2>
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                    <th>SL</th>
                                    <th>Brand Name</th>
                                    <th>Generic Name</th>
                                    <th>Strength</th>
                                    <th>Retail Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>
                                    @foreach ($medicines as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->brand_name }}</td>
                                            <td>{{ $item->generic_name }}</td>
                                            <td>{{ $item->strength }}</td>
                                            <td><span class="taka-small">&#2547;</span>{{ number_format($item->price, 2, '.', ',') }}</td>
                                            <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td class="row mr-0">
                                                <button type="button" class="btn btn-sm btn-success mr-2" data-toggle="modal"
                                                    data-target="#editMedicineModal" data-id="{{ $item->id }}" data-pharmaceutical-name="{{ $item->pharmaceutical_name }}"
                                                    data-brand-name="{{ $item->brand_name }}"
                                                    data-generic-name="{{ $item->generic_name }}"
                                                    data-strength="{{ $item->strength }}"
                                                    data-dosage-description="{{ $item->dosage_description }}"
                                                    data-retail-price="{{ $item->price }}"
                                                    data-use-for="{{ $item->use_for }}" data-status="{{ $item->status }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <form action="{{ route('delete-medicine') }}" method="POST">@csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="button" class="btn btn-sm btn-danger delete-medicine">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>



                        <!-- Edit Medicine Modal -->
                        <div class="modal fade" id="editMedicineModal" tabindex="-1" role="dialog"
                            aria-labelledby="editMedicineModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="h3" id="editMedicineModalLabel">Update Medicine</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- Edit Medicine --}}
                                        <form action="{{ route('edit-medicine') }}" method="POST">@csrf
                                            <input type="hidden" id="edit-id" name="id">
                                            <div class="row mb-4">
                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-pharmaceutical-name"
                                                        class="form-label">Pharmaceutical
                                                        Name</label>
                                                    <input type="text" id="edit-pharmaceutical-name"
                                                        name="pharmaceutical_name" class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-brand-name" class="form-label">Brand Name</label>
                                                    <input type="text" id="edit-brand-name" name="brand_name"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-generic-name" class="form-label ">Generic
                                                        Name</label>
                                                    <input type="text" id="edit-generic-name" name="generic_name"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-strength" class="form-label">Strength</label>
                                                    <input type="text" id="edit-strength" name="strength"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-dosage-description" class="form-label">Dosage
                                                        Description</label>
                                                    <input type="text" id="edit-dosage-description"
                                                        name="dosage_description" class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-retail-price" class="form-label">Retail
                                                        Price(TK.)</label>
                                                    <input type="number" id="edit-retail-price" name="retail_price"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-use-for" class="form-label">Use for</label>
                                                    <input type="text" id="edit-use-for" name="use_for"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="edit-status" class="form-label">Status</label>
                                                    <select name="status" id="edit-status" class="form-control">
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
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
                // "filter": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');

            $('#editMedicineModal').on('show.bs.modal', function(event) {
                let button = $(event.relatedTarget);
                let id = button.data('id');
                let pharmaceutical_name = button.data('pharmaceutical-name');
                let brand_name = button.data('brand-name');
                let generic_name = button.data('generic-name');
                let strength = button.data('strength');
                let dosage_description = button.data('dosage-description');
                let retail_price = button.data('retail-price');
                let use_for = button.data('use-for');
                let status = button.data('status');

                let modal = $(this);
                modal.find('.modal-body #edit-id').val(id);
                modal.find('.modal-body #edit-pharmaceutical-name').val(pharmaceutical_name);
                modal.find('.modal-body #edit-brand-name').val(brand_name);
                modal.find('.modal-body #edit-generic-name').val(generic_name);
                modal.find('.modal-body #edit-strength').val(strength);
                modal.find('.modal-body #edit-dosage-description').val(dosage_description);
                modal.find('.modal-body #edit-retail-price').val(retail_price);
                modal.find('.modal-body #edit-use-for').val(use_for);
                modal.find('.modal-body #edit-status').val(status);
            });

            $('.delete-medicine').on('click', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this medicine!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
