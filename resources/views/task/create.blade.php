@extends('layouts.adminlte')

@section('content')

<script src="/js/gijgo.min.js" type="text/javascript"></script>
<link href="/css/gijgo.min.css" rel="stylesheet" type="text/css" />

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-12">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">กรอกข้อมูลกิจกรรม</h3>
                </div>
                <form method="POST" action="{{ route('tasks.store') }}" class="form-horizontal">
                    @csrf
                    <div class="card-body">

                        <input type="hidden" value="{{$project->id}}" name="project_id">

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">โครงการ :</label>
                            <div class="col-sm-8">
                                {{ $project->project_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อกิจกรรม :</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('task_name') }}" required name="task_name" class="form-control" placeholder="ชื่อกิจกรรม">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">วัน-เวลา เริ่มต้น :</label>
                            <div class="col-sm-4">
                                <input type="text" readonly id="start_date" value="{{ old('start_date') }}" name="start_date" class="form-control" >
                            </div>
                            <label class="col-sm-2 control-label">วัน-เวลา สิ้นสุด :</label>
                            <div class="col-sm-4">
                                <input type="text" readonly id="end_date" value="{{ old('end_date') }}" name="end_date" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">รายละเอียดกิจกรรม :</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" value="{{ old('description') }}" name="description" cols="30" rows="5"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="javascript:history.back();" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับ</a>
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> บันทึก</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </div>
</div>

<script>
$('#start_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'dd/mm/yyyy',
    iconsLibrary: 'fontawesome'
});

$('#end_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'dd/mm/yyyy',
    iconsLibrary: 'fontawesome',
    minDate: function () {
        return $('#start_date').val();
    }
});

$('#reservation').datetimepicker()
</script>

@endsection