<style type="text/css">
    #client0rder {
        display: table;
        width: 100%;
        font-size: 11px;
        border-collapse: collapse;
    }

    #client0rder,
    td,
    th {
        border: 1px solid black;
        font-size: 11px;
    }

    .text-bold {
        font-weight: bold;
    }

    .center {
        text-align: center;
    }

    .colspan {
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
                                    <h4 class="text-bold center">Financial Statement</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">


                            <table class="table table-bordered table-striped" id="client0rder">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Fund</th>
                                        <th>Fund Includes</th>
                                        <th>Purpose</th>
                                        <th>Income</th>
                                        <th>Expenditure</th>
                                        <th>Available Fund</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($lists))
                                        @php
                                            $i = 1;
                                            $total = 0;
                                            $var = 0;
                                        @endphp
                                        @foreach ($lists as $v)
                                            <tr id="gid{{ $v->id }}">
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $v->date }}</td>
                                                <td>{{ $v->fund }}</td>
                                                <td>{{ $v->fund_includes }}</td>
                                                <td>{{ $v->purpose }}</td>
                                                <td>{{ $v->income }}</td>
                                                <td>{{ $v->expenditure }}</td>
                                                <td>{{ $v->available_fund }}</td>
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
