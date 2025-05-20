<style type="text/css">
    #client0rder{
        display: table;
        width: 100%;
        font-size: 11px;
        border-collapse: collapse;
    }
    #client0rder, td, th {
        border: 1px solid black;
        font-size: 11px;
    }
    .text-bold {
        font-weight: bold;
    }
    .center{
    text-align: center;
    }
    .colspan{
        text-align: right;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-sm-6 col-6">
                                <div class="card-body d-flex flex-row justify-content-end">
                                    <h4 class="text-bold center">Pathology Report</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">


                                <table class="table table-bordered table-striped" id="client0rder">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($lists))
                                        @php
                                            $i=1;
                                            $total=0;
                                            $var=0;
                                        @endphp
                                        @foreach($lists as $v)
                                            <tr id="gid{{ $v->id }}">
                                                <td>{{ $i++ }}</td>
                                           <td>{{$v->pathology_id}}</td>
                                           <td>@if($v->type == 0)
                                           OPD
                                           @else
                                           IPD
                                           @endif
                                            </td>
                                            <td>{{$v->patient->patient_id}}</td>
                                            <td>{{$v->doctor->name}}</td>
                                           <td>{{$v->name}}
                                           {{$v->mobile}}
                                           {{$v->gender}},
                                           Age:{{$v->age}}
                                           </td>
                                           <td>{{$v->reference}}</td>
                                           <td>
                                            @php
                                                $testListDetails = json_decode($v->test_list_details);
                                            @endphp

                                            @foreach ($testListDetails as $test)
                                                <p>{{ $test->name }},
                                                {{ $test->price }}TK, {{ $test->days }}Days</p>
                                            @endforeach
                                        </td>
                                           <td>{{$v->remark}}</td>
                                           <td>{{$v->date}}</td>
                                           <td>{{$v->delivery_date}}
                                            Time: {{$v->delivery_time}}
                                           </td>
                                           <td>
                                           @if($v->account == 1)
                                           Cash
                                           @else
                                           Bkash
                                           @endif
                                           </td>
                                            <td>{{$v->total}} TK</td>
                                            <td>{{$v->discount}} %</td>
                                            <td>{{$v->payable}} TK</td>
                                           <td>{{$v->paid}} TK</td>
                                           <td>{{$v->due}} TK</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
