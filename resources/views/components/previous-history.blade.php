<div>


    <style>
        .the-dropdown-list {
            display: none;
            background-color: #FFF;
            border: 1px solid #DDD;
            z-index: 10;
            box-shadow: 4px 4px 5px rgba(0, 0, 0, .3);
            list-style: none;
            margin: 0;
            padding: 0;
            max-height: 150px;
            overflow: auto;
            position: absolute;
            margin-top: 10px;
            width: 93% !important;
        }
        .the-dropdown-select {
            position: relative;
        }

        .the-dropdown-item {
            padding: 5px 20px;
            margin: 0;
            cursor: pointer;
        }

        .the-dropdown-item:hover {
            background-color: #F1F1F1;
        }
    </style>

    <div class="">
        <h3 class="h3 mb-4">Patient's Previous History</h3>

        <!-- Button to Add New History -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#addHistoryModal">Add New
            History</button>


        <!-- Previous History Table -->
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Condition</th>
                    <th>Treatment</th>
                    {{-- <th>Doctor</th> --}}
                </tr>
            </thead>
            @if ($patientPreviousHistory == [])
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">No Previous History Found</td>
                    </tr>
                </tbody>
            @else
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($patientPreviousHistory as $key=>$histories)
                    <tr class="doctor-name-container">
                        <td colspan="6" class="doctor-name-heading">{{ $key }}</td>
                    </tr>
                        @foreach ($histories as $item)
                        <tr>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['condition'] }}</td>
                            <td class="max-width-180">{{ $item['treatment'] }}</td>
                            {{-- <td>{{ $item->doctor->name }}</td> --}}
                        </tr>
                        @endforeach
                    @endforeach

                </tbody>
            @endif

        </table>
    </div>

    <!-- Modal for Adding New History -->
    <div class="modal fade" id="addHistoryModal" tabindex="-1" role="dialog" aria-labelledby="addHistoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="h3" id="addHistoryModalLabel">Add New History</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @php
                        // dd($patientLists);
                    @endphp
                    <!-- Form for Adding New History -->
                    <form action="{{ route('patient.previous-history', ['id' => $patientLists->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="historyDate">Date:</label>
                            <span class="text-danger">*</span>
                            <input type="date" class="form-control" id="historyDate" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="condition">Condition:</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="condition" name="condition" required>
                        </div>
                        <div class="form-group">
                            <label for="treatment">Treatment:</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="treatment" name="treatment" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="doctor-id">Doctor:</label>
                            <span class="text-danger">*</span>
                            <select name="doctor_id" id="doctor-id" class="form-control" required>
                                <option value="">Select Doctor</option>
                                @foreach ($dutyDoctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>

                        </div> --}}


                        <div class="form-group">
                            <div class="the-dropdown-select">
                                <label for="realitem">Doctor</label>
                                <input type="text" class="the-dropdown-input form-control" id="realitem" name="doctor_name"
                                    onkeyup="filter(this)" placeholder="Select Doctor" autocomplete="off" />
                                </span>
                            </div>
                            <ul class="the-dropdown-list" id="therealitems">
                                @foreach ($dutyDoctors as $doctor)
                                    <li class="the-dropdown-item">{{ $doctor->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-primary">Add History</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('custom_js')
    <script>
        function filter(element) {
            var value = $(element).val().toLowerCase();
            $("#therealitems li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        }

        $(document).ready(function() {
            $(".the-dropdown-select").on("click", function() {
                $(".the-dropdown-list").toggle();
            });

            $(".the-dropdown-item").on("click", function() {
                var selected = $(this).text();
                $("#realitem").val(selected);
                $(".the-dropdown-list").slideUp('fast');

            });
        });

        $(document).on('click', function(event) {
            if ($(event.target).closest(".the-dropdown-input, .the-select-btn").length)
                return;
            $('.the-dropdown-list').slideUp('fast');
            event.stopPropagation();
        });
    </script>
@endpush
