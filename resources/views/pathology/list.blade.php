@extends('layouts.app')
@section('mainContent')
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <div class="content-wrapper">
       <section class="content">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-12">
                       <div class="card">
                           <div class="card-header">
                                <div class="row justify-content-between">
                                    <h3 class="h3">Patient Lists</h3>
                                    <div>
                                        <a class="btn btn-sm btn-secondary" title="Patient" href="{{route('pathology.create')}}" style="line-height: 1.5 !important;"><i class="fas fa-pus"></i> Add Patient</a>
                                    </div>
                                </div>
                           </div>
                           <div class="card-body">
                               <table class="table table-bordered table-striped" id="classList">
                               <thead>
                                        <th>ID</th>
                                        <th>Info</th>
                                        <th>Delivery</th>
                                        <th>Total Paid</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>

                                   <tbody>
                                   @php
                                       $i=1;
                                   @endphp
                                   @foreach($testLists as $k=>$testList)
                                       <tr>
                                           <td>{{$testList->pathology_id}}</td>
                                           <td>{{$testList->name}}
                                           {{$testList->mobile}}
                                           {{$testList->gender}},
                                           Age:{{$testList->age}}
                                           </td>
                                           <td>{{$testList->delivery_date}}
                                            Time: {{$testList->delivery_time}}

                                           </td>
                                           <td><span class="taka-small">&#2547; </span>{{$testList->paid}}</td>
                                           <td>
                                            <select class="status-dropdown" data-testlist-id="{{ $testList->id }}">
                                                <option value="0" {{ $testList->status == 0 ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ $testList->status == 1 ? 'selected' : '' }}>Processing</option>
                                                <option value="2" {{ $testList->status == 2 ? 'selected' : '' }}>Ready for Delivery</option>
                                                <option value="3" {{ $testList->status == 3 ? 'selected' : '' }}>Delivery</option>
                                            </select>
                                            </td>

                                           <td>
                                               <a href="{{route('pathology.edit',$testList->id)}}" class="btn btn-sm btn-success my-2" title="Edit"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                               <a onclick="deleteConfirm({{$testList->id}})" class="btn btn-sm btn-danger my-2" title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></a>
                                           </td>
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
    <!-- Include jQuery -->

<script>
    $(document).ready(function() {
        $('.status-dropdown').change(function() {
            var testListId = $(this).data('testlist-id');
            var newStatus = $(this).val();

            // Send an AJAX request to update the status
            $.ajax({
                type: 'POST',
                url: '/pathology/update/status/',
                data: {
                    testListId: testListId,
                    newStatus: newStatus
                },
                success: function(response) {

                    alert('Status updated successfully');
                },
                error: function(error) {
                    console.error('Error updating status:', error);
                }
            });
        });
    });
</script>

@endpush

