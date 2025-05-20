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
        font-size: 14px;
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
                                    <h4 class="center h4">Product Invoice</h4>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h2 class="h4">Customer Details</h2>
                            <p><strong>Name:</strong> {{ $customer['name'] }}</p>
                            <p><strong>Phone:</strong> {{ $customer['phone'] }}</p>
                            <p><strong>Address:</strong> {{ $customer['address'] }} </p>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped" id="client0rder">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product</th>
                                        <th>Product Id</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($products))
                                        @php $i = 1; @endphp

                                        @foreach ($products as $v)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $v['name'] }}</td>
                                                <td>{{ $v['id'] }}</td>
                                                <td>{{ $v['quantity'] }}</td>
                                                <td>{{ $v['price'] }}</td>
                                                <td>{{ $v['total'] }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="5" class="colspan">Total</td>
                                            <td>{{ $totalPrice }}</td>
                                        </tr>
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
