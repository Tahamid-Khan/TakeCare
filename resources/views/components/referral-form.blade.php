<div class="">
    <h3 class="h3">Refer Patient to Other Hospital</h3>
    @if(!isset($alreadyReferred))
        <form action="{{ route('dashboard.refer-patient') }}" method="POST"> @csrf
            <input type="hidden" name="patient_id" value="{{ $patientLists->id }}">
            <input type="hidden" name="hospital_id" value="" id="hospital-id">

            <div class="form-group" id="hospitalFields">
                <label for="hospital-name">Hospital Name</label>
                <input type="text" class="form-control" id="hospital-name" name="hospitalName">
                <div class="autocomplete-results-hospital"></div>
            </div>

            <div class="form-group">
                <label for="remark">Remark</label>
                <textarea class="form-control" id="remark" name="remark" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Refer Patient</button>
        </form>
    @else
        <div class="alert alert-warning">This patient is already referred to another hospital.</div>
    @endif
</div>


<script>
    function attachAutocompleteHandlerForHospitalSearch() {
        document.getElementById('hospital-name').addEventListener('input', function () {
            let query = this.value;
            if (query.length >= 3) {
                $.ajax({
                    url: "{{ route('get-hospitals') }}",  // Update this to your actual route for hospital search
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function (data) {
                        const resultsContainer = document.querySelector('.autocomplete-results-hospital');
                        resultsContainer.innerHTML = '';  // Clear previous results
                        if (data.length > 0) {
                            resultsContainer.style.display = 'block';  // Show the results box
                            data.forEach(function (item) {
                                const resultItem = document.createElement('a');
                                resultItem.classList.add('list-group-item', 'list-group-item-action');
                                resultItem.textContent = item.name;
                                resultItem.dataset.id = item.id;
                                resultItem.href = '#';
                                resultItem.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    document.getElementById('hospital-name').value = item.name;
                                    document.getElementById('hospital-id').value = item.id;
                                    resultsContainer.style.display = 'none';  // Hide the results box
                                });
                                resultsContainer.appendChild(resultItem);
                            });
                        } else {
                            resultsContainer.style.display = 'none';  // Hide the results box if no results
                        }
                    }
                });
            } else {
                const resultsContainer = document.querySelector('.autocomplete-results-hospital');
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
            }
        });
    }

    // Attach the handler after the document is ready
    document.addEventListener('DOMContentLoaded', function () {
        attachAutocompleteHandlerForHospitalSearch();
    });

</script>
