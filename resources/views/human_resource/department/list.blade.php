@extends('layouts.app')
@section('mainContent')
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <div class="content-wrapper">
       <section class="content">
           <div class="card">
               <div class="card-header">
                   <div class="row justify-content-between align-items-center">
                       <h2 class="h2 font-weight-bold">HR Infomration -Department</h2>
                       <div>
                           <a class="btn btn-sm btn-secondary" title="Add Teacher" href="{{route('department.create')}}" style="line-height: 1.5 !important;"><i class="fas fa-pus"></i> Add New</a>
                       </div>
                   </div>
               </div>

               <div class="card-body">
                   <table class="table table-bordered table-striped" id="classList">
                       <thead>
                       <th>ID</th>
                       <th>Name</th>
                       <th>Max Capacity</th>
                       <th>Total Employee</th>
                       <th>Blank</th>
                       <th>Phone</th>
                       <th>Status</th>
                       <th>Action</th>
                       </thead>
                       <tbody>
                       @if(isset($lists))
                           @foreach($lists as $k=>$list)
                               <tr>
                                   <td>{{$k+1}}</td>
                                   <td>{{$list->name}}</td>
                                   <td>{{$list->limit_emp}}</td>
                                   <td>{{$list->total_emp ?? 0}}</td>
                                   <td>{{$list->limit_emp - $list->total_emp}}</td>
                                   <td>{{$list->phone_number}}</td>
                                   <td>@if($list->status == 0)
                                           Off
                                       @else
                                           On
                                       @endif
                                   </td>
                                   <td>
                                       <a href="{{route('department.edit',$list->id)}}" class="btn btn-sm btn-success my-2" title="Edit">
                                           <i class="fas fa-edit" aria-hidden="true"></i>
                                       </a>
                                       <a class="btn btn-sm btn-danger my-2" title="Delete" onclick="deleteConfirm({{$list->id}})">
                                           <i class="fas fa-trash" aria-hidden="true"></i>
                                       </a>
                                   </td>
                               </tr>
                           @endforeach
                       @endif
                       </tbody>
                   </table>
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
                    url: 'department/delete/' + id,
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

