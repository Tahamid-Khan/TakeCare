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
                                <h3 class="h3">Edit Test</h3>
                            </div>
                            <div class="card-body pb-0">
                                <form class="calculate" method="post" action="{{ route('pathology.update', ['id' => $pathology->id]) }}" id="form-id">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-1 form-group">
                                                    <input type="text" class="form-control" name="date" id="date" value="{{ $pathology->date }}" readonly>
                                                </div>

                                                <div class="col-md-3 form-group" hidden>
                                                    <input type="text" class="form-control" name="pathology_id" id="pathology_id" placeholder="" value="{{ $pathology->pathology_id }}">
                                                </div>

                                                <div class="col-md-1">
                                                    <select class="form-control bg-light" required name="type" id="patient_type">
                                                        <option value="" {{ $pathology->type == '' ? 'selected' : '' }}>Type</option>
                                                        <option value="0" {{ $pathology->type == '0' ? 'selected' : '' }}>OPD</option>
                                                        <option value="1" {{ $pathology->type == '1' ? 'selected' : '' }}>IPD</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 form-group">
                                                    <select class="form-control" name="patient_id" id="searchpatient" autofocus>
                                                        <option value="" selected disabled hidden>Patient ID</option>
                                                        @foreach($patients as $patient)
                                                            <option value="{{ $patient->id }}" {{ $pathology->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->patient_id }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <input type="text" name="name" required id="name" class="form-control" placeholder="Patient Name" value="{{ $pathology->name }}" required />
                                                </div>

                                                <div class="col-md-3">
                                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="{{ $pathology->mobile }}" required />
                                                </div>
                                                <div class="col-md-1"></div>

                                                <div class="col-md-1">
                                                    <input name="gender" class="form-control" placeholder="Sex" id="gender" autocomplete="off" value="{{ $pathology->gender }}" required>
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="text" name="age" id="age" class="form-control" placeholder="Age" value="{{ $pathology->age }}" required autocomplete="off" />
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="address" id="address" class="form-control" placeholder="Address (Optional)" value="{{ $pathology->address }}" />
                                                </div>

                                                <div class="col-md-3">
                                                    <select class="form-control bg-light" required name="reference" id="reference">
                                                        <option value="">Reference</option>
                                                        <option value="GENERAL" {{ $pathology->reference == 'GENERAL' ? 'selected' : '' }}>GENERAL</option>
                                                        <option value="DMSC" {{ $pathology->reference == 'DMSC' ? 'selected' : '' }}>DMSC</option>
                                                        <option value="MOD" {{ $pathology->reference == 'MOD' ? 'selected' : '' }}>MOD</option>
                                                        <option value="MED" {{ $pathology->reference == 'MED' ? 'selected' : '' }}>MED</option>
                                                        <option value="CBD" {{ $pathology->reference == 'CBD' ? 'selected' : '' }}>CBD</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <select class="form-control" id="doctor_id" name="doctor_id" required="">
                                                        <option value="">Doctor</option>
                                                        @foreach($doctors as $doctor)
                                                            <option value="{{ $doctor->id }}" {{ $pathology->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <hr style="border-color: #6c757d4a;">
                                        </div>

                                        <div class="col-md-9" style="border-right: 1px solid #6c757d4a;">
                                            <div class="ui-widget mb-2 search-section">
                                                <select class="col-6 searchcode add form-control" name="" id="searchcode" autofocus>
                                                    <option value="" selected disabled hidden>Select Test</option>
                                                    @foreach($tests as $test)
                                                        <option value="{{ $test->name }}">{{ $test->name }}</option>
                                                    @endforeach
                                                </select>

                                                <datalist id="testNames">
                                                    @foreach($tests as $test)
                                                        <option value="{{ $test->name }}" data-price="{{ $test->amount }}" data-days="{{ $test->delivery_days }}">
                                                    @endforeach
                                                </datalist>

                                                <!-- Hidden input field to store selected tests as a JSON array -->
                                                <input type="hidden" name="test_list_details" id="selectedTests" value="[]">
                                            </div>

                                            <div style="min-height: 230px; padding: 00px; background:#fafafa;">
                                                <table class="RFtable">
                                                    <thead style="background-color: #0099ff; color: #fff; padding: 5px;">
                                                        <tr>
                                                            <th align="left" width="50%" style="padding-left: 10px;">Test Name</th>
                                                            <th width="35%">Delivery Days</th>
                                                            <th width="15%">Rate</th>
                                                            <th width="15%" style="padding-right: 10px;">Remove </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Rows will be dynamically added here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                            <div class="row" style="margin-top: 25px;">
                                                <div class="col-md-3 form-group">
                                                    <label class="sr-only" for="discount"> Delivery Date</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Delivery Date</div>
                                                        </div>
                                                        <input class="form-control" type="date" id="delivery_date" name="delivery_date" value="{{ $pathology->delivery_date }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 form-group">
                                                    <label class="sr-only" for="discount"> Delivery Time</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Delivery Time</div>
                                                        </div>
                                                        <input class="form-control" type="time" id="delivery_time" name="delivery_time" value="{{ $pathology->delivery_time }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 form-group">
                                                    <label class="sr-only" for="discount"> Remark </label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">Remark</div>
                                                        </div>
                                                        <input class="form-control" type="text" id="remark" name="remark" value="{{ $pathology->remark }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="margin-bottom: 20px;">
                                            <div class="row">
                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only" for="total">Total</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">Total</div>
                                                        </div>
                                                        <input class="form-control text-success text-right font-weight-bold h6 total" readonly type="text" required id="total" name="total" value="{{ $pathology->total }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only" for="discount">Discount %</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">Discount %</div>
                                                        </div>
                                                        <input type="number" class="form-control text-success font-weight-bold discount" style="border-radius: 0;" max="" id="discount" name="discount" value="{{ $pathology->discount }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only" for="payable">Payable</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text pay" style="width: 140px; "> Payable  </div>
                                                            <div class="input-group-text payh" style="width: 140px; display:none;"> Payable <samp style="color: red;" > (+1%) </samp></div>
                                                        </div>
                                                        <input class="form-control text-success text-right font-weight-bold payable" readonly type="text" id="payable" name="payable" value="{{ $pathology->payable }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only" for="paid">Paid</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">Paid</div>
                                                        </div>
                                                        <input class="form-control text-success text-right font-weight-bold paid" type="text" id="paid" name="paid" value="{{ $pathology->paid }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label class="sr-only" for="due">Due</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">Due</div>
                                                        </div>
                                                        <input class="form-control text-danger text-right font-weight-bold due" readonly type="text" id="due" name="due" value="{{ $pathology->due }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="sr-only" for="due">Mode</label>
                                                    <div class="input-group mb-0 mr-sm-0">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text" style="width: 140px;">Mode</div>
                                                        </div>
                                                        <select type="text" class="form-control" name="account" required>
                                                            <option value="1" {{ $pathology->account == '1' ? 'selected' : '' }}>Cash</option>
                                                            <option value="2" {{ $pathology->account == '2' ? 'selected' : '' }}>Bkash</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-primary add btn-block lidl mt-3" name="save" id="save" value="Update" />
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
            $('#searchpatient').on('change', function() {
                var id = $(this).val();

                // Make an AJAX request to fetch the patient name based on the ID
                $.ajax({
                    url: '{{ url("/pathology/info/") }}/' + id,
                    type: 'GET',
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#mobile').val(response.mobile);
                        $('#age').val(response.age);
                        $('#address').val(response.address);
                        $('#gender').val(response.gender);
                        $('#reference').val(response.reference);

                updateDoctorDropdown(response);

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

       function updateDoctorDropdown(response) {
        var doctorDropdown = $('#doctor_id');
        // Clear existing options
        doctorDropdown.empty();

        // Add default option
        doctorDropdown.append('<option value="">Doctor</option>');

        // Check if there are doctors in the list
        if (response.doctors.length > 0) {
            // Add doctor options based on the response
            $.each(response.doctors, function(index, doctor) {
                doctorDropdown.append('<option value="' + doctor.id + '">' + doctor.name + '</option>');
            });

            // Set the selected doctor based on the response
            doctorDropdown.val(response.doctor_id);
        } else {
            // No doctors in the list
            console.log('No doctors available.');
        }
    }
});

        $(document).ready(function() {
            $('body').addClass('sidebar-collapse');

            $("#teamList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');

        });


        $(document).ready(function () {
// Initialize selectedTestsArray with existing data
var selectedTestsArray = {!! json_encode($selectedTests) !!};
updateTable(selectedTestsArray);

// Event listener for test selection
$('#searchcode').on('input', function () {
    var selectedTest = $(this).val();
    var testPrice = $('#testNames option[value="' + selectedTest + '"]').data('price');
    var deliveryDays = $('#testNames option[value="' + selectedTest + '"]').data('days');

    // Check if the selected test already exists in the array
    var existingTest = selectedTestsArray.find(function (test) {
        return test.name === selectedTest;
    });

    if (existingTest) {
        // Update the existing test
        existingTest.price = testPrice;
        existingTest.days = deliveryDays;
    } else {
        // Add the selected test to the array
        selectedTestsArray.push({
            name: selectedTest,
            price: testPrice,
            days: deliveryDays
        });
    }

    updateTable(selectedTestsArray);

    // Clear the search code input after selection
    $(this).val('');

    // Update the total price
    updateTotalPrice();
});

// Function to update the table with selected tests
function updateTable(selectedTestsArray) {
    // Clear existing rows in the table
    $('.RFtable tbody').empty();

    // Loop through selected tests and add rows to the table
    selectedTestsArray.forEach(function (test) {
        var newRow = '<tr style="border-bottom: 1px solid #ccc; padding: 10px;">' +
            '<td style="padding: 10px;">' + test.name + '</td>' +
            '<td style="padding: 10px;">' + test.days + ' days</td>' +
            '<td class="test-price" style="padding: 10px;"><span class="taka-small">&#2547; </span>' + test.price + '</td>' +
            '<td style="padding: 10px;">' +
            '<button type="button" class="remove-item" style="padding: 5px; font-size: 12px; background: none; color: #dc3545; border: none; font-weight: 500;">' +
            '<i class="fas fa-trash-alt"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';

        $('.RFtable tbody').append(newRow);
    });

    // Update the hidden input field with selected tests as a JSON array
    $('#selectedTests').val(JSON.stringify(selectedTestsArray));
    console.log(selectedTestsArray)

}

            // Event listener for removing an item
            $('.RFtable tbody').on('click', '.remove-item', function () {
            // Get the index of the item to be removed
            var indexToRemove = $(this).closest('tr').index();

            // Remove the item from selectedTestsArray
            selectedTestsArray.splice(indexToRemove, 1);

            // Update the table and the hidden input field
            updateTable(selectedTestsArray);
            updateTotalPrice();
        });

            // Function to update the total price
            function updateTotalPrice() {
                var total = 0;
                $('.RFtable tbody tr').each(function () {
                    var price = parseFloat($(this).find('.test-price').text());
                    total += price;
                });

                // Update the total input field
                $('#total').val(total.toFixed(2));

                // Update the payable amount after applying discount
                updatePayable();
            }

            // Event listener for discount input
            $('#discount').on('input', function () {
                // Update the payable amount after applying discount
                updatePayable();
            });

            // Function to update the payable amount
            function updatePayable() {
                var total = parseFloat($('#total').val());
                var discount = parseFloat($('#discount').val()) || 0;

                var payable = total - (total * (discount / 100));

                // Update the payable input field
                $('#payable').val(payable.toFixed(2));

                // Update the due amount
                updateDue();
            }
            $('#paid').on('input', function () {
            // Update the due amount after entering the paid amount
            updateDue();
        });

            // Function to update the due amount
            function updateDue() {
                var payable = parseFloat($('#payable').val());
                var paid = parseFloat($('#paid').val()) || 0;

                var due = payable - paid;

                // Update the due input field
                $('#due').val(due.toFixed(2));
            }
        });


        $(document).ready(function () {
            $('#searchcode').select2();
            $('#searchpatient').select2();

        });



        function generateRandomNumber() {
            return Math.floor(Math.random() * 10000).toString().padStart(4, '0');
        }

        function updatePathologyID() {
            var today = new Date();
            var month = (today.getMonth() + 1).toString().padStart(2, '0');
            var randomNumbers = generateRandomNumber();

            var pathology_id = 'PATHO' + month + randomNumbers;
            document.getElementById('pathology_id').value = pathology_id;
        }

        updatePathologyID();

    $(document).ready(function() {
        // Function to format the date in YYYY-MM-DD
        function getFormattedDate() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();

            return yyyy + '-' + mm + '-' + dd; // Corrected the date format
        }

        // Set today's date in the "delivery_date" input field
        // $('#date').val(getFormattedDate());
        // $('#delivery_date').val(getFormattedDate());
    });
</script>
@endpush
