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
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-row justify-content-start text-bold">
                                            <h7>HR Infomration -Employee</h7>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="flex-row text-right">
                                            <a class="btn btn-sm btn-secondary my-2" title="Add Teacher" href="{{route('info.create')}}" style="line-height: 1.5 !important;"><i class="fas fa-pus"></i> Add Employee</a>
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="card-body">
                               <table class="table table-bordered table-striped" id="classList">
                               <thead>
                                    <th>Photo</th>
                                    <th>HR ID</th>
                                    <th>Fullname</th>
                                    <th>Designation</th>
                                    <th>Gender</th>
                                    <th>Mobile</th>
                                    <th>Joining</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                        @if(isset($allTeacherLists))
                                     @foreach($allTeacherLists as $k=>$allTeacherList)
                                            <tr>
                                                <td>@if($allTeacherList->hr_photo)
                                                    <img src="{{asset('').'img/human_resource/'.$allTeacherList->hr_photo}}" height="50px" width="50px">
                                                    @endif
                                                    </td>
                                                <td>{{$allTeacherList->hr_id}}</td>
                                                <td>{{$allTeacherList->hr_name}}</td>

                                                <td>
                                                    @if($allTeacherList->designation == 'Head Teacher')
                                                    Head Teacher
                                                    @elseif($allTeacherList->designation == 'Asst. Head Teacher')
                                                    Asst. Head Teacher
                                                    @elseif($allTeacherList->designation == 'Teacher')
                                                    Teacher
                                                    @elseif($allTeacherList->designation == 'Asst. Teacher')
                                                    Asst. Teacher
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($allTeacherList->gender == 'Male')
                                                    Male
                                                    @elseif($allTeacherList->gender == 'Female')
                                                    Female
                                                    @elseif($allTeacherList->gender == 'Others')
                                                    Others
                                                    @endif
                                                </td>
                                                <td>{{$allTeacherList->mobile_no}}</td>
                                                <td>{{$allTeacherList->joining_date}}</td>
                                                <td>
                                                    <a href="{{route('info.edit',$allTeacherList->id)}}" class="btn btn-sm btn-success my-2" title="Edit">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger my-2" title="Delete" onclick="deleteConfirm({{$allTeacherList->id}})">
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
                    url: 'info/delete/' + id,
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

