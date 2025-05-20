@extends('layouts.app')
@section('mainContent')
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <div class="content-wrapper">
       <section class="content">
           <div class="">
               <div class="row">
                   <div class="col-12">
                       <div class="card">
                           <div class="card-header">
                                <div class="row justify-content-between">
                                    <h3 class="h3">Patient Lists</h3>
                                    <div class="text-right">
                                        <a class="btn btn-sm btn-secondary" title="Patient" href="{{route('reception.create')}}" style="line-height: 1.5 !important;"><i class="fas fa-pus"></i> Add Patient</a>
                                    </div>
                                </div>
                           </div>
                           <div class="card-body">
                               <table class="table table-bordered table-striped" id="classList">
                               <thead>
                                        <th>Patient ID</th>
                                        <th>Barcode</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </thead>

                                   <tbody>
                                   @php
                                       $i=1;
                                   @endphp
                                   @foreach($patientLists as $k=>$patientList)
                                       <tr>
                                           <td>{{$patientList->patient_id}}</td>
                                           <td class="flex justify-center">{!! DNS1D::getBarcodeSVG ("$patientList->patient_id", 'C39', 1) !!}</td>
                                           <td>{{$patientList->name}}</td>
                                           <td>{{$patientList->mobile}}</td>
                                           <td>
                                           <a href="{{route('reception.view',$patientList->id)}}" class="btn btn-sm btn-info my-2" title="View"><i class="fas fa-eye" aria-hidden="true"></i></a>
                                               <a href="{{route('reception.edit',$patientList->id)}}" class="btn btn-sm btn-success my-2" title="Edit"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                               <a onclick="deleteConfirm({{$patientList->id}})" class="btn btn-sm btn-danger my-2" title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></a>
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
                "order": [],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#branch_wrapper .col-md-6:eq(0)');
        });
        function deleteConfirm(id)
        {
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Are you sure to delete this record!")) {
                $.ajax({
                    url: 'reception/delete/' + id,
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

