<style>
    .shadow-md {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .mw200 {
        max-width: 200px;
    }
</style>

<div class="mb-4 rounded-lg bg-white p-4 shadow-md">
    <h2 class="mb-4 text-xl font-semibold">ICU Information Update</h2>
    <form action="{{ route('icu.store', ['id'=>$patientData->patient_id]) }}" method="POST">
        <div class="mb-4"> @csrf
            <label class="mb-2 d-block font-weight-bold text-gray-700" for="location">Patient Location</label>
            <select id="location" class="form-control mw200" name="location">
                <option disabled>Select Location</option>
                <option value="1" {{ $patientData->isICU == 1 ? "selected" : ""}}>ICU</option>
                <option value="0" {{ $patientData->isICU == 1 ? "" : "selected"}}>HDU</option>
            </select>
        </div>


        <div class="py-4">

            <div class="d-flex flex-column flex-lg-row">
                <div class="col-lg-6">
                    <div class="col-md-10">
                        <div class="mb-3">
                            <label for="comments" class="form-label font-weight-bold">DR Comments:</label>
                            <textarea class="form-control" id="comments" name="comments" rows="5"
                                      placeholder="Enter comments here..."></textarea>
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
                                    <td class="text-center align-middle"><input type="checkbox" name="pulse_normal">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">Oxygen Level</td>
                                    <td><input type="number" class="form-control" name="oxygen_input"
                                               placeholder="in %"></td>
                                    <td class="text-center align-middle"><input type="checkbox" name="oxygen_normal">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start">BP</td>
                                    <td><input type="number" class="form-control" name="bp_input"
                                               placeholder="in mmHg"></td>
                                    <td class="text-center align-middle"><input type="checkbox" name="bp_normal"></td>
                                </tr>
                                <tr>
                                    <td class="text-start">Body Temperature</td>
                                    <td><input type="number" class="form-control" name="temperature_input"
                                               placeholder="in °F"></td>
                                    <td class="text-center align-middle"><input type="checkbox" name="bp_normal"></td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td class="text-start">Test Needed</td>--}}
{{--                                    <td><input type="text" class="form-control" name="test_input"></td>--}}
{{--                                    <td class="text-center align-middle">-----</td>--}}
{{--                                </tr>--}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <div>
                <div id="manual-service-section">
                    <div class="form-row align-items-center mb-3">
                        <div class="col-12 col-md-2 mb-2">
                            <label for="" class="">Manual Service Name</label>
                        </div>


                        <div class="col-12 col-md-2 mb-2">
                            <label for="" class="">Amount</label>
                        </div>
                        <div class="col-12 col-md-2 mb-2">
                        </div>
                    </div>
                    <div class="form-row align-items-center mb-3">
                        <div class="col-12 col-md-2 mb-2">
                            <input type="text" class="form-control manual-item-name" id="manual-item-name-0"
                                   name="manual_services[0][name]" placeholder="Service Name">
                        </div>


                        <div class="col-12 col-md-2 mb-2">
                            <input type="number" class="form-control" id="manual-amount-0"
                                   name="manual_services[0][amount]" placeholder="Amount">
                        </div>

                        <div class="col-12 col-md-2 mb-2">
                            <button type="button" class="btn btn-danger" onclick="removeManualItem(this)">
                                &times;
                            </button>
                        </div>

                    </div>
                </div>

                <button type="button" class="btn btn-primary mb-4" onclick="addManualItem()"><i
                        class="fas fa-plus"></i></button>

                <div class="mb-4">
                    <div id="manual-invoice-details">
                        <!-- Dynamic list of manual services will be displayed here -->
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
    let manualItemCount = 1;

    function addManualItem() {
        const itemContainer = document.createElement('div');
        itemContainer.classList.add('form-row', 'align-items-center', 'mb-3');
        itemContainer.innerHTML = `
                <div class="col-12 col-md-2 mb-2">
                    <input type="text" class="form-control manual-item-name" id="manual-item-name-${manualItemCount}" name="manual_services[${manualItemCount}][name]" placeholder="Service Name">
                </div>



        <div class="col-12 col-md-2 mb-2">
            <input type="number" class="form-control" id="manual-amount-${manualItemCount}" name="manual_services[${manualItemCount}][amount]" placeholder="Amount">
                </div>

                <div class="col-12 col-md-2 mb-2">
                    <button type="button" class="btn btn-danger" onclick="removeManualItem(this)">
                        &times;
                    </button>
                </div>`;
        document.getElementById('manual-service-section').appendChild(itemContainer);
        manualItemCount++;
        calculateTotal();
    }

    // Remove item and recalculate total
    function removeManualItem(button) {
        button.closest('.form-row').remove();
        calculateTotal();
    }
</script>
