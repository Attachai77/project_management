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

            <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">แก้ไขข้อมูลโครงการ</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('projects.update',$project->id) }}">

                    @csrf
                    {{ method_field('PATCH') }}

                    @php 
                        $types = \App\Helpers\GetBy::getArrayIdMasterProject('type',$project->id); 
                        $university_consistencies = \App\Helpers\GetBy::getArrayIdMasterProject('university_consistencies',$project->id); 
                        $faculty_consistencies = \App\Helpers\GetBy::getArrayIdMasterProject('faculty_consistencies',$project->id); 
                        $student_consistencies = \App\Helpers\GetBy::getArrayIdMasterProject('student_consistencies',$project->id); 
                    @endphp
                    
                    <div class="card-body">
                        <div class="text-right">
                            <a href="{{route('tasks.create',$project->id)}}" class="btn-sm btn btn-success"><i class="fas fa-tasks"></i> กำหนดกิจกรรม</a>
                        </div><br>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ประเภทโครงการ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach(\App\Helpers\ListData::getProjectTypeList() as $id => $name)
                                <label class="form-check-label col-6">
                                    <input type="checkbox" @php echo in_array($id, $types) ? 'checked' : ''; @endphp class="form-check-input" name="type[]" value="{{$id}}">{{$name}}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องของโครงการกับยุทธศาสตร์ของมหาวิทยาลัย :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach(\App\Helpers\ListData::getProjectUniversity() as $id => $name)
                                <label class="form-check-label col-6">
                                    <input type="checkbox" @php echo in_array($id, $university_consistencies) ? 'checked' : ''; @endphp class="form-check-input" name="university_consistencies[]" value="{{$id}}">{{$name}}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องของโครงการกับยุทธศาสตร์ของคณะ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach(\App\Helpers\ListData::getProjectFaculty() as $id => $name)
                                <label class="form-check-label col-6">
                                    <input type="checkbox" @php echo in_array($id, $faculty_consistencies) ? 'checked' : ''; @endphp class="form-check-input"  name="faculty_consistencies[]" value="{{$id}}">{{$name}}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องกับการส่งเสริมคุณลักษณะบัณฑิตตามมาตรฐานผลการเรียนรู้ตามกรอบมาตรฐานคุณวุติแห่งชาติ ประการ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach(\App\Helpers\ListData::getProjectStudent() as $id => $name)
                                <label class="form-check-label col-6">
                                    <input type="checkbox" @php echo in_array($id, $student_consistencies) ? 'checked' : ''; @endphp class="form-check-input" name="student_consistencies[]" value="{{$id}}">{{$name}}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">ชื่อโครงการ :</label>
                            <div class="col-sm-6">
                                <input value="{{$project->project_name}}" type="text" class="form-control" required  name="project_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">ที่ปรึกษาโครงการ :</label>
                            <div class="col-sm-6">
                                <select name="adviser_id" id="" class="form-control">
                                    @foreach($proviser_list as $proviser)
                                    <option value="{{$proviser->id}}" <?php echo $proviser->id == $project->adviser_id? "selected" : ""; ?> > 
                                        {{ $proviser->first_name .' '. $proviser->last_name }} 
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">เจ้าของโครงการ :</label>
                            <div class="col-sm-6">
                                <select name="project_owner_id" id="" class="form-control">
                                    @foreach(\App\Helpers\ListData::getOfficerNameList() as $user_id => $officer)
                                    <option value="{{$user_id}}" <?php echo $user_id == $project->project_owner_id? "selected" : ""; ?> > 
                                        {{ $officer }} 
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 control-label">วันที่เริ่ม :</label>
                            <div class="col-sm-6">
                                <input value="{{ date('d/m/Y', strtotime($project->start_date)) }}" type="text" readonly id="start_date" class="form-control" name="start_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 control-label">วันที่สิ้นสุด :</label>
                            <div class="col-sm-6">
                                <input value="{{ date('d/m/Y', strtotime($project->end_date)) }}" type="text" readonly id="end_date" class="form-control" name="end_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">งบประมาณ :</label>
                            <div class="col-sm-6">
                                <input value="{{$project->budget}}" type="text" class="form-control" placeholder="งบประมาณ" name="budget">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">สถานที่จัดโครงการ :</label>
                            <div class="col-sm-6">
                                <input value="{{$project->location}}" type="text" class="form-control" placeholder="สถานที่จัดโครงการ" name="location">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">วัตถุประสงค์ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="purposes[]">
                                @if($project->project_purposes != null)
                                    @foreach($project->project_purposes as $project_purpose)
                                        <input value="{{$project_purpose->purpose_name}}" style="width:90%; display: inline;" type="text" class="form-control" name="purposes[]">
                                        <button type="button" class="btn btn-danger btn-sm deletePrevInput"><i class="fas fa-minus-circle"></i></button>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('purposes[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">ประโยชน์ที่คาดว่าจะได้รับ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="expecteds[]">
                                @if($project->project_expecteds != null)
                                    @foreach($project->project_expecteds as $project_expected)
                                        <input value="{{$project_expected->expected_name}}" style="width:90%; display: inline;" type="text" class="form-control" name="expecteds[]">
                                        <button type="button" class="btn btn-danger btn-sm deletePrevInput"><i class="fas fa-minus-circle"></i></button>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('expecteds[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">รายละเอียดอื่น ๆ :</label>
                            <div class="col-sm-6">
                                <textarea rows="5" class="form-control"  name="project_description">{{$project->project_description}}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                        <label class="col-sm-3 control-label">ไฟล์แนบ หรือเอกสารที่เกี่ยวข้อง :</label>
                        <div class="col-sm-6">
                            <div class="table-responsive table-hover">
                                <table class="table m-0">
                                    <tbody>
                                    @foreach($project->project_files as $file)
                                    <tr>
                                        <td><li>{{$file->original_name}}</li></td> 
                                        <td><a href="{{ route('projects.deleteFile',$file->id) }}" 
                                        data-msg="ต้องการลบไฟล์แนบนี้ใช่หรือไม่" 
                                        class="badge badge-danger float-right confirmLink" title="ลบ" data-toggle="tooltip" 
                                        data-placement="top">ลบ</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>

                        <div class="form-group row multiFile" >
                            <div class="col-sm-6 offset-3 mb-2"> 
                                <input type="file" class="custom-file-input" id="customFile1" name="files[]">
                                <label class="custom-file-label" for="customFile1">เพิ่มไฟล์แนบ</label>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-info btn-sm" id="addFile"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-3">
                                <a href="/" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับหน้าแรก</a>
                            </div>
                            <div class="col-9 text-right">
                                <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> บันทึก</button>
                            </div>
                        </div>
                        
                    </div>
                    <!-- /.card-footer -->

                </form>
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
    let el = `<div class="col-sm-6 offset-3 mb-2"> 
                <input type="file" class="custom-file-input" id="customFile${i}" name="files[]">
                <label class="custom-file-label" for="customFile1${i}">เพิ่มไฟล์แนบ</label>
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
    iconsLibrary: 'fontawesome'
});

function addItem(item){
    $("input[name='"+item+"']:first").clone().appendTo($("input[name='"+item+"']").parent()).show();
}

$(".deletePrevInput").on('click',function(){
    $(this).prev().remove();
    $(this).remove();
});
</script>

@endsection