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
                <h3 class="card-title">กรอกข้อมูลโครงการ</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('projects.store') }}"  enctype="multipart/form-data">

                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ประเภทโครงการ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach(\App\Helpers\ListData::getProjectTypeList() as $id => $name)
                                <label class="form-check-label col-6">
                                    <input type="checkbox" class="form-check-input" name="type[]" value="{{$id}}">{{$name}}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องของโครงการกับยุทธศาสตร์ของมหาวิทยาลัย :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach(\App\Helpers\ListData::getProjectUniversity() as $id => $name)
                                <label class="form-check-label col-6">
                                    <input type="checkbox" class="form-check-input" name="university_consistencies[]" value="{{$id}}">{{$name}}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องของโครงการกับยุทธศาสตร์ของคณะ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach(\App\Helpers\ListData::getProjectFaculty() as $id => $name)
                                <label class="form-check-label col-6">
                                    <input type="checkbox" class="form-check-input"  name="faculty_consistencies[]" value="{{$id}}">{{$name}}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องกับการส่งเสริมคุณลักษณะบัณฑิตตามมาตรฐานผลการเรียนรู้ตามกรอบมาตรฐานคุณวุติแห่งชาติ ประการ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach(\App\Helpers\ListData::getProjectStudent() as $id => $name)
                                <label class="form-check-label col-6">
                                    <input type="checkbox" class="form-check-input" name="student_consistencies[]" value="{{$id}}">{{$name}}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">ชื่อโครงการ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" required placeholder="ชื่อโครงการ" name="project_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">ที่ปรึกษาโครงการ :</label>
                            <div class="col-sm-6">
                                <select name="adviser_id" id="" class="form-control">
                                    @foreach($proviser_list as $proviser)
                                    <option value="{{$proviser->id}}"> {{ $proviser->first_name .' '. $proviser->last_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 control-label">วันที่เริ่ม :</label>
                            <div class="col-sm-6">
                                <input type="text" readonly id="start_date" class="form-control" name="start_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-3 control-label">วันที่สิ้นสุด :</label>
                            <div class="col-sm-6">
                                <input type="text" readonly id="end_date" class="form-control" name="end_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">งบประมาณ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="งบประมาณ" name="budget">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">สถานที่จัดโครงการ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="สถานที่จัดโครงการ" name="location">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">วัตถุประสงค์ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="วัตถุประสงค์" name="purposes[]">
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('purposes[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">ประโยชน์ที่คาดว่าจะได้รับ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="ประโยชน์ที่คาดว่าจะได้รับ" name="expecteds[]">
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('expecteds[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">ผู้สนับสนุน :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="ผู้สนับสนุน" name="supports[]">
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('supports[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 control-label">รายละเอียดอื่น ๆ :</label>
                            <div class="col-sm-6">
                                <textarea rows="5" class="form-control"  name="project_description"></textarea>
                            </div>
                        </div>


                        <div class="form-group row multiFile" >
                            <div class="col-sm-6 offset-3 mb-2"> 
                                <input type="file" class="custom-file-input" id="customFile1" name="files[]">
                                <label class="custom-file-label" for="customFile1">เลือกไฟล์แนบ</label>
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-info btn-sm" id="addFile"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="/" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับหน้าแรก</a>
                        <button type="submit" class="btn btn-warning float-right"><i class="fa fa-save"></i> บันทึก</button>
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
        alert('กรุณาแนบไฟล์ขนาดไม่เกิน 15MB.');
    }else{
        var ext = $(this).val().split('.').pop().toLowerCase();
        var validExtensions = ["jpg","pdf","jpeg","gif","png","doc","docx","xls","xlsx","ppt","pptx"];
        if($.inArray(ext, validExtensions) == -1) {
            alert('ประเภทไฟล์แนบไม่ถูกต้อง! , กรุณาแนบไฟล์ที่มีนามสกุล "jpg","pdf","jpeg","gif","png","doc","docx","xls","xlsx","ppt","pptx" ');
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
    iconsLibrary: 'fontawesome'
});

function addItem(item){
    $("input[name='"+item+"']:first").clone().appendTo($("input[name='"+item+"']").parent()).show();
}
</script>


@endsection