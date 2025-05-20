@extends('layouts.app')
@section('mainContent')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content-wrapper">
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h2 class="h2 font-weight-bold">Add Merit Points</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('employee-merit-points-post') }}" method="POST" class="row" enctype="multipart/form-data" >@csrf
                        <!-- Employee ID -->
                        <div class="col-12 col-md-4 form-group">
                            <label for="employee" class="form-label">Employee*</label>
                            <select class="form-control" id="employee" name="employee_id" required>
                                <option value="">Select Employee</option>
                                @foreach($lists as $item)
                                    <option value="{{ $item->id }}">{{ $item->emp_id .' - ' . $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Merit Points -->
                        <div class="col-12 col-md-4 form-group">
                            <label for="merit_points" class="form-label">Merit Points*</label>
                            <input type="number" class="form-control" required name="points" id="merit_points" placeholder="Enter Merit Points">
                        </div>
                        <div class="col-12 col-md-4 form-group">
                            <label for="reason" class="form-label">Reason*</label>
                            <input type="text" class="form-control" required name="reason" id="reason" placeholder="Enter Reason">
                        </div>

                        <!-- Remark -->
                        <div class="col-12  form-group">
                            <label for="remark" class="form-label">Remark*</label>
                            <textarea class="form-control" id="remark" required name="history" placeholder="Enter Remark"></textarea>
                        </div>

                        <!-- File Upload -->
                        <div class="col-12 col-md-4 form-group">
                            <label for="file" class="form-label">Upload File(optional)</label>
                            <input type="file" class="form-control" name="document" id="file">
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary">Add Merit Points</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection
@push('custom_js')
    <script>
        $(document).ready(function() {
            $('#employee').select2();
        });
    </script>
@endpush

