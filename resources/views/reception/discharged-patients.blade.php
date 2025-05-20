@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper">
        <section class="content ">
            <div class="">
                <div class="p-3 rounded-lg" style="background-color: #f8f9fa">
                    <h2 class="mb-4 text-xl font-semibold">Patient Lists</h2>

                    <style>
                        .bg-danger-light {
                            background-color: #f8d7da;
                        }

                        .text-lg {
                            font-size: 1.25rem;
                        }

                        .font-semibold {
                            font-weight: 600;
                        }

                        .display-4 {
                            font-size: 2rem;
                            font-weight: 700;
                        }

                    </style>
                    <div class="row mb-4">
                        <div class="col-12 col-lg-12">
                            <div class="row">
                                <!-- Card 1 -->
                                <div class="col-12 col-md-4 col-xl-3 mb-4">
                                    <div class="rounded-lg bg-danger-light p-3 shadow">
                                        <h3 class="mb-2 h5">Total Discharge Patients</h3>
                                        <p class="h3 font-weight-bold text-danger">2</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="p-4 rounded-lg bg-white shadow-lg">
                    <h1 class="mb-4 form-label h3">Patient Discharge Request</h1>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped classList" id="">
                            <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Total Unpaid Invoice</th>
                            <th>Total Due Amount</th>
                            <th>Action</th>
                            </thead>


                            <tbody>
                            @foreach ($dischargeRequests as $item)
                                <tr>
                                    <td>{{ $item->patient->patient_id }}</td>
                                    <td>{{ $item->patient->name }}</td>
                                    <td>{{ $item->patient->patientDue->count() }}</td>
                                    <td><span class="taka-small">&#2547;</span>{{ number_format($item->patient->patientDue->sum('due_amount') , 2) }}</td>
                                    <td>
                                        @if ($item->patient->patientDue->count() == 0 )
                                            <form action="{{ route('reception.approve-discharge', $item->id) }}"
                                                  method="POST">@csrf
                                                <button type="submit" class="btn btn-sm btn-success my-2"
                                                        title="Approve & Print Discharge Letter">Approve & Print
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('reception.patient-invoice', ['id' => $item->patient->id]) }}"
                                               class="btn btn-sm btn-danger my-2" title="Complete Payment">Due
                                            </a>
                                        @endif
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
        $(function () {
            $(".classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const printId = urlParams.get('id');

        if (printId) {
            Swal.fire({
                title: 'Discharge Letter Created Successfully',
                text: "Do you want to print the letter?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Print it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open(`/discharge-letter/${printId}`, '_blank');
                    window.history.replaceState({}, document.title, window.location.pathname);
                }
            });
        }
    </script>
@endpush
