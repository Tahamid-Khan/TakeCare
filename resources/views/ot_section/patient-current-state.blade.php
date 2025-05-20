<div>
    <div class="">
        <div class="row mb-4 justify-content-between">
            <h3 class="h3">Patient Current Status</h3>
            @if($operationData->iscomplete == 0)
                <div class="my-2 row">
                    @if($operationData->operation_start_time == null )
                        <form action="{{ route('ot.start', ['id'=> $operationData->id]) }}" method="POST">@csrf
                            <button type="submit" class="btn mr-2 btn-primary text-sm">Start OT</button>
                        </form>
                    @else
                        <form action="{{ route('ot.start-ot', ['id'=> $operationData->id]) }}" method="get">
                            <button type="submit" class="btn mr-2 btn-primary text-sm">View Operation</button>
                        </form>
                    @endif
                    @if(!$bed)
                        <a href="{{ route('pow.add-form', ['id'=>$operationData->id]) }}">
                            <button class="btn btn-primary text-sm">Book POW</button>
                        </a>
                    @endif
                </div>
            @endif
        </div>

        @if (isset($patientStatus))

            {{-- Add new status form --}}
            <form id="patient-status" action="{{ route('patient.current-status', ['id' => $patientLists->id]) }}"
                  method="POST" style="display: none;" class="bg-light p-4">
                @csrf
                <div id="cross-icon">
                    <button type="button" class="close border px-4 py-1 bg-red mb-4" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-gray-50 text-center">
                            <tr>
                                <th rowspan="2" class="px-6 py-3 font-medium text-gray-500 uppercase">
                                    Medicine Name
                                </th>
                                <th colspan="3" class="px-6 py-3 font-medium text-gray-500 uppercase">
                                    Schedule
                                </th>
                                <th colspan="2" class="px-6 py-3 font-medium text-gray-500 uppercase">
                                    Taking Time
                                </th>
                                <th class="px-6 py-3 font-medium text-gray-500 uppercase">
                                    Duration(Days)
                                </th>
                                <th class="px-6 py-3 font-medium text-gray-500 uppercase">
                                    Doses
                                </th>
                                <th class="px-6 py-3 font-medium text-gray-500 uppercase">Action
                                </th>
                            </tr>
                            </thead>

                            <tbody id="medicine-table" class="text-center">
                            <tr>
                                <td class="px-6 py-4"></td>
                                <td class="border px-6 py-2">Morning</td>
                                <td class="border px-6 py-2">Afternoon</td>
                                <td class="border px-6 py-2">Evening</td>
                                <td class="border px-6 py-2">Before Meal</td>
                                <td class="border px-6 py-2">After Meal</td>
                                <td class="border px-6 py-2">Days</td>
                                <td class="border px-6 py-2"></td>
                                <td class="border px-6 py-2">Remove</td>
                            </tr>

                            {{-- <tr>
                            <td class="px-6 py-2"><input type="text" name="medicine[]"></td>
                            <td class="border px-6 py-2"><input type="checkbox" name="schedule[0][]" value="morning"></td>
                            <td class="border px-6 py-2"><input type="checkbox" name="schedule[0][]" value="afternoon"></td>
                            <td class="border px-6 py-2"><input type="checkbox" name="schedule[0][]" value="evening"></td>
                            <td class="border px-6 py-2"><input type="radio" name="timing[]" value="before"></td>
                            <td class="border px-6 py-2"><input type="radio" name="timing[]" value="after"></td>
                            <td class="border px-6 py-2"><input type="number" name="duration[]"></td>
                            <td class="border px-6 py-2"><input type="text" name="dose[]"></td>

                            <td class="border px-6 py-2">
                                <button type="button" class="btn btn-primary remove-medicine">-</button>
                            </td>
                        </tr> --}}


                            </tbody>
                        </table>
                        <td class="border px-6 py-2">
                            <button type="button" id="add-medicine" class="btn btn-primary">+</button>
                        </td>
                    </div>
                </div>


                <div class="py-4">

                    <div class="d-flex flex-column flex-lg-row">
                        <div class="col-lg-6">
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <label for="summary" class="form-label font-weight-bold">Summary:</label>
                                    <textarea class="form-control" id="summary" name="summary" rows="5"
                                              placeholder="Enter summary here..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-md-10">
                                <div class="table-responsive">
                                    <table class="table status-table border">
                                        <thead class="bg-light">
                                        <tr class="text-center">
                                            <th scope="col">Name</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Normal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-start">Pulse</td>
                                            <td><input type="number" class="form-control" name="pulse_input"
                                                       placeholder="in BPM"></td>
                                            <td class="text-center"><input type="checkbox" name="pulse_normal"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Oxygen Level</td>
                                            <td><input type="number" class="form-control" name="oxygen_input"
                                                       placeholder="in %"></td>
                                            <td class="text-center"><input type="checkbox" name="oxygen_normal">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">BP</td>
                                            <td><input type="number" class="form-control" name="bp_input"
                                                       placeholder="in mmHg"></td>
                                            <td class="text-center"><input type="checkbox" name="bp_normal"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Body Temperature</td>
                                            <td><input type="number" class="form-control" name="temperature_input"
                                                       placeholder="in °F"></td>
                                            <td class="text-center"><input type="checkbox" name="bp_normal"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Test Needed</td>
                                            <td><input type="text" class="form-control" name="test_input"></td>
                                            <td class="text-center">-----</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>




            @if($operationData->iscomplete == 1)
                <!-- Add New Status Button -->
                <button id="addStatusBtn" class="btn btn-primary add-status-btn">Add New Status</button>
            @endif

            <!-- Patient Status Table -->

            <style>
                .last-update-class {
                    float: right;
                }
            </style>
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between border w-100">
                            <div class="w-100">Patient Status</div>
                            <div class=" w-100">
                                <span class="last-update-class">Last Updated at:
                                    {{ $patientStatus['created_at']->format('g:ia d/m/Y') }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table status-table">
                                    <tbody>
                                    <tr>
                                        <td><i class="fas fa-heartbeat status-icon pr-2 text-danger"></i>Pulse</td>
                                        <td>
                                            @if ($patientStatus['pulse_rate'] == 0)
                                                <p class="text-danger"> Not Updated </p>
                                            @else
                                                {{ $patientStatus['pulse_rate'] }} BPM
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-lungs status-icon pr-2 text-info"></i>Oxygen Level</td>
                                        <td>
                                            @if ($patientStatus['oxygen_level'] == 0)
                                                <p class="text-danger"> Not Updated </p>
                                            @else
                                                {{ $patientStatus['oxygen_level'] }} %
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-tint status-icon pr-2 text-danger"></i>Blood Pressure</td>
                                        <td>
                                            @if ($patientStatus['blood_pressure'] == 0)
                                                <p class="text-danger"> Not Updated </p>
                                            @else
                                                {{ $patientStatus['blood_pressure'] }} mmHg
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-thermometer-half status-icon pr-2 text-primary"></i>Body Temperature</td>
                                        <td>
                                            @if ($patientStatus['temperature'] == 0)
                                                <p class="text-danger"> Not Updated </p>
                                            @else
                                                {{ $patientStatus['temperature'] }} °F
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex justify-content-between">
                                            <div><i class="fas fa-pills status-icon pr-2 text-success"></i>Medicine</div>
                                            @if($operationData->iscomplete == 1)
                                                <div>
                                                    <button id="edit" class="border-0 rounded">
                                                        <img src="{{ asset('assets/icon/edit.svg') }}" alt="edit_icon"
                                                             class="p-2">
                                                    </button>

                                                    <button type="submit" form="update-medicine-status"
                                                            id="update" class="d-none border-0 rounded">
                                                        <img src="{{ asset('assets/icon/check.svg') }}" alt="update"
                                                             class="p-2">
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <div  class=" justify-content-end text-sm">

                                            </div> --}}
                                            <form id="update-medicine-status"
                                                  action="{{ route('patient.updateMedicineStatus') }}"
                                                  method="POST" class="status mr-3 text-sm text-center">@csrf
                                                <table>
                                                    <div id="status-heading" class="d-none text-center">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Schedule</th>
                                                            <th>Taking time</th>
                                                            <th>Dose</th>
                                                            <th>Duration</th>
                                                            <th></th>
                                                            @if($operationData->iscomplete == 1)
                                                                <th>

                                                                    Mark
                                                                    As
                                                                    Completed
                                                                </th>
                                                            @endif
                                                        </tr>
                                                    </div>
                                                    @foreach ($patientActiveMedicines as $item)
                                                        @php
                                                            $schedule = json_decode($item->schedule);
                                                        @endphp


                                                        <tr class="border-bottom mr-3 text-capitalize">
                                                            <td>{{ $item->medicine_name }}</td>

                                                            <td>
                                                                <small>
                                                                    {{ in_array('morning', $schedule) ? '1+' : '0+' }}
                                                                    {{ in_array('afternoon', $schedule) ? '1+' : '0+' }}
                                                                    {{ in_array('evening', $schedule) ? '1' : '0' }}

                                                                </small>
                                                            </td>
                                                            <td>
                                                                <small>{{ $item->taking_time }} Meal</small>
                                                            </td>
                                                            <td>
                                                                <small>{{ $item->dose }}</small>
                                                            </td>
                                                            <td>
                                                                <small>{{ $item->duration }}</small>
                                                            </td>
                                                            <td></td>
                                                            @if($operationData->iscomplete == 0)
                                                                <td>
                                                                    <div
                                                                        class=" d-flex  align-items-center justify-items-center">
                                                                        <div class="d-none all-status  w-100">

                                                                            <input type="checkbox" name="status[]"
                                                                                   value="{{ $item->id }}">

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </table>

                                            </form>

                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                No status found for this patient.
            </div>
        @endif


    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("addStatusBtn").addEventListener("click", function () {
            var patientStatus = document.getElementById("patient-status");
            if (patientStatus.style.display === "none") {
                patientStatus.style.display = "block";
                // hide addStatusBtn
                document.getElementById("addStatusBtn").style.display = "none";
            } else {
                patientStatus.style.display = "none";
            }
        });

        // cross button
        document.getElementById("cross-icon").addEventListener("click", function () {
            var patientStatus = document.getElementById("patient-status");
            if (patientStatus.style.display === "block") {
                patientStatus.style.display = "none";
                // show addStatusBtn
                document.getElementById("addStatusBtn").style.display = "block";
            }
        });

        // // show status div on edit button click
        // document.querySelectorAll(".edit").forEach(function(editBtn) {
        //     editBtn.addEventListener("click", function() {
        //         var statusDiv = this.closest(".status-check").querySelector(".status");
        //         statusDiv.querySelector("input[type='checkbox']").removeAttribute("disabled");
        //         this.closest(".status-check").querySelector(".update").classList.remove(
        //             "d-none");
        //         this.classList.add("d-none");
        //     });
        // });

        // // hide status div on update button click
        // document.querySelectorAll(".update").forEach(function(updateBtn) {
        //     updateBtn.addEventListener("click", function() {
        //         var statusDiv = this.closest(".status-check").querySelector(".status");
        //         statusDiv.querySelector("input[type='checkbox']").setAttribute("disabled",
        //             "disabled");
        //         this.closest(".status-check").querySelector(".edit").classList.remove("d-none");
        //         this.classList.add("d-none");
        //         var form = document.getElementById("update-medicine-status");
        //         form.submit();
        //     });
        // });


        //remove d-none class from status-heading and all-status div on edit button click
        document.getElementById("edit").addEventListener("click", function () {
            var statusHeading = document.getElementById("status-heading");
            var allStatus = document.querySelectorAll(".all-status");
            statusHeading.classList.remove("d-none");
            statusHeading.classList.add("d-flex");
            allStatus.forEach(function (status) {
                status.classList.remove("d-none");
            });
            this.classList.add("d-none");
            document.getElementById("update").classList.remove("d-none");
        });

    });


    // document.getElementById("addMedicine").addEventListener("click", function() {
    //     var medicineBoxes = document.querySelectorAll(".medicine-box");
    //     var newMedicineBox = medicineBoxes[0].cloneNode(true); // Clone the first medicine box

    //     // Generate a unique identifier for the new medicine box
    //     var uniqueId = Date.now();

    //     // Update select elements with unique identifier
    //     var selects = newMedicineBox.querySelectorAll("select");
    //     selects.forEach(function(select) {
    //         select.id += "-" + uniqueId;
    //         select.value = ""; // Clear select values
    //     });

    //     // Update checkbox elements with unique identifier
    //     var checkboxes = newMedicineBox.querySelectorAll("input[type='checkbox']");
    //     checkboxes.forEach(function(checkbox) {
    //         checkbox.id += "-" + uniqueId;
    //         checkbox.checked = false; // Uncheck checkboxes
    //     });

    //     // Update medicine info div with unique identifier
    //     var medicineInfo = newMedicineBox.querySelector(".medicine-info");
    //     medicineInfo.id += "-" + uniqueId;
    //     medicineInfo.style.display = "none"; // Hide medicine info

    //     // Append cloned medicine box
    //     document.getElementById("medicine-boxes").appendChild(newMedicineBox);

    //     // Add event listener to the new select element
    //     var newSelect = newMedicineBox.querySelector(".medicine-select");
    //     newSelect.addEventListener('change', function() {
    //         var medicineInfo = this.closest('.medicine-box').querySelector('.medicine-info');
    //         if (this.value === "") {
    //             medicineInfo.style.display = "none"; // Hide medicine info if no medicine is selected
    //         } else {
    //             medicineInfo.style.display = "block"; // Show medicine info if a medicine is selected
    //         }
    //     });
    // });

    // Event delegation for existing select elements
    // document.addEventListener('change', function(event) {
    //     if (event.target && event.target.matches('.medicine-select')) {
    //         var medicineInfo = event.target.closest('.medicine-box').querySelector('.medicine-info');
    //         if (event.target.value === "") {
    //             medicineInfo.style.display = "none"; // Hide medicine info if no medicine is selected
    //         } else {
    //             medicineInfo.style.display = "block"; // Show medicine info if a medicine is selected
    //         }
    //     }
    // });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {

        var medicineCount = 1;
        // Event delegation for add medicine button
        document.addEventListener('click', function (event) {
            if (event.target && event.target.id === 'add-medicine') {
                var medicineTable = document.getElementById('medicine-table');
                var newRow = document.createElement('tr');

                var uniqueId = medicineCount++;
                newRow.innerHTML = `
                <tr>
                                <td class="px-6 py-2"><input type="text" name="medicine[${uniqueId}]"></td>
                                <td class="border px-6 py-2"><input type="checkbox" name="schedule[${uniqueId}][]" value="morning"></td>
                                <td class="border px-6 py-2"><input type="checkbox" name="schedule[${uniqueId}][]" value="afternoon"></td>
                                <td class="border px-6 py-2"><input type="checkbox" name="schedule[${uniqueId}][]" value="evening"></td>
                                <td class="border px-6 py-2"><input type="radio" name="taking_time[${uniqueId}]" value="before"></td>
                                <td class="border px-6 py-2"><input type="radio" name="taking_time[${uniqueId}]" value="after"></td>
                                <td class="border px-6 py-2"><input type="number" name="duration[${uniqueId}]"></td>
                                <td class="border px-6 py-2"><input type="text" name="dose[${uniqueId}]"></td>

                                <td class="border px-6 py-2">
                                    <button type="button" class="btn btn-primary remove-medicine">-</button>
                                </td>
                            </tr>
                `;
                medicineTable.appendChild(newRow);
            }
        });

        // Event delegation for remove medicine button
        document.addEventListener('click', function (event) {
            if (event.target && event.target.classList.contains('remove-medicine')) {
                event.target.closest('tr').remove();
            }
        });


        // Event listener for form submission
        // document.querySelector('#patient-status').addEventListener('submit', function(event) {
        //     event.preventDefault(); // Prevent the default form submission

        //     // Collect data from the form
        //     var formData = {
        //         medicines: [],
        //         summary: document.getElementById('summary').value,
        //         status: []
        //     };

        //     // Collect medicine data
        //     var medicineRows = document.querySelectorAll('#medicine-table tr:not(:first-child)');
        //     medicineRows.forEach(function(row) {
        //         var medicine = {
        //             name: row.querySelector('input[type="text"]').value,
        //             schedule: {
        //                 morning: row.querySelector('input[name="morning"]').checked,
        //                 lunch: row.querySelector('input[name="lunch"]').checked,
        //                 evening: row.querySelector('input[name="evening"]').checked
        //             },
        //             takingTime: {
        //                 before: row.querySelector('input[name^="timing"]:checked').value ===
        //                     'before',
        //                 after: row.querySelector('input[name^="timing"]:checked').value ===
        //                     'after'
        //             },
        //             duration: row.querySelector('input[name="duration"]').value,
        //             dose: row.querySelector('input[name="dose"]').value

        //         };
        //         formData.medicines.push(medicine);
        //     });

        //     // Collect status data
        //     var statusRows = document.querySelectorAll('.status-table tbody tr');

        //     statusRows.forEach(function(row) {
        //         var inputText = row.querySelector('input[type="text"]');
        //         var inputCheckbox = row.querySelector('input[type="checkbox"]');

        //         // Check if inputText or inputCheckbox is not null
        //         if (inputText || inputCheckbox) {
        //             var status = {
        //                 name: row.querySelector('td:first-child').innerText,
        //                 value: inputText.value,
        //                 normal: inputCheckbox ? inputCheckbox.checked : false
        //             };

        //             if (status.name === 'Body Tempareture') {
        //                 status.value += '°F';
        //             }
        //             formData.status.push(status);
        //         } else {
        //             console.error("Error: Missing input element in row", row);
        //         }
        //     });

        //     // Log the collected data as JSON
        //     console.log(JSON.stringify(formData, null, 2));
        // });
    });
</script>
