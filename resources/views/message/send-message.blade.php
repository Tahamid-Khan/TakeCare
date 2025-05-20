@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /*.select2-container--default .select2-selection--multiple .select2-selection__choice {*/
        /*    background-color: #008000;*/
        /*    border-color: #008000;*/
        /*    color: #fff;*/
        /*}*/

        /*.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {*/
        /*    color: #fff;*/
        /*}*/

        /*.select2-container--default .select2-selection--multiple .select2-selection__clear:hover {*/
        /*    color: red;*/
        /*}*/


        table tbody tr {
            background-color: #ffff !important;
        }

        /* table row hover */
        table tbody tr:hover {
            background-color: #aae0e0 !important;
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h2 class="h2 font-weight-bold">Send Message</h2>
                </div>

                <div class="p-4">
                    <div>
                        <button id="compose" type="button" class="btn btn-primary">Compose Message
                            <i class="fas fa-edit"></i>
                        </button>
                        <div class="d-flex justify-content-end">
                            <button id="dismiss" type="button" class="btn btn-danger d-none" data-toggle="modal" data-target="#dismissMessage">
                                Dismiss
                            </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="dismissMessage" tabindex="-1" role="dialog" aria-labelledby="dismissMessageLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title text-white" id="dismissMessageLabel">Dismiss Message</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to dismiss this message?
                                        <div class="row justify-content-end">
                                            <button id="yes-dismiss" type="button" class="btn btn-danger mr-2">Yes</button>
                                            <button type="button" class="btn btn-primary mr-2" data-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="compose-form" class="card-body d-none">
                        <form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data">@csrf

                            <div class="">
                                <!-- Select Department -->
                                <div class="col-md-3 form-group" style="padding-left: 0">
                                    <label for="department">To</label>
                                    <select class="form-control" id="department" name="department" required>
                                        <option value=""></option>
                                        {{--                                        <option value="all">Select All</option>--}}
                                        @foreach($departments as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!--Message Subject-->
                                <div class="form-group">
                                    <label for="subject">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" required>

                                    @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!--Message Body-->
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter Message" required></textarea>

                                    @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                {{--                                voice--}}
                                <label for="record">Voice Message</label>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-primary" id="startRecord">Start Recording</button>
                                    <button type="button" class="btn btn-danger" id="stopRecord" disabled>Stop Recording</button>
                                </div>

                                <audio id="audioPlayback" controls></audio>

                                <input type="hidden" id="voiceBlob" name="audio">

                                <script>
                                    let mediaRecorder;
                                    let audioChunks = [];

                                    document.getElementById('startRecord').addEventListener('click', async () => {
                                        const stream = await navigator.mediaDevices.getUserMedia({audio: true});
                                        mediaRecorder = new MediaRecorder(stream);
                                        mediaRecorder.start();

                                        document.getElementById('startRecord').disabled = true;
                                        document.getElementById('stopRecord').disabled = false;

                                        mediaRecorder.addEventListener('dataavailable', event => {
                                            audioChunks.push(event.data);
                                        });
                                    });

                                    document.getElementById('stopRecord').addEventListener('click', () => {
                                        mediaRecorder.stop();

                                        document.getElementById('stopRecord').disabled = true;

                                        mediaRecorder.addEventListener('stop', () => {
                                            const audioBlob = new Blob(audioChunks, {type: 'audio/webm'});
                                            const audioUrl = URL.createObjectURL(audioBlob);
                                            const audio = document.getElementById('audioPlayback');
                                            audio.src = audioUrl;

                                            // Convert audioBlob to a File object for form submission
                                            const file = new File([audioBlob], 'voice.webm', {type: 'audio/webm'});

                                            // Append file data to the hidden input field
                                            const reader = new FileReader();
                                            reader.readAsDataURL(file);
                                            reader.onloadend = () => {
                                                document.getElementById('voiceBlob').value = reader.result;
                                            };

                                            audioChunks = []; // Reset audio chunks for next recording
                                        });
                                    });
                                </script>


                                <!--Upload Attachment File-->
                                <div class="form-group">
                                    <label for="attachment">Attachment (optional)</label>
                                    <input type="file" class="form-control" id="attachment" name="attachment" placeholder="Upload Attachment">

                                    @error('attachment')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Send</button>
                        </form>
                    </div>

                    <div class="mt-4">
                        <h1 class="mb-4 form-label h3 font-semibold">All Messages</h1>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-3 form-group" style="padding-left: 0">
                                <form action="{{ route('message.index') }}" method="GET">
                                    <label for="messageType">Message Type</label>
                                    <select class="form-control" id="messageType" name="messageType">
                                        <option {{ request('messageType') == 'incoming' ? 'selected' : '' }} value="incoming">Incoming</option>
                                        <option {{ request('messageType') == 'outgoing' ? 'selected' : '' }} value="outgoing">Outgoing</option>
                                    </select>
                                </form>

                            </div>

                            {{--                            <div class="mt-3">--}}
                            {{--                                <button id="delete" type="button" class="btn btn-danger">Delete</button>--}}
                            {{--                            </div>--}}
                        </div>

                        <table class="table table-bordered table-striped" id="classList">
                            <thead>
                            {{--                            <th>--}}
                            {{--                                <input type="checkbox" id="checkAll">--}}
                            {{--                            </th>--}}
                            <th>Date & Time</th>
                            @if(request('messageType') == 'incoming')
                                <th>From</th>
                            @else
                                <th>To</th>
                            @endif
                            <th>Subject</th>
                            <th>Message</th>
                            </thead>

                            <tbody>
                            @foreach($messages as $item)
                                <tr data-id="{{$item->id}}">
                                    {{--                                    <td></td>--}}
                                    <td>{{ $item->created_at->format("F j, Y, g:i a") }}</td>
                                    @if(request('messageType') == 'incoming')
                                        <td>
                                            <a href="{{route('message.show', $item->id) }}">{{$item->fromDept->name}}</a>
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{route('message.show', $item->id) }}">{{$item->toDept->name}}</a>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="{{route('message.show', $item->id) }}">{{$item->subject}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('message.show', $item->id) }}">{{ Str::limit($item->message, 50) }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')

    <script>
        $(document).ready(function () {
            $('#compose').click(function () {
                $('#compose-form').removeClass('d-none');
                $('#dismiss').removeClass('d-none');
                $('#compose').addClass('d-none');
            });

            $('#yes-dismiss').click(function () {
                $('#compose-form').addClass('d-none');
                $('#dismiss').addClass('d-none');
                $('#compose').removeClass('d-none');
                $('#dismissMessage').modal('hide');
            });

            $('#messageType').change(function () {
                $(this).closest('form').submit();
            });
        });
    </script>
    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 6,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                // "columnDefs": [
                //     {
                //         "targets": 0,
                //         "orderable": false,
                //         "searchable": false,
                //         "width": "3%",
                //         "render": function (data, type, row) {
                //             return '<input type="checkbox" class="check">';
                //         }
                //     }
                // ],
                // "order": [[1, 'asc']]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');

            // $('#checkAll').on('click', function () {
            //     if (this.checked) {
            //         $('.check').each(function () {
            //             this.checked = true;
            //         });
            //     } else {
            //         $('.check').each(function () {
            //             this.checked = false;
            //         });
            //     }
            // });
            //
            // $('#delete').click(function () {
            //     let check = $('.check:checked').length;
            //     if (check > 0) {
            //         if (confirm('Are you sure you want to delete?')) {
            //             // Get all selected rows item-id
            //             let ids = [];
            //             $('.check:checked').each(function () {
            //                 ids.push($(this).closest('tr').data('id'));
            //             });
            //             $.ajax({
            //                 url: '/message/' + ids.join(','),
            //                 type: 'DELETE',
            //                 data: {
            //                     _token: $('meta[name="csrf-token"]').attr('content')
            //                 },
            //                 success: function (response) {
            //                     // console.log(response);
            //                     location.reload();
            //                 }
            //             });
            //         }
            //     } else {
            //         alert('Please select at least one row to delete');
            //     }
            // });
        });
    </script>
    <script>
        $(document).ready(function () {
            let department = $('#department');

            department.select2({
                placeholder: "Select Department"
            })

            // Add 'multiple' attribute after a short delay to avoid initial rendering issues
            // setTimeout(function () {
            //     // department.attr('multiple', 'multiple');
            //     // remove the first empty option
            //     // department.find('option:first').remove();
            //     department.select2({
            //         placeholder: "Select Department",
            //         // allowClear: true,
            //         // closeOnSelect: false
            //     });
            // }, 1);

            // Get all department IDs except 'Select All'
            {{--let allDepartment = @json($departments).map(department => department.id);--}}

            {{--department.on('change', function () {--}}
            {{--    let selectedValues = department.val();--}}

            {{--    // If the empty option is selected, clear it--}}
            {{--    if (selectedValues.includes('')) {--}}
            {{--        selectedValues = selectedValues.filter(value => value !== '');--}}
            {{--        department.val(selectedValues).trigger('change');--}}
            {{--    }--}}

            {{--    // If 'Select All' is selected, choose all departments--}}
            {{--    if (selectedValues.includes('all')) {--}}
            {{--        department.val(allDepartment).trigger('change');--}}
            {{--    }--}}
            {{--});--}}
        });
    </script>

@endpush
