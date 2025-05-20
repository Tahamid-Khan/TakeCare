@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #test-table-body tr:nth-child(odd) {
            background-color: lavender;
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h3">New Test Assign</h3>
                            </div>
                            <div class="card-body pb-0">
                                <form action="{{ route('pathology.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mb-4">

                                                {{--                                                <div class="col-md-3 form-group my-2" hidden>--}}
                                                {{--                                                    <input type="text" class="form-control" name="pathology_id"--}}
                                                {{--                                                           id="pathology_id" placeholder="" value="">--}}
                                                {{--                                                </div>--}}

                                                <div class="col-md-2 form-group my-2">
                                                    <input type="date" class="form-control" name="date" id="date"
                                                           value="{{ \Carbon\Carbon::now()->toDateString() }}" readonly>
                                                </div>


                                                <div class="col-md-1 my-2">
                                                    <select class="form-control bg-light" required name="type">
                                                        <option value="">Type</option>
                                                        <option class="" value="1">IPD</option>
                                                        <option value="0">OPD</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 form-group my-2">
                                                    <input type="text" class="form-control" name="patient_id"
                                                           id="patient_id" placeholder="Patient ID" >
                                                    <div class="autocomplete-results"></div>
                                                </div>

                                                <div class="col-md-3 my-2">
                                                    <input type="text" name="name" id="patient-name"
                                                           class="form-control" placeholder="Patient Name" required/>
                                                </div>

                                                <div class="col-md-3 my-2">
                                                    <input type="text" name="mobile" id="mobile" class="form-control"
                                                           placeholder="Mobile" required/>
                                                </div>

                                                <div class="col-md-2 my-2">
                                                    <select class="form-control bg-light" name="gender" id="gender"
                                                            required>
                                                        <option value="">Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-1 my-2">
                                                    <input type="text" name="age" id="age" class="form-control"
                                                           placeholder="Age" required/>
                                                </div>

                                                <div class="col-md-3 my-2">
                                                    <input type="text" name="address" id="address" class="form-control"
                                                           placeholder="Address (Optional)"/>
                                                </div>

                                                <div class="col-md-3 my-2">
                                                    <select class="form-control bg-light" name="reference"
                                                            id="reference" required>
                                                        <option value="">Reference</option>
                                                        <option value="GENERAL"
                                                            {{ old('reference') == 'GENERAL' ? 'selected' : '' }}>
                                                            GENERAL
                                                        </option>
                                                        <option value="DMSC"
                                                            {{ old('reference') == 'DMSC' ? 'selected' : '' }}>DMSC
                                                        </option>
                                                        <option value="MOD"
                                                            {{ old('reference') == 'MOD' ? 'selected' : '' }}>MOD
                                                        </option>
                                                        <option value="MED"
                                                            {{ old('reference') == 'MED' ? 'selected' : '' }}>MED
                                                        </option>
                                                        <option value="CBD"
                                                            {{ old('reference') == 'CBD' ? 'selected' : '' }}>CBD
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 form-group my-2">
                                                    <select class="form-control" id="doctor_id" name="doctor_id">
                                                        <option value="">Doctor</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-2 row">
                                            <div class="col-12 col-md-3">
                                                <label for="pathological-test">Pathological Test</label>
                                                <select class=" form-control" id="pathological-test">
                                                    <option value="" selected>Select Pathology Test</option>
                                                    @foreach ($pathTests as $test)
                                                        <option value="{{ $test->name }}">{{ $test->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <label for="radiology-test">Radiology Test</label>
                                                <select class=" form-control" id="radiology-test">
                                                    <option value="" selected>Select Radiology Test</option>
                                                    @foreach ($radioTests as $test)
                                                        <option value="{{ $test->name }}">{{ $test->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Hidden input field to store selected tests as a JSON array -->
                                            <input type="hidden" name="test_list_details" id="selectedTests"
                                                   value="[]">
                                        </div>

                                        <div class="col-12 col-xl-9">
                                            <hr style="border-color: #6c757d4a;">

                                            <div style="min-height: 298px;">
                                                <table class="w-100">
                                                    <thead class="bg-primary">
                                                    <tr>
                                                        <th>Test Name</th>
                                                        <th>Delivery Days</th>
                                                        <th>Rate</th>
                                                        <th>Remove</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="test-table-body">
                                                    <!-- Rows will be dynamically added here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                    <label class="sr-only" for="discount"> Delivery Date</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Delivery Date</div>
                                                        </div>
                                                        <input class="form-control" type="date" id="delivery_date"
                                                               name="delivery_date" value="2023-11-21">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 form-group">

                                                    <label class="sr-only" for="discount"> Delivery Time</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Delivery Time</div>
                                                        </div>
                                                        <input class="form-control" type="time" id="delivery_time"
                                                               name="delivery_time" value="10:30:00">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 form-group">

                                                    <label class="sr-only" for="discount"> Remark </label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Remark</div>
                                                        </div>
                                                        <input class="form-control" type="text" id="remark"
                                                               name="remark">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>


                                        <div class="col-12 col-xl-3" style="margin-bottom: 20px;">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <div class="input-group mb-0 mr-sm-0 ">
                                                        <div class="input-group-prepend ">
                                                            <div class="input-group-text" style="width: 140px;">Total
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                               class="form-control text-success text-right font-weight-bold"
                                                               readonly required id="total" name="total">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">
                                                                Discount %
                                                            </div>
                                                        </div>
                                                        <input type="number"
                                                               class="form-control text-success text-right font-weight-bold"
                                                               id="discount" name="discount">
                                                    </div>
                                                </div>


                                                <div class="col-md-12 form-group">
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px; ">
                                                                Payable
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                               class="form-control text-success text-right font-weight-bold"
                                                               readonly id="payable" name="payable">
                                                    </div>
                                                </div>


                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only" for="paid">Paid</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">
                                                                Paid
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                               class="form-control text-success text-right font-weight-bold"
                                                               id="paid" name="paid">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only" for="due">Due</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">
                                                                Due
                                                            </div>
                                                        </div>
                                                        <input type="text"
                                                               class="form-control text-danger text-right font-weight-bold"
                                                               readonly id="due" name="due">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <label class="sr-only" for="due">Mode</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">
                                                                Mode
                                                            </div>
                                                        </div>
                                                        <select class="form-control" name="account" required>
                                                            <option value="1">Cash</option>
                                                            <option value="2">Bkash</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary add btn-block lidl mt-3"
                                                   name="save" id="save" value="Save"/>

                                        </div>
                                    </div>
                                </form>
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
        $(document).ready(function() {
            function attachAutocompleteHandlerForPatientSearch() {
                document.getElementById('patient_id').addEventListener('input', function() {
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
                        console.log(data);
                        $('#patient-name').val(data.name);
                        $('#mobile').val(data.mobile);
                        $('#gender').val(data.gender);
                        $('#age').val(data.age);
                        $('#address').val(data.address);
                        $('#reference').val(data.reference);
                        $('#doctor_id').val(data.doctor_id);
                    }
                });
            }

            attachAutocompleteHandlerForPatientSearch();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const pathTestSelect = document.getElementById('pathological-test');
            const radioTestSelect = document.getElementById('radiology-test');
            const tableBody = document.getElementById('test-table-body');
            const selectedTestsInput = document.getElementById('selectedTests');

            const totalInput = document.getElementById('total');
            const discountInput = document.getElementById('discount');
            const payableInput = document.getElementById('payable');
            const paidInput = document.getElementById('paid');
            const dueInput = document.getElementById('due');

            const testsData = {
                pathological: @json($pathTests),
                radiology: @json($radioTests)
            };

            let selectedTests = [];

            pathTestSelect.addEventListener('change', function () {
                const selectedTest = testsData.pathological.find(test => test.name === this.value);
                addTestToTable(selectedTest, 'pathological');
            });

            radioTestSelect.addEventListener('change', function () {
                const selectedTest = testsData.radiology.find(test => test.name === this.value);
                addTestToTable(selectedTest, 'radiology');
            });

            discountInput.addEventListener('input', calculatePayable);

            paidInput.addEventListener('input', calculateDue);

            function addTestToTable(test, type) {
                if (!test) return;

                if (selectedTests.find(selected => selected.name === test.name)) {
                    alert('Test already selected!');
                    return;
                }

                selectedTests.push({
                    name: test.name,
                    type: type,
                    price: parseFloat(test.amount),
                    days: test.delivery_days
                });

                updateSelectedTestsInput();
                updateTotals();

                const row = document.createElement('tr');

                const nameCell = document.createElement('td');
                nameCell.textContent = test.name;

                const daysCell = document.createElement('td');
                daysCell.textContent = test.delivery_days;

                const rateCell = document.createElement('td');
                rateCell.textContent = test.amount;

                const removeCell = document.createElement('td');
                const removeBtn = document.createElement('button');
                removeBtn.innerHTML = '<i class="fas fa-trash"></i>';
                removeBtn.classList.add('btn', 'btn-danger', 'btn-sm');
                removeBtn.addEventListener('click', function () {
                    selectedTests = selectedTests.filter(selected => selected.name !== test.name);
                    updateSelectedTestsInput();
                    updateTotals();
                    row.remove();
                });
                removeCell.appendChild(removeBtn);

                row.appendChild(nameCell);
                row.appendChild(daysCell);
                row.appendChild(rateCell);
                row.appendChild(removeCell);

                tableBody.appendChild(row);
            }

            function updateTotals() {
                const total = selectedTests.reduce((acc, test) => acc + test.price, 0);
                totalInput.value = total.toFixed(2);
                calculatePayable();
            }

            function calculatePayable() {
                const total = parseFloat(totalInput.value);
                const discount = parseFloat(discountInput.value) || 0;
                const payable = total - (total * discount / 100);
                payableInput.value = payable.toFixed(2);
                calculateDue();
            }

            function calculateDue() {
                const payable = parseFloat(payableInput.value);
                const paid = parseFloat(paidInput.value) || 0;
                const due = payable - paid;
                dueInput.value = due.toFixed(2);
            }

            function updateSelectedTestsInput() {
                selectedTestsInput.value = JSON.stringify(selectedTests);
            }
        });
    </script>
@endpush
