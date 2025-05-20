@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .autocomplete-results {
            position: absolute;
            z-index: 1000;
            background-color: white;
            border: 1px solid #ccc;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            /* Initially hidden */
        }

        .autocomplete-results a {
            display: block;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
        }

        .autocomplete-results a:hover {
            background-color: #f0f0f0;
        }
    </style>
    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="mx-auto rounded border p-4 shadow-lg bg-white">
                    <h2 class="py-3 text-3xl font-bold text-gray-800">Search Existing Patient</h2>

                    {{-- <div class="row mb-4">
                            <div class="col-md-9 mb-3">
                                <label for="patient_info" class="form-label">Search by Patient Name/ID/Phone</label>
                                <input type="text" name="patient_info" id="patient_info" class="form-control"
                                    placeholder="Patient Name/ID/Phone" />
                                <div class="autocomplete-results list-group"></div>
                            </div>

                            <div class="col-auto md:mt-4 d-flex align-items-center">
                                <a href="{{ route('reception.patient-invoice') }}" class="btn btn-primary">Search</a>
                            </div>
                        </div> --}}

                    <div class="row mb-4">
                        <div class="col-md-9 mb-3">
                            <label for="patient_info" class="form-label">Search by Patient Name/ID/Phone</label>
                            <input type="text" name="patient_info" id="patient_info" class="form-control"
                                placeholder="Patient Name/ID/Phone" />
                            <div class="autocomplete-results list-group"></div>
                        </div>

                        <div class="col-auto mt-md-3 d-flex align-items-center">
                            <a href="#" id="search-btn" class="btn btn-primary">Search</a>
                        </div>
                    </div>

                    <div>
                        <a class="btn btn-sm btn-secondary" title="Patient" href="{{ route('reception.create') }}">
                            <i class="fas fa-pus"></i> Add Patient
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        function attachAutocompleteHandlerForPatientSearch() {
            document.getElementById('patient_info').addEventListener('input', function() {
                let query = this.value;
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('get-patients') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            const resultsContainer = document.querySelector('.autocomplete-results');
                            resultsContainer.innerHTML = '';
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block'; // Show the results box
                                data.forEach(function(item) {
                                    const resultItem = document.createElement('a');
                                    resultItem.classList.add('list-group-item',
                                        'list-group-item-action');
                                    resultItem.textContent = item.name;
                                    resultItem.dataset.id = item.id;
                                    resultItem.dataset.phone = item.phone;
                                    resultItem.href = '#';
                                    resultItem.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        fillPatientDetails(item.id, item.phone);
                                        resultsContainer.style.display =
                                        'none'; // Hide the results box
                                    });
                                    resultsContainer.appendChild(resultItem);
                                });
                            } else {
                                resultsContainer.style.display =
                                'none'; // Hide the results box if no results
                            }
                        }
                    });
                } else {
                    const resultsContainer = document.querySelector('.autocomplete-results');
                    resultsContainer.style.display =
                    'none'; // Hide the results box if query is less than 3 characters
                    resultsContainer.innerHTML = '';
                }
            });
        }

        function fillPatientDetails(id, phone) {
            $.ajax({
                url: `/get-patient-details/${id}`,
                type: "GET",
                success: function(data) {
                    document.getElementById('patient_info').value = data.id;

                }
            });
        }
        attachAutocompleteHandlerForPatientSearch();
    </script>

    <script>
        document.getElementById('search-btn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the default action
            const patientInfo = document.getElementById('patient_info').value;
            const url = "{{ route('reception.patient-invoice', ['id' => ':data']) }}".replace(':data', encodeURIComponent(patientInfo));
            window.location.href = url;
        });
    </script>
@endpush
