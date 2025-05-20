<div>
    <div class="">
        <h3 class="h3 mb-4">Patient's Previous History</h3>

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
