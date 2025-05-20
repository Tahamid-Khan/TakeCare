@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .notice-title {
            font-size: 28px;
        }

        .notice-date {
            color: green;
            font-size: 16px;
        }

        .latest-notices {
            border: 1px solid #007bff;
        }

        .latest-notices h5 {
            background-color: #007bff;
            color: white;
            padding: 10px;
        }

        .notice-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .notice-item:hover {
            background-color: #f1f1f1;
        }

        .all-notices {
            text-align: center;
            padding: 10px;
        }
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h2 class="h2 font-weight-bold">Notice Details</h2>
                </div>

                <div class="p-4 mt-3">
                    <div class="row">
                        <!-- Left Column: Notice Details -->
                        <div class="col-md-8">
                            <h1 class="notice-title">{{ $notice->title }}</h1>
                            <p class="notice-date my-2">
                                <span class="text-capitalize">{{ str_replace('_', ' ', $notice->type) }}</span> | {{ $notice->created_at->format('d-m-Y') }}
                            </p>
                            <div class="border p-3 my-3">
                                <p>{!! $notice->description !!}</p>
                            </div>
                            <div class="border">
                                <iframe src="{{ asset('uploads/notice/'. $notice->file) }}" width="100%" height="600px"></iframe>
                            </div>
                        </div>

                        <!-- Right Column: Latest Notices -->
                        <div class="col-md-4 mt-5">
                            <div class="latest-notices">
                                <h5>Latest Notice</h5>
                                @foreach ($latestNotices as $item)
                                    <a href="{{route('notice.show',$item->notice->id)}}">
                                        <div class="notice-item">
                                            <p>
                                                <span class="text-capitalize">{{ str_replace('_', ' ', $item->notice->type) }}</span> | {{ $item->notice->created_at->format('d-m-Y') }}
                                                <br><strong>{{ $item->notice->title }}</strong>
                                            </p>
                                            @if($item->notice->description)
                                                <p>{{ substr($item->notice->description, 0, 100) }}...</p>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach

                                <div class="all-notices">
                                    <a href="{{ route('notice-board') }}">
                                        <button class="btn btn-primary">All Notice</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
@endpush
