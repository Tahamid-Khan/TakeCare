@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #008000;
            border-color: #008000;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__clear:hover {
            color: red;
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h2 class="h2 font-weight-bold">Upload Notice</h2>
                </div>

                <div class="p-4">
                    <div class="card-body">
                        <form action="{{ route('notice.store') }}" method="POST" enctype="multipart/form-data">@csrf

                            <div class="row">
                                <!--Notice Title-->
                                <div class="col-12 col-md-3 form-group">
                                    <label for="notice_title">Notice Title*</label>
                                    <input type="text" class="form-control" id="notice_title" name="notice_title" placeholder="Enter Notice Title" required>

                                    @error('notice_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!--Upload Notice File-->
                                <div class="col-12 col-md-3 form-group">
                                    <label for="notice_file">Notice File*</label>
                                    <input type="file" class="form-control" id="notice_file" name="notice_file" accept="application/pdf" placeholder="Upload Notice File" required>

                                    @error('notice_file')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Select Department -->
                                <div class="col-12 col-md-3 form-group">
                                    <label for="department">Select Department*</label>
                                    <select class="form-control" id="department" name="department[]" required>
                                        <option value=""></option>
                                        <option value="all">Select All</option>
                                        @foreach($departments as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Select Notice Type -->
                                <div class="col-12 col-md-3 form-group">
                                    <label for="notice_type">Notice Type*</label>
                                    <select class="form-control" id="notice_type" name="notice_type" required>
                                        <option value="">Select Notice Type</option>
                                        <option value="demand_letter">Demand Letter</option>
                                        <option value="office_order">Office Order</option>
                                        <option value="notice">Notice</option>
                                    </select>
                                    @error('notice_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- TextArea Notice Description--}}
                                <div class="col-12 form-group">
                                    <label for="notice_description">Notice Description*</label>
                                    <textarea class="form-control" id="notice_description" name="notice_description" placeholder="Enter Notice Description" required></textarea>
                                    @error('notice_description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary mt-3">Upload Notice</button>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(document).ready(function () {
            let department = $('#department');

            // Add 'multiple' attribute after a short delay to avoid initial rendering issues
            setTimeout(function () {
                department.attr('multiple', 'multiple');
                // remove the first empty option
                department.find('option:first').remove();
                department.select2({
                    placeholder: "Select Department",
                    allowClear: true,
                    // closeOnSelect: false
                });
            }, 1);

            // Get all department IDs except 'Select All'
            let allDepartment = @json($departments).
            map(department => department.id);

            department.on('change', function () {
                let selectedValues = department.val();

                // If the empty option is selected, clear it
                if (selectedValues.includes('')) {
                    selectedValues = selectedValues.filter(value => value !== '');
                    department.val(selectedValues).trigger('change');
                }

                // If 'Select All' is selected, choose all departments
                if (selectedValues.includes('all')) {
                    department.val(allDepartment).trigger('change');
                }
            });
        });
    </script>

@endpush
