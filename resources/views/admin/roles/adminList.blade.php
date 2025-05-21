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
                                    <h2 class="h2 font-weight-bold">User Lists</h2>
                                    <div class="">
                                        <a href="{{route('admin.create')}}" class="btn btn-sm btn-secondary my-2"
                                           style="line-height: 1.5 !important;">Add New Users</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="classList">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>User Name</th>
                                        <th>Image</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i = ($paginateData->currentpage() - 1) * $paginateData->perpage() + 1; @endphp
                                    @if(isset($paginateData))
                                        @foreach($paginateData as $k => $v)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $v->name }}</td>
                                                <td><img src="{{ asset('img/registration/'.$v->image)}}"
                                                         style="width:50px;height:50px;"></td>
                                                <td>{{ $v->email }}</td>
                                                <td>{{ $v->user_type }}</td>
                                                <!-- <td>
                                                    <a href="{{URL::to('admin/edit/'.$v->id)}}"
                                                       class="btn btn-sm btn-warning my-2" title="Edit">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                </td> -->
                  <td>
    <a href="{{URL::to('admin/edit/'.$v->id)}}"
       class="btn btn-sm btn-warning my-2" title="Edit">
        <i class="fas fa-edit" aria-hidden="true"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger my-2" 
            onclick="deleteConfirm({{$v->id}})" title="Delete">
        <i class="fas fa-trash" aria-hidden="true"></i>
    </button>
</td>


                                            </tr>
                                        @endforeach
                                    @else
                                        <h1>No Data Found!</h1>
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

function deleteConfirm(id) {
    var token = $("meta[name='csrf-token']").attr("content");
    if (confirm("Are you sure to delete this user?")) {
        $.ajax({
            url: "/admin/delete/" + id,
            type: 'get',
            success: function (response) {
                console.log("Response:", response);
                if (response.status == 1) {
                    window.location.reload();
                } else {
                    alert('Failed to delete user: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error("Error details:", xhr.responseText);
                alert('Error: ' + error);
            }
        });
    }
}




    </script>
@endpush
