@extends('layouts.adminlte')

@section('content')

<style>
.file-img{
    width:45px; 
    margin-left:10px;
    height:45px;
}
.pj-member{
    padding:10px;
}
</style>

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
                <form method="POST" action="{{ route('tasks.update',$task->id) }}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">โครงการ :</label>
                            <div class="col-sm-8">
                                {{ $project->project_name }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อกิจกรรม :</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $task->task_name }}" required name="task_name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">เจ้าของกิจกรรม :</label>
                            <div class="col-sm-6">
                                <select name="task_owner_id" class="form-control">
                                @foreach($project_members as $project_member_id)
                                    @if($project_member_id === $task->task_owner_id )
                                        @php $hasOwner = "selected" @endphp
                                    @else
                                        @php $hasOwner = "" @endphp
                                    @endif
                                <option {{$hasOwner}} value="{{$project_member_id}}">{{ \App\User::getFullnameById($project_member_id) }} </option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">วัน-เวลา เริ่มต้น :</label>
                            <div class="col-sm-4">
                                <input type="text" readonly id="start_date" value="{{ date('d/m/Y', strtotime($task->start_date)) }}" name="start_date" class="form-control" >
                            </div>
                            <label class="col-sm-2 control-label">วัน-เวลา สิ้นสุด :</label>
                            <div class="col-sm-4">
                                <input type="text" readonly id="end_date" value="{{ date('d/m/Y', strtotime($task->end_date)) }}" name="end_date" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">รายละเอียดกิจกรรม :</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" cols="30" rows="5">
                                    {{ $task->description }}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row multiFile" >
                            <div class="col-sm-6 offset-2 mb-2"> 
                                <input type="file" class="custom-file-input" id="customFile1" name="files[]">
                                <label class="custom-file-label" for="customFile1">เลือกไฟล์แนบ</label>
                                <span style="color:#bbb; font-size:12px;">#อัปโหลดเอกสารที่เกี่ยวข้องกับกิจกรรม โดยสามารถอัปโหลดเฉพาะไฟล์ที่มีนามสกลุล "jpg", "pdf", "jpeg", "gif", "png", "doc", "docx", "xls", "xlsx", "ppt", "pptx" เท่านั้น </span>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-info btn-sm" id="addFile"><i class="fa fa-plus"></i></button>
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

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title"><i class="fas fa-paperclip"></i> ไฟล์แนบ หรือเอกสารที่เกี่ยวข้อง</h5>
        </div>
        <div class="card-body">
            <div class="direct-file-messages">
                @foreach($task->task_files as $file)
                @php $file_icon = \App\Helpers\GetBy::getFileIconByExt($file->ext, $file->path); @endphp
                <div class="row pj-member">
                    <div class="col-3">
                        <img src="/{{$file_icon}}" class="file-img">
                    </div>
                    <div class="col-9">
                        <h6 class="member-name">{{ $file->original_name }}</h6>
                        <a href="/{{ $file->path }}" download="{{ $file->original_name }}" class="badge badge-success right">ดาวน์โหลด</a>
                        <a href="{{ route('tasks.deleteFile',$file->id) }}" 
                        class="badge badge-danger right">ลบ</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('change','.custom-file-input',function(){
    if(this.files[0].size > 15000000){
        sweetAlertError(undefined, 'กรุณาแนบไฟล์ขนาดไม่เกิน 15MB.', 'ปิด');
    }else{
        var ext = $(this).val().split('.').pop().toLowerCase();
        var validExtensions = ["jpg","pdf","jpeg","gif","png","doc","docx","xls","xlsx","ppt","pptx"];
        if($.inArray(ext, validExtensions) == -1) {
            sweetAlertError(undefined, 'ประเภทไฟล์แนบไม่ถูกต้อง! , กรุณาแนบไฟล์ที่มีนามสกุล "jpg","pdf","jpeg","gif","png","doc","docx","xls","xlsx","ppt","pptx" ', 'ปิด');
        }else{
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        }
    }

});

var i = 1;
$('#addFile').click(function(){
    ++i;
    let el = `<div class="col-sm-6 offset-2 mb-2"> 
                <input type="file" class="custom-file-input" id="customFile${i}" name="files[]">
                <label class="custom-file-label" for="customFile1${i}">เลือกไฟล์แนบ</label>
            </div>`;
    $('.multiFile').append(el);
});
</script>

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