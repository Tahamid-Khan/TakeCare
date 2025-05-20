@extends('layouts.app')

@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="content-wrapper" >
       <section class="content">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-12">
                       <div class="card">
                        <!-- Date filter form -->
                        <form action="{{ route('pathology.report') }}" method="GET">
                            @csrf
                            <div class="row ml-2 mt-2">
                                <div class="col-md-3">
                                <label for="doctor">Doctor</label>
                                    <select class="form-control" name="doctor" id="doctor" autofocus>
                                        <option value="" selected disabled hidden>---</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ request('doctor') == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                <label for="test">Test</label>
                                    <select class="form-control" name="test" id="test" autofocus>
                                        <option value="" selected disabled hidden>---</option>
                                        @foreach($tests as $test)
                                            <option value="{{ $test->name }}" {{ request('test') == $test->name ? 'selected' : '' }} >{{ $test->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="form-group row">
                                <div class="col-12 mt-4 text-right">
                                    <button type="submit"  name="submit" value="filter" class="btn btn-info">Filter</button>
                                    <a class="btn btn-secondary mr-2" href="{{route('pathology.report')}}">Reset</a>
                                    <button type="submit"  name="submit" value="pdf" class="btn btn-danger">PDF</button>
                                    <button type="submit"  name="submit" value="excel" class="btn btn-success">Excel</button>
                                </div>
                            </div>
                            </div>
                        </form>
                           <div class="card-header">
                               <h3 class="h3">Pathology Lists</h3>
                           </div>
                           <div class="card-body">
                               <table class="table table-bordered table-striped" id="classList">
                               <thead>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>patientId</th>
                                        <th>Doctor</th>
                                        <th>Info</th>
                                        <th>Reference</th>
                                        <th>Test Details</th>
                                        <th>Remark</th>
                                        <th>Created Date</th>
                                        <th>Delivery</th>
                                        <th>Account</th>
                                        <th>Total</th>
                                        <th>Discount </th>
                                        <th>Payable</th>
                                        <th>Total Paid</th>
                                        <th>Due</th>
                                    </thead>

                                   <tbody>
                                   @php
                                       $i=1;
                                   @endphp
                                   @foreach($lists as $k=>$testList)
                                       <tr>
                                           <td>{{$testList->pathology_id}}</td>
                                           <td>@if($testList->type == 0)
                                           OPD
                                           @else
                                           IPD
                                           @endif
                                            </td>
                                            <td>{{$testList->patient->patient_id}}</td>
                                            <td>{{$testList->doctor->name}}</td>
                                           <td>{{$testList->name}}
                                           {{$testList->mobile}}
                                           {{$testList->gender}},
                                           Age:{{$testList->age}}
                                           </td>
                                           <td>{{$testList->reference}}</td>
                                           <td>
                                            @php
                                                $testListDetails = json_decode($testList->test_list_details);
                                            @endphp

                                            @foreach ($testListDetails as $test)
                                                <p>{{ $test->name }},
                                                    <span class="taka-small">&#2547; </span>{{ $test->price }}, {{ $test->days }}Days</p>
                                            @endforeach
                                        </td>
                                           <td>{{$testList->remark}}</td>
                                           <td>{{$testList->date}}</td>
                                           <td>{{$testList->delivery_date}}
                                            Time: {{$testList->delivery_time}}
                                           </td>
                                           <td>
                                           @if($testList->account == 1)
                                           Cash
                                           @else
                                           Bkash
                                           @endif
                                           </td>
                                            <td><span class="taka-small">&#2547; </span>{{$testList->total}}</td>
                                            <td>{{$testList->discount}} %</td>
                                            <td><span class="taka-small">&#2547; </span>{{$testList->payable}}</td>
                                           <td><span class="taka-small">&#2547; </span>{{$testList->paid}}</td>
                                           <td><span class="taka-small">&#2547; </span>{{$testList->due}}</td>
                                       </tr>
                                   @endforeach
                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   </div>
@endsection

@push('custom_js')
    <script>
        $(function () {
            $("#classList").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
        function deleteConfirm(id)
        {
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are you sure to delete this record!")) {
                $.ajax({
                    url: 'pathology/delete/' + id,
                    type: 'get',
                    success: function (status)
                    {
                        if(status.status==1){
                            window.location.reload();
                        }
                    }
                })
            }
        }
    </script>
@endpush
