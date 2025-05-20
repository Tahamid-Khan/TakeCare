@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h2 class="h2 font-weight-bold">Notice Board</h2>
                </div>

                <div class="p-4 mt-4">
                    <!-- Header with Search Bar -->
                    <div class="col-md-4 pl-0">
                        <form class="d-flex">
                            <input class="form-control me-2" placeholder="Enter Keyword" aria-label="Search">
                            <button type="submit" class="btn btn-outline-primary ml-2">Search</button>
                        </form>
                    </div>


                        <!-- Notice List -->
                    <div class="py-3">
                        <ul class="list-group">
                            @foreach ($notices as $item)
                                <li class="list-group-item list-group-item-action">
                                    <div
                                        class="d-flex justify-content-between align-items-center list-group-item-action">
                                        <a href="{{route('notice.show', $item->notice->id)}}">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/notice.jpg') }}" alt="Notice Image"
                                                     class="rounded-circle custom-max-w border">
                                                <h4 class="mx-2 custom-notice-title">{{ $item->notice->title }}</h4>
                                            </div>
                                        </a>
                                        <div class="text-right">
                                            <div class="me-3 ">
                                                <div class="badge bg-success rounded-pill  p-1">{{ Str::title(str_replace('_', ' ', $item->notice->type)) }}
                                                </div>
                                                <button type="button" class="btn btn-sm hidden" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right ">
                                                    <button class="dropdown-item delete-notice" type="button"
                                                            data-id="{{ $item->notice->id }}">
                                                        <i class="fas fa-trash mr-2"></i>Delete
                                                    </button>
{{--                                                    <button class="dropdown-item mark-as-read" type="button"--}}
{{--                                                            data-id="{{ $item->id }}">--}}
{{--                                                        <i class="fas fa-eye-slash mr-1"></i>Mark As Read--}}
{{--                                                    </button>--}}
                                                </div>
                                            </div>
                                            <div class="badge bg-primary rounded-pill me-3">{{ $item->notice->created_at->format('d-m-Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('custom_js')
    <script>
        $(document).on('click', '.delete-notice', function () {
            let noticeId = $(this).data('id')
            // console.log(noticeId);
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this notice!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/notice/' + noticeId,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            // console.log(response);
                        }
                    });

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            });
        });

        // $(document).on('click', '.mark-as-read', function () {
        //     let noticeId = $(this).data('id')
        //     // console.log(noticeId);
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You want to mark this notice as read!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, mark as read!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Swal.fire(
        //                 'Marked!',
        //                 'Your notice has been marked as read.',
        //                 'success'
        //             )
        //         }
        //     });
        // });
    </script>
@endpush
