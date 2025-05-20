<style>
    .recipere {
        font-size: 40px;
        font-weight: bold;
        color: #007bff;
    }

    .section-title {
        font-size: 1.2em;
        font-weight: bold;
        margin-bottom: 10px;
        color: #007bff;
    }

    .section-content {
        margin-bottom: 20px;
    }

    .rx-section {
        border-left: 2px solid #007bff;
        padding-left: 20px;
    }

    .prescription-header {
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .prescription-header h2 {
        margin: 0;
    }

    .prescription-header p {
        margin: 0;
        font-size: 1.1em;
        color: #555;
    }

    .right-col {
        background-color: #ffff;
        padding: 20px;
        border-radius: 5px;
    }

    .active {
        background-color: #44db1e !important;
        border: 1px solid #44db1e !important;
    }
</style>


{{-- <form id="test-id" action="{{ route('opd.store', ['id' => $patientData->id]) }}" method="POST">@csrf --}}
    {{-- hidden field id  --}}
    <input type="hidden" name="patient_id" value="{{ $patientData->patient_id }}">
    <div class="row">
        <div class="col-md-3">
            <div class="section-content">
                <div class="section-title">C/C</div>
                {{-- <textarea name="cc" id="" cols="10" rows="2" class="form-control"></textarea> --}}
                <input type="text" name="cc" class="form-control">
            </div>
            <div class="section-content">
                <div class="section-title">H/O</div>
                {{-- <textarea name="ho" id="" cols="10" rows="2" class="form-control"></textarea> --}}
                <input type="text" name="ho" class="form-control">
            </div>
            {{-- <div class="section-content">
                <div class="section-title">R/F</div>
                <textarea name="rf" id="" cols="10" rows="2" class="form-control"></textarea>
            </div> --}}
            <div class="section-content">
                <div class="section-title">O/E</div>
                {{-- <textarea name="oe" id="" cols="10" rows="3" class="form-control"></textarea> --}}
                <div class="form-group" id="oe">
                    <div class="row">
                        <div class="col-xl-6">
                            <label for="anemia" class="small">Anemia</label>
                            <input type="text" name="anemia" id="anemia" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="jaundice" class="small">Jaundice</label>
                            <input type="text" name="jaundice" id="jaundice" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="edema" class="small">Edema</label>
                            <input type="text" name="edema" id="edema" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="pulse" class="small">Pulse</label>
                            <input type="text" name="pulse" id="pulse" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="bp" class="small">BP</label>
                            <input type="text" name="bp" id="bp" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="temp" class="small">Temp</label>
                            <input type="text" name="temp" id="temp" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="heart" class="small">Heart</label>
                            <input type="text" name="heart" id="heart" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="lung" class="small">Lung</label>
                            <input type="text" name="lung" id="lung" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="liver" class="small">Liver</label>
                            <input type="text" name="liver" id="liver" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="spleen" class="small">Spleen</label>
                            <input type="text" name="spleen" id="spleen" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="section-title">Inv Profile</div>
                {{-- <textarea name="inv" id="" cols="10" rows="3" class="form-control"></textarea> --}}

                <div class="form-group" id="inv">
                    <div class="row">
                        <div class="col-xl-6">
                            <label for="hb" class="small">HB: </label>
                            <input type="text" name="hb" id="hb" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="hbsAg" class="small">HBSAg: </label>
                            <input type="text" name="hbsAg" id="hbsAg" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="tc" class="small">TC</label>
                            <input type="text" name="tc" id="tc" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="dc" class="small">DC</label>
                            <input type="text" name="dc" id="dc" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="esr" class="small">ESR</label>
                            <input type="text" name="esr" id="esr" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="urineR/E" class="small">Urine R/E</label>
                            <input type="text" name="urineRE" id="urineRE" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="bloodSugar" class="small">Blood Sugar</label>
                            <input type="text" name="bloodSugar" id="bloodSugar" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="bloodUrea" class="small">Blood Urea</label>
                            <input type="text" name="bloodUrea" id="bloodUrea" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="serumCreatinine" class="small">Serum Creatinine</label>
                            <input type="text" name="serumCreatinine" id="serumCreatinine" class="form-control">
                        </div>
                        <div class="col-xl-6">
                            <label for="rbs" class="small">RBS</label>
                            <input type="text" name="rbs" id="rbs" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-content">
                <div class="section-title">Adv</div>
                {{-- <textarea name="adv" id="" cols="10" rows="2" class="form-control"></textarea> --}}
                <input type="text" name="adv" class="form-control">
            </div>
            {{-- <div class="section-content">
                <div class="section-title">Dx</div>
                <textarea name="dx" id="" cols="10" rows="2" class="form-control"></textarea>
            </div> --}}
        </div>

        <div class="col-md-9 right-col border">
            <div class="recipere">Rx</div>

{{--            <div class="d-flex justify-content-end mb-4">--}}
{{--                <button type="button" class="btn btn-sm btn-primary mr-2 active" id="centralStore">Central--}}
{{--                    Store</button>--}}
{{--                <button type="button" class="btn btn-sm btn-primary" id="outdoorStore">Outdoor Store</button>--}}
{{--            </div>--}}

            <div class="card p-4 medicine-info">
                <div class="form-group">
                    <label for="medicine">Medicine</label>
{{--                    <div class="medicineSelectDiv">--}}
{{--                        <select class="form-control medicine-select" name="items[0][medicine]" id="medicineSelect">--}}
{{--                            <option value="">Select Medicine</option>--}}
{{--                            @foreach ($medicineLists as $medicine)--}}
{{--                                <option value="{{ $medicine->brand_name }}">{{ $medicine->brand_name }} {{ $medicine->strength }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <input type="text" id="medicineInput" class="form-control" name="items[0][medicine]"
                           placeholder="Brand/Generic Name">
                    <div class="autocomplete-results-medicine list-group"></div>
                </div>

                {{-- Schedule --}}
                <div class="form-group">
                    <label>Schedule</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="items[0][schedule]" type="checkbox" id="morning"
                            value="morning">
                        <label class="form-check-label" for="morning">Morning</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="items[0][schedule]" type="checkbox" id="afternoon"
                            value="afternoon">
                        <label class="form-check-label" for="afternoon">Afternoon</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="items[0][schedule]" type="checkbox" id="evening"
                            value="evening">
                        <label class="form-check-label" for="evening">Evening</label>
                    </div>
                </div>

                {{-- Taking Time --}}
                <div class="form-group">
                    <label for="takingTime">Taking Time</label>
                    <div class="form-check">
                        <input class="form-check form-check-input" type="radio" name="items[0][takingTime]"
                            id="before" value="before">
                        <label class="form-check form-check-label" for="before">Before Meal</label>
                        <input class="form-check form-check-input" type="radio" name="items[0][takingTime]"
                            id="after" value="after">
                        <label class="form-check form-check-label" for="after">After Meal</label>
                    </div>
                </div>

                {{-- Duration --}}
                <div class="form-group w-75">
                    <label for="duration">Duration</label>
                    <div class="d-flex">
                        {{-- <input type="text" class="form-control w-25 mr-2" id="durationText" name="items[0][durationText]"> --}}
                        <select class="form-control w-25" id="durationSelect" name="items[0][duration]">
                            <option value="">Select Duration</option>
                            <option value="7">7 day</option>
                            <option value="14">2 weeks</option>
                            <option value="30">1 month</option>
                            <option value="60">2 month</option>
                            <option value="continue">Continue</option>
                            <option value="no_sleep">If No Sleep</option>
                            <option value="chest_pain">If Chest Pain</option>
                            <option value="needed">If Needed</option>
                        </select>
                    </div>
                </div>

                {{-- Dose --}}
                <div class="form-group w-50">
                    <label for="dose">Dose</label>
                    <div class="d-flex">
                        {{-- <input type="text" class="form-control mr-2 w-25" id="doseText" name="items[0][doseText]"> --}}
                        <select class="form-control w-25" id="doseSelect" name="items[0][dose]">
                            <option value="">Select Dose</option>
                            <option value="one_spoon">1 spoon</option>
                            <option value="one_piece">1 piece</option>
                        </select>
                    </div>
                </div>

                {{-- Add Button to right side --}}
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-primary" id="addMedicine">Add</button>
                </div>
            </div>

            <div>
                <div class="form-group">
                    <label for="advice">Advice</label>
                    <textarea name="advice" id="advice" cols="10" rows="2" class="form-control"></textarea>
                </div>

                {{-- <div class="form-group">
                    <label for="followUp">Follow Up</label>
                    <textarea name="followUp" id="followUp" cols="10" rows="2" class="form-control"></textarea>
                </div> --}}
            </div>

            {{-- Medicine List container after click add --}}
            <div class="medicine-list mt-4"></div>
        </div>
    </div>

    {{-- Save Button --}}
    <div class="d-flex justify-content-end mt-4">
        <button id="save-btns" type="submit" class="btn btn-sm btn-primary">Save</button>
    </div>
{{-- </form> --}}

@push('custom_js')
    <script>
        function attachAutocompleteHandlerForMedicineSearch() {
            document.getElementById('medicineInput').addEventListener('input', function() {
                let query = this.value;
                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('get-medicines') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            const resultsContainer = document.querySelector('.autocomplete-results-medicine');
                            resultsContainer.innerHTML = '';
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block'; // Show the results box
                                data.forEach(function(item) {
                                    const resultItem = document.createElement('a');
                                    resultItem.classList.add('list-group-item',
                                        'list-group-item-action');
                                    resultItem.textContent = item.brand_name;
                                    if (item.strength) {
                                        resultItem.textContent += ' ' + item.strength;
                                    }
                                    resultItem.textContent += ' - ' + item.generic_name;
                                    resultItem.dataset.id = item.id;
                                    resultItem.href = '#';
                                    resultItem.addEventListener('click', function(e) {
                                        e.preventDefault();
                                        document.getElementById('medicineInput').value = item.brand_name + ' ' + item.strength;
                                        resultsContainer.style.display = 'none';
                                    });
                                    resultsContainer.appendChild(resultItem);
                                });
                            } else {
                                resultsContainer.style.display = 'none'; // Hide the results box
                            }
                        }
                    });
                } else {
                    const resultsContainer = document.querySelector('.autocomplete-results-medicine');
                    resultsContainer.style.display = 'none';
                    resultsContainer.innerHTML = '';
                }
            });
        }

        $(document).ready(function() {
            attachAutocompleteHandlerForMedicineSearch();
        });
    </script>
    <script>
        $(document).ready(function() {
            // $('#medicineSelect').select2();
            // $('#outdoorStore').click(function() {
            //     $('#medicineSelect').val('');
            //     $('.medicineSelectDiv').addClass('d-none');
            //     $('#medicineInput').removeClass('d-none');
            //
            //     $(this).addClass('active');
            //     $('#centralStore').removeClass('active');
            // });
            //
            // $('#centralStore').click(function() {
            //     $('#medicineInput').val('');
            //     $('#medicineInput').addClass('d-none');
            //     $('.medicineSelectDiv').removeClass('d-none');
            //
            //     $(this).addClass('active');
            //     $('#outdoorStore').removeClass('active');
            // });

            // Add Medicine
            $('#addMedicine').click(function() {
                const medicine = $('#medicineSelect').val() || $('#medicineInput').val();
                let schedule = [];
                let scheduleOptions = ['morning', 'afternoon', 'evening'];

                scheduleOptions.forEach(option => {
                    schedule.push(0);
                });

                $.each($("input[name='items[0][schedule]']:checked"), function() {
                    let value = $(this).val();
                    let index = scheduleOptions.indexOf(value);
                    if (index !== -1) {
                        schedule[index] = 1;
                    }
                });

                let takingTime = $("input[name='items[0][takingTime]']:checked").val();
                let duration = $('#durationSelect').val();
                let dose = $('#doseSelect').val();

                let html = `<div class="card p-4 mt-2">
                        <div class="d-flex justify-content-between">
                            <h5 class="medicine">${medicine}</h5>
                            <button class="btn btn-sm btn-danger">Remove</button>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="schedule"><strong>Schedule:</strong> ${schedule.join(' + ')}</p>
                            <p class="takingTime"><strong>Taking Time:</strong> ${takingTime}</p>
                            <p class="duration"><strong>Duration:</strong> ${duration}</p>
                            <p class="dose"><strong>Dose:</strong> ${dose}</p>
                        </div>
                    </div>`;

                $('.medicine-list').append(html);

                // Clear input field
                $('#medicineSelect').val('');
                $('#medicineInput').val('');
                $("input[name='items[0][schedule']").prop('checked', false);
                $("input[name='items[0][takingTime']").prop('checked', false);
                $('#durationSelect').val('');
                // $('#durationText').val('');
                $('#doseSelect').val('');
                // $('#doseText').val('');
            });

            // Remove Medicine
            $(document).on('click', '.btn-danger', function() {
                $(this).closest('.card').remove();
            });

            // Save Prescription
            $('#save-btns').click(function(event) {
                event.preventDefault();
                let medicines = [];
                $('.medicine-list .card').each(function(index) {
                    let medicine = $(this).find('.medicine').text();
                    let schedule = $(this).find('.schedule').text().split(': ')[1];
                    let takingTime = $(this).find('.takingTime').text().split(': ')[1];
                    let duration = $(this).find('.duration').text().split(': ')[1];
                    let dose = $(this).find('.dose').text().split(': ')[1];

                    medicines.push({
                        medicine: medicine,
                        schedule: schedule,
                        takingTime: takingTime,
                        duration: duration,
                        dose: dose
                    });

                    // Create hidden input fields for each medicine property
                    $('#test-id').append(
                        `<input type="hidden" name="items[${index}][medicine]" value="${medicine}">`
                        );
                    $('#test-id').append(
                        `<input type="hidden" name="items[${index}][schedule]" value="${schedule}">`
                        );
                    $('#test-id').append(
                        `<input type="hidden" name="items[${index}][takingTime]" value="${takingTime}">`
                        );
                    $('#test-id').append(
                        `<input type="hidden" name="items[${index}][duration]" value="${duration}">`
                        );
                    $('#test-id').append(
                        `<input type="hidden" name="items[${index}][dose]" value="${dose}">`);
                });

                // Submit the form
                $('#test-id').off('submit').submit();
            });
        });
    </script>
@endpush
