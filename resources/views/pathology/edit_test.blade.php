@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">Update Test Details</h3>
                            </div>
                            <form action="{{ route('pathology.update_test') }}" class="p-2" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$testLists->id}}">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="tab-content shampan-heading">
                                                <div class="active tab-pane" id="general-information">
                                                    <!-- Post -->
                                                    <div class="col-md-12">
                                                        <div class="row">

                                                            <div class="col-4 form-group">
                                                                <p class="p-tag">Name <span class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('name') is-invalid @enderror" placeholder="" id="name" name="name" type="text"  value="{{ old('name')?old('name'):$testLists->name }}" required>
                                                                <!-- </div> -->
                                                                @error('name')
                                                                <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-4 form-group">
                                                                <p class="p-tag">Delivery Days<span class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <select class="form-control" id="delivery_days" name="delivery_days" required>
                                                                    <option value="">----</option>
                                                                    <option value="1" {{(old('delivery_days')?old('delivery_days'):$testLists->delivery_days == '1')? 'selected':''}}>1</option>
                                                                    <option value="2" {{(old('delivery_days')?old('delivery_days'):$testLists->delivery_days == '2')? 'selected':''}}>2</option>
                                                                    <option value="3" {{(old('delivery_days')?old('delivery_days'):$testLists->delivery_days == '3')? 'selected':''}}>3</option>
                                                                    <option value="5" {{(old('delivery_days')?old('delivery_days'):$testLists->delivery_days == '5')? 'selected':''}}>5</option>
                                                                    <option value="7" {{(old('delivery_days')?old('delivery_days'):$testLists->delivery_days == '7')? 'selected':''}}>7</option>
                                                                    <option value="15" {{(old('delivery_days')?old('delivery_days'):$testLists->delivery_days == '15')? 'selected':''}}>15</option>
                                                                </select>
                                                                <!-- </div> -->
                                                                @error('delivery_days')
                                                                <span class="text-success ml-3 mt-1">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-4 form-group">
                                                                <p class="p-tag">Amount <span class="text-danger">*</span></p>
                                                                <!-- <div class="col-md-12 "> -->
                                                                <input class="form-control custom-focus @error('amount') is-invalid @enderror" placeholder="" id="amount" name="amount" type="number" value="{{ old('amount') ? old('amount') : $testLists->amount }}" required>
                                                                <!-- </div> -->
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mt-3 mb-2 text-right">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
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
            $("#teamList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
