<div>
    <div class="">
        <h3 class="h3 mb-4">Patient's Previous Medicines</h3>

        <!-- Previous Medicines Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Medicine Name</th>
                    <th>Schedule</th>
                    <th>Taking Time</th>
                    <th>Duration</th>
                    <th>Dosage</th>
                </tr>
            </thead>
            @if ($patientInactiveMedicines == [])
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">No Previous Medicines Found</td>
                    </tr>
                </tbody>
            @else
                <tbody>

                    <!-- Sample Data -->
                    @foreach ($patientInactiveMedicines as $key => $medicines)

                        <tr class="doctor-name-container">
                            <td colspan="6" class="doctor-name-heading">{{ $key }}</td>
                        </tr>
                        @foreach ($medicines as $item)
                            @php
                                $schedule = json_decode($item['schedule']);
                            @endphp
                            <tr>
                                <td>{{ $item['date'] }}</td>
                                <td>{{ $item['medicine_name'] }}</td>
                                <td>
                                    {{ in_array('morning', $schedule) ? '1+' : '0+' }}
                                    {{ in_array('afternoon', $schedule) ? '1+' : '0+' }}
                                    {{ in_array('evening', $schedule) ? '1' : '0' }}
                                </td>
                                <td class="capitalize">{{ $item['taking_time'] }} meal</td>
                                <td>{{ $item['duration'] }}</td>
                                <td>{{ $item['dose'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach

                </tbody>
            @endif

        </table>

    </div>


</div>
