<div>
    <div class="">
        <h3 class="h3 mb-4">Patient's Operation List</h3>

        <!-- Previous Medicines Table -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Operation Name</th>
                    <th>Doctor</th>
                    <th>OT Charge</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                <!-- Sample Data -->
                @if(isset($previousOperation[0]))
                    <tr class="doctor-name-container">
                        <td colspan="6" class="doctor-name-heading">Most Recent Operation</td>
                    </tr>

                    @foreach($previousOperation as  $item)
                        <tr>
                            <td> {{ $item->operation_date }} {{ $item->operation_time }} </td>
                            <td class="capitalize">{{ $item->service->name }}</td>
                            <td>{{ $item->doctor->name }}</td>
                            <td>{{ number_format($item->service->price, 2) }}</td>
                            <td>
                                <button class="btn btn-sm btn-info my-2" data-toggle="modal"
                                        data-target="#show-timeline-modal"
                                        data-operation-start="{{ $item->operation_start_time }}"
                                        data-anesthesia-given="{{ $item->anesthesia_given_time }}"
                                        data-operation-end="{{ $item->operation_end_time }}"
                                        data-remark="{{ $item->remarks }}"
                                        data-material-used="{{ $item->materials_used }}"
                                        title="View">
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif

                @if(isset($nextOperation[0]))
                    <tr class="doctor-name-container">
                        <td colspan="6" class="doctor-name-heading">Upcoming Scheduled Operation</td>
                    </tr>
                    @foreach($nextOperation as  $item)
                        <tr>
                            <td> {{ $item->operation_date }} {{ $item->operation_time }} </td>
                            <td class="capitalize">{{ $item->service->name }}</td>
                            <td>{{ $item->doctor->name }}</td>
                            <td>{{ number_format($item->service->price, 2) }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                {{-- @endif --}}

            </table>
        </div>
    </div>

    <style>
        .screen {
            min-width: 800px;
        }

        /* add media query */
        @media (max-width: 768px) {
            .screen {
                min-width: 355px;
            }
        }
    </style>

    <!-- Modal for Showing Timeline -->
    <div class="modal fade" id="show-timeline-modal" tabindex="-1" role="dialog" aria-labelledby="showTimelineModal"
         aria-hidden="true">
        <div class="modal-dialog screen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="h3" id="showTimelineModal">OT Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="">

                        <!-- Timeline -->
                        <div class="">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h2 class="mb-4 h4">Timeline</h2>
                                    <ul class="list-unstyled">
                                        <li class="d-flex mb-4">
                                            <span
                                                class="mr-4 d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                                                style="width: 40px; height: 40px;">1</span>
                                            <div>
                                                <h3 id="operation-started" class="font-weight-bold"></h3>
                                                <p>Operation Started</p>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4">
                                            <span
                                                class="mr-4 d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                                                style="width: 40px; height: 40px;">3</span>
                                            <div>
                                                <h3 id="anesthesia-given" class="font-weight-bold"></h3>
                                                <p>Anesthesia Given</p>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4">
                                            <span
                                                class="mr-4 d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                                                style="width: 40px; height: 40px;">4</span>
                                            <div>
                                                <h3 id="operation-end" class="font-weight-bold"></h3>
                                                <p>Operation Ended</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr>
                                    <div class="my-2">
                                        <h3 class="h4">Remarks</h3>
                                        <p id="remarks">Lorem</p>
                                    </div>
                                    <hr>
                                    <div class="my-2">
                                        <h3 class="h4">Material Used</h3>
                                        <p id="materials-used">Lorem</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom_js')
    <script>
        $('#show-timeline-modal').on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            let operationStart = button.data('operation-start');
            let anesthesiaGiven = button.data('anesthesia-given');
            let operationEnd = button.data('operation-end');
            const remarks = button.data('remark');
            let materialsUsed = button.data('material-used');

            materialsUsed = materialsUsed ? materialsUsed.map(material => material.name).join(', ') : 'N/A';


            operationStart = operationStart ? moment(operationStart, 'HH:mm:ss').format('hh:mm A') : 'N/A';
            anesthesiaGiven = anesthesiaGiven ? moment(anesthesiaGiven, 'HH:mm:ss').format('hh:mm A') : 'N/A';
            operationEnd = operationEnd ? moment(operationEnd, 'HH:mm:ss').format('hh:mm A') : 'N/A';

            const modal = $(this);
            modal.find('#operation-started').text(operationStart);
            modal.find('#anesthesia-given').text(anesthesiaGiven);
            modal.find('#operation-end').text(operationEnd);
            modal.find('#remarks').text(remarks);
            modal.find('#materials-used').text(materialsUsed);
        });
    </script>
@endpush
