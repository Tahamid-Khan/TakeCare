@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .mail-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="">
                <!-- Mail View Section -->
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h2 font-weight-bold">View Message</h2>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-between pl-2">
                                <h4 class="h4">
                                    <strong>Subject: </strong> {{ $message->subject }}
                                </h4>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#replyModal">Reply
                                    </button>
                                    {{--<button class="btn btn-sm btn-outline-secondary">Forward</button>--}}
                                </div>
                            </div>
                            <div class="my-4">
                                <strong>From:</strong>
                                <span>{{ $message->fromDept->name }}</span><br>
                                <strong>To:</strong>
                                <span>{{ $message->toDept->name }}</span><br>
                                <strong>Date:</strong>
                                <span>{{ $message->created_at->format("F j, Y, g:i a") }}</span>
                            </div>
                            <hr>
                            <div class="mail-content my-4">
                                {{ $message->message }}
                                @if($message->voice)
                                    <div class="mb-3 mt-3 ">
                                        <audio controls>
                                            <source src="{{ asset($message->voice) }}" type="audio/webm">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                @endif

                                <p class="text-success">
                                    <br> Sent By
                                    <br>
                                    {{ $message->user->name }}
                                </p>
                            </div>
                            <hr>
                            <!-- Attachments Section -->
                            <div class="attachments my-4">
                                <h6 class="h6">Attachments:</h6>
                                <div class="mb-2">
                                    @if($message->attachment)
                                        <a href="{{ asset('attachments/'. $message->attachment) }}" download class="btn btn-outline-secondary btn-sm">{{ $message->attachment }}</a>
                                    @else
                                        <span class="text-muted ms-2">No attachments</span>
                                    @endif
                                    {{--                                    <span class="text-muted ms-2">(5 MB)</span>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reply Modal -->
                    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h5" id="replyModalLabel">Reply Message</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('message-reply') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="messageId" value="{{ $message->id }}">
                                        <div class="form-group">
                                            <label for="replyMessage" class="form-label">Message</label>
                                            <textarea name="replyMessage" id="replyMessage" class="form-control" rows="5" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="attachments" class="form-label">Attachment</label>
                                            <input type="file" name="attachment" id="attachments" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Replied Messages -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h4 class="h4">Comments</h4>
                        </div>
                        @foreach($message->replies as $item)
                            <div class="card-body">

                                <div class="rounded-lg border mb-4">
                                    <div class="d-flex justify-content-between {{ $message->from == $item->from ? 'bg-success' : 'bg-info'}} p-3 rounded-top">
                                        <h6 class="h6 mb-0">From: {{ $item->fromDept->name }}</h6>
                                        <div class="small">Date: {{ $item->created_at->format("F j, Y | g:i A") }}</div>
                                    </div>
                                    <hr>
                                    <div class="mail-content p-3">
                                        {{ $item->message }}

                                        <p class="text-success">
                                            <br> Sent By
                                            <br>
                                            {{ $item->user->name }}
                                        </p>


                                    </div>

                                    <hr>
                                    <!-- Attachments Section -->
                                    <div class="attachments p-3">
                                        <h6 class="h6">Attachments:</h6>
                                        <div class="mb-2">
                                            @if($item->attachment)
                                                <a href="{{ asset('attachments/'. $item->attachment) }}" download class="btn btn-outline-secondary btn-sm">{{ $item->attachment }}</a>
                                            @else
                                                <span class="text-muted ms-2">No attachments</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
@endpush
