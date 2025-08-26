<div>
    <div class="">
        <h2 class="h2 mb-4">Patient Current Status</h2>

        {{-- Add new status form --}}
        <form id="patient-status"
              action="{{ route('patient.current-status', ['id' => $patientData->operation->patient_id]) }}"
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
                                        <td class="text-center"><input type="checkbox" name="pulse_normal">
                                        </td>
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
                                        <td><input type="text" class="form-control" name="test_input">
                                        </td>
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


        <!-- Add New Status Button -->
        <button id="addStatusBtn" class="btn btn-primary add-status-btn">Add New Status</button>


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
                            {{-- <span class="last-update-class">Last Updated at:
                                    {{ $patientStatus['created_at']->format('g:ia d/m/Y') }}</span> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table status-table">
                                <tbody>
                                <tr>
                                    <td><i class="fas fa-heartbeat status-icon pr-2 text-danger"></i>Pulse</td>
                                    <td>
                                        @if ($patientStatus->pulse_rate == 0)
                                            <p class="text-danger"> Not Updated </p>
                                        @else
                                            {{ $patientStatus->pulse_rate }} BPM
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-lungs status-icon pr-2 text-info"></i>
                                        Oxygen Level</td>
                                    <td>
                                        @if ($patientStatus->oxygen_level == 0)
                                            <p class="text-danger"> Not Updated </p>
                                        @else
                                            {{ $patientStatus->oxygen_level }} %
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><i class="fas fa-tint status-icon pr-2 text-danger"></i>Blood Pressure</td>
                                    <td>
                                        @if ($patientStatus->blood_pressure == 0)
                                            <p class="text-danger"> Not Updated </p>
                                        @else
                                            {{ $patientStatus->blood_pressure }} mmHg
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td> <i class="fas fa-thermometer-half status-icon pr-2 text-primary"></i>
                                        Body Temperature</td>
                                    <td>
                                        @if ($patientStatus->temperature == 0)
                                            <p class="text-danger"> Not Updated </p>
                                        @else
                                            {{ $patientStatus->temperature }} °F
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <div><i class="fas fa-pills status-icon pr-2 text-success"></i>Medicine</div>
                                        <div>
                                            <button id="edit" class="border-0 rounded">
{{--                                                <img src="{{ asset('assets/icon/edit.svg') }}" alt="edit_icon"--}}
{{--                                                     class="p-2">--}}
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button type="submit" form="update-medicine-status" id="update"
                                                    class="d-none border-0 rounded">
                                                <img src="{{ asset('assets/icon/check.svg') }}" alt="update"
                                                     class="p-2">
                                            </button>
                                        </div>
                                    </td>
                                    <td>
                                        <form id="update-medicine-status"
                                              action="{{ route('patient.updateMedicineStatus') }}" method="POST"
                                              class="status mr-3 text-sm text-center">@csrf
                                            <table>
                                                <div id="status-heading" class="d-none text-center">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Schedule</th>
                                                        <th>Taking time</th>
                                                        <th>Dose</th>
                                                        <th>Duration</th>
                                                        <th></th>
                                                        <th>Mark As Completed</th>
                                                    </tr>
                                                </div>
                                                @foreach ($patientActiveMedicines as $item)
                                                    @php
                                                        $schedule = $item->schedule ? json_decode($item->schedule, true) : [];
                                                        if (!is_array($schedule)) {
                                                            $schedule = [];
                                                        }
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
                                                            <small>{{ $item->taking_time ?? 'Before' }} Meal</small>
                                                        </td>
                                                        <td>
                                                            <small>{{ $item->dose ?? 'N/A' }}</small>
                                                        </td>
                                                        <td>
                                                            <small>{{ $item->duration ?? 'N/A' }}</small>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <div
                                                                class=" d-flex  align-items-center justify-items-center">
                                                                <div class="d-none all-status  w-100">

                                                                    <input type="checkbox" name="status[]"
                                                                           value="{{ $item->id }}">

                                                                </div>
                                                            </div>
                                                        </td>
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
        {{--         @else--}}
        {{--         <div class="alert alert-info" role="alert">--}}
        {{--                No status found for this patient.--}}
        {{--            </div>--}}
        {{--         @endif--}}


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
    });
</script>
