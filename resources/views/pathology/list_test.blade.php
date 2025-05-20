@extends('layouts.app')
@section('mainContent')
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <div class="content-wrapper">
       <section class="content">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-12">
                       <div class="card">
                           <div class="row justify-content-between px-4 py-2">
                               <h3 class="h3">Test Details</h3>
                               <div class="text-right">
                                   <a class="btn btn-sm btn-secondary" title="Patient" href="{{route('pathology.create_test')}}" style="line-height: 1.5 !important;"><i class="fas fa-pus"></i> Add New</a>
                               </div>
                           </div>
                           <div class="card-body">
                               <table class="table table-bordered table-striped" id="classList">
                               <thead>
                                        <th>Test Name</th>
                                        <th>Delivery Days</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </thead>

                                   <tbody>
                                   @php
                                       $i=1;
                                   @endphp
                                   @foreach($testLists as $k=>$testList)
                                       <tr>
                                           <td>{{$testList->name}}</td>
                                           <td>{{$testList->delivery_days}}</td>
                                           <td><span class="taka-small">&#2547; </span>{{$testList->amount}}</td>
                                           <td>
                                               <a href="{{route('pathology.edit_test',$testList->id)}}" class="btn btn-sm btn-success my-2" title="Edit"><i class="fas fa-edit" aria-hidden="true"></i></a>
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
                    url: '{{ route("pathology.delete_test", ["id" => ":id"]) }}'.replace(':id', id),
                    type: 'get',
                    success: function (status)
                    {
                        if(status.status === 1){
                            window.location.reload();
                        } else {
                            console.error('Deletion failed');
                        }
                    }
                })
            }
        }

</script>
@endpush

