<div class="rounded border p-4 shadow-lg bg-white">
    <style>
        .display-4 {
            font-size: 2rem;
            font-weight: normal;
        }
    </style>
{{--@php(dd($patients))--}}
    @userType('nurse')
    <h2 class="py-3 display-4">Patient List - Ward No: <span
            class="font-weight-bold">{{  $ward->name }}</span></h2>
    @enduserType
    @userType('admin')
    <h2 class="py-3 display-4">Patient Lists</h2>
    @enduserType

    <div class="table-responsive">
        <table id="" class="table table-bordered table-striped classList">
            <thead>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Department</th>
                <th>Bed No</th>
                <th>Action</th>
            </thead>


            <tbody>
                @foreach ($patients as $item)
                    <tr>
                        <td>{{ $item->patient->patient_id }}</td>
                        <td>{{ $item->patient->name }}</td>
                        <td>{{ $item->patient->gender }} </td>
                        <td>{{ $item->patient->mobile }}</td>
                        <td>{{ $item->ward->location }}</td>
                        <td>{{ $item->bed_number }}</td>
                        <td>
                            <a href="{{ route('nurse.patientDetails', $item->patient->id) }}"
                                class="btn btn-sm btn-info my-2" title="View">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
