@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="card">
                    <h2 class="card-header h2 font-weight-bold">Create Quotation</h2>

                    <div class="p-4">
                        <form id="indent-form" action="{{ route('store.indent-store') }}" method="POST">@csrf

                            <!--Date-->
                            <div class="form-row align-items-center mb-3">
                                <div class="col-12 col-md-2 mb-2">
                                    <label for="date" class="">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                            </div>

                            <!--Indents-->
                            <div>
                                <div id="indent-section">
                                    <div class="form-row align-items-center mb-3">
                                        <div class="col-12 col-md-2 mb-2">
                                            <label for="" class="">Product Name</label>
                                        </div>

                                        <div class="col-12 col-md-2 mb-2">
                                            <label for="" class="">Quantity</label>
                                        </div>
                                        <div class="col-12 col-md-2 mb-2">
                                        </div>
                                    </div>
                                    <div class="form-row align-items-center mb-3">
                                        <div class="col-12 col-md-2 mb-2">
{{--                                            <input type="text" class="form-control item-name" id="item-name-0"--}}
{{--                                                   name="services[0][name]" placeholder="">--}}
                                            <select name="products[0][name]" id="item-name-0" class="form-control item-name">
                                                <option value="">Select Service</option>
                                                @foreach($products as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-2 mb-2">
                                            <input type="number" class="form-control" id="quantity-0"
                                                   name="products[0][quantity]"
                                                   placeholder="Quantity">
                                        </div>
                                        <div class="col-12 col-md-2 mb-2">
                                            <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                                                &times;
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-sm btn-primary mb-4" onclick="addItem()">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <div class="mb-4">
                                    <div id="indent-details">
                                        <!-- Dynamic list of indent services will be displayed here -->
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button id="save" type="button" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
@push('custom_js')
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#item-name-0').select2();--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        let itemCount = 1;

        // Add new budget item
        function addItem() {
            const itemContainer = document.createElement('div');
            itemContainer.classList.add('form-row', 'align-items-center', 'mb-3');
            itemContainer.innerHTML = `
                <div class="col-12 col-md-2 mb-2">
                    <select name="products[${itemCount}][name]" id="item-name-${itemCount}" class="form-control item-name">
                        <option value="">Select Service</option>
                        @foreach($products as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-2 mb-2">
                    <input type="number" class="form-control" id="quantity-${itemCount}" name="products[${itemCount}][quantity]" placeholder="Quantity">
                </div>
                <div class="col-12 col-md-2 mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                        &times;
                    </button>
                </div>`;
            document.getElementById('indent-section').appendChild(itemContainer);
            itemCount++;

            $(document).ready(function () {
                $('.item-name').select2();
            });
        }

        // Remove item
        function removeItem(button) {
            button.closest('.form-row').remove();
        }

        $(document).ready(function () {
            $('.item-name').select2();
        });

        // Save indent
        $('#save').click(function () {
            $('#indent-form').submit();
            setTimeout(function () {
                location.reload();
            }, 3000);
        });
    </script>
@endpush
