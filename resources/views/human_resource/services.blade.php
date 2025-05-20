@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="">
                    <div class="card">
                        <h2 class="card-header h2 font-weight-bold">Add New Service</h2>
                        <div class="card-body">
                            <form action="{{ route('hr.add-service') }}" method="POST"> @csrf
                                <div class="row g-3">
                                    <div class="col-md-4 mb-4">
                                        <label for="service_name" class="form-label">Service Name</label>
                                        <input type="text" id="service_name" name="name" class="form-control"
                                               placeholder="Service Name" required/>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="fund-type" class="mb-2 d-block font-weight-bold text-gray-700">Fund
                                            Type</label>
                                        <select id="fund-type" class="form-control mw200" name="department_id">
                                            <option value=""></option>
                                            @foreach($departments as $item)
                                                <option class="capitalize"
                                                        value="{{ $item->id }}">{{ $item->fund->type .' - ' .  $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" step="0.01" id="price" name="price" class="form-control"
                                               placeholder="Price" required min="0"/>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="text-center font-bold mt-8">
                    <h1>Or</h1>
                </div>

                <div class="card mt-4">
                    <h3 class="p-3 h3">Existing Services</h3>

                    {{--                            <div class="col-auto md:mt-4 d-flex align-items-center">--}}
                    {{--                                <button type="submit" class="btn btn-primary">Search</button>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </form>--}}


                    <div class="p-3">
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-striped" id="classList">
                                <thead>
                                <th>Service Name</th>
                                <th>Fund Type</th>
                                <th>Price</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->name }}</td>
                                        <td class="capitalize">{{ $service->department->name }}</td>
                                        <td><span
                                                class="taka-small">&#2547;</span>{{ number_format($service->price, 2  ) }}
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-toggle="modal"
                                                    data-target="#show-editModal" data-id="{{ $service->id }}"
                                                    data-name="{{ $service->name }}"
                                                    data-fund_type="{{ $service->department->id }}"
                                                    data-price="{{ $service->price }}"><i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="show-editModal" tabindex="-1" role="dialog" aria-labelledby="showEditModal"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('hr.edit-service') }}" method="POST">@csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="h3">Edit Service</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <input type="hidden" id="edit_service_id" class="form-control" name="id"/>
                                    <label for="edit_service_name" class="form-label">Service Name*</label>
                                    <input type="text" id="edit_service_name" class="form-control" name="service_name"
                                           placeholder="Service Name" required/>
                                </div>

                                <div class="mb-3">
                                    <label for="fund_type" class="mb-2 d-block font-weight-bold text-gray-700">Fund
                                        Type*</label>
                                    <select id="edit_fund_type" class="form-control mw200" name="department_id">
                                        <option value=""></option>
                                        @foreach($departments as $item)
                                            <option class="capitalize"
                                                    value="{{ $item->id }}">{{ $item->fund->type .' - ' .  $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_price" class="form-label">Price*</label>
                                    <input type="number" step="0.01" id="edit_price" name="price" class="form-control"
                                           placeholder="Price" required/>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $('#fund-type').select2({
            placeholder: "Select Fund Type",
        });
        $('#edit_fund_type').select2({
            placeholder: "Select Fund Type",
        });
        $('#show-editModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let id = button.data('id');
            let name = button.data('name');
            let fund_type = button.data('fund_type');
            let price = button.data('price');

            // console.log(id, name, fund_type, price);

            let modal = $(this);
            modal.find('.modal-body #edit_service_id').val(id);
            modal.find('.modal-body #edit_service_name').val(name);
            modal.find('.modal-body #edit_fund_type').val(fund_type).trigger('change');
            modal.find('.modal-body #edit_price').val(price);
        });
    </script>
@endpush
