@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">Generate Report For</h3>
                            </div>
                            <form action="{{ route('radiology.report-generate-post', $id) }}" class="p-2" method="POST">@csrf
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="test-item-section" class="pl-2">
                                                <div class="form-row align-items-center mb-3">
                                                    <div class="col-12 col-md-2 mb-2">
                                                        <label  class="">Test</label>
                                                    </div>

                                                    <div class="col-12 col-md-2 mb-2">
                                                        <label  class="">Result</label>
                                                    </div>

                                                    <div class="col-12 col-md-2 mb-2">
                                                        <label  class="">Normal Range</label>
                                                    </div>

                                                    <div class="col-12 col-md-2 mb-2">
                                                    </div>
                                                </div>
                                                <div class="form-row align-items-center mb-3">
                                                    <div class="col-12 col-md-2 mb-2">
                                                        <input type="text" class="form-control item-name"
                                                               id="item-particular-0"
                                                               name="item[0][test]" placeholder="Test Name">
                                                    </div>
                                                    <div class="col-12 col-md-2 mb-2">
                                                        <input type="text" class="form-control" id="result-0"
                                                               name="item[0][result]"
                                                               placeholder="Result">
                                                    </div>
                                                    <div class="col-12 col-md-2 mb-2">
                                                        <input type="text" class="form-control" id="normal-range-0"
                                                               name="item[0][normal_range]"
                                                               placeholder="Normal Range">
                                                    </div>
                                                    <div class="col-12 col-md-2 mb-2">
                                                        <button type="button" class="btn btn-danger"
                                                                onclick="removeItem(this)">
                                                            &times;
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pl-2">
                                                <button type="button" class="btn btn-primary mb-4"
                                                        onclick="addParticular()">Add Particular
                                                </button>
                                            </div>

                                            <div class="mb-4">
                                                <div id="test-details">
                                                    <!-- Dynamic list of test will be displayed here -->
                                                </div>
                                            </div>

                                            <!--Comments-->
                                            <div class="col-12 col-md-6 mb-3">
                                                <label for="comments" class="form-label">Comment</label>
                                                <textarea class="form-control" id="comments" name="comments"
                                                          placeholder="Comments"></textarea>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Generate Test</button>
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
        let itemIndex = 0;

        function addParticular() {
            itemIndex++;
            let item = `
                <div class="form-row align-items-center mb-3">
                    <div class="col-12 col-md-2 mb-2">
                        <input type="text" class="form-control item-name" id="item-particular-${itemIndex}"
                               name="item[${itemIndex}][test]" placeholder="Test Name">
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <input type="text" class="form-control" id="result-${itemIndex}" name="item[${itemIndex}][result]"
                               placeholder="Result">
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <input type="text" class="form-control" id="normal-range-${itemIndex}" name="item[${itemIndex}][normal_range]"
                               placeholder="Normal Range">
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <button type="button" class="btn btn-danger" onclick="removeItem(this)">
                            &times;
                        </button>
                    </div>
                </div>
            `;
            $('#test-item-section').append(item);
        }

        function removeItem(element) {
            $(element).closest('.form-row').remove();
        }
    </script>
@endpush
