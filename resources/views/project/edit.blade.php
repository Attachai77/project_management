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
                <form class="form-horizontal" method="POST" action="{{ route('projects.update',$project->id) }}">

                    @csrf
                    {{ method_field('PATCH') }}
                    
                    <div class="card-body">
                        <div class="text-right">
                            <a href="{{route('tasks.create',$project->id)}}" class="btn-sm btn btn-success"><i class="fas fa-tasks"></i> กำหนดกิจกรรม</a>
                            <a href="{{route('projects.projectMember',$project->id)}}" class="btn-sm btn btn-info"><i class="fas fa-users"></i> กำหนดสมาชิกและตำแหน่ง</a>
                        </div><br>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">ชื่อโครงการ :</label>
                            <div class="col-sm-6">
                                <input value="{{$project->project_name}}" type="text" class="form-control" required  name="project_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">ที่ปรึกษาโครงการ :</label>
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
                            <label for="inputEmail3" class="col-sm-2 control-label">เจ้าของโครงการ :</label>
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
                            <label for="inputPassword3" class="col-sm-2 control-label">วันที่เริ่ม :</label>
                            <div class="col-sm-6">
                                <input value="{{ date('d/m/Y', strtotime($project->start_date)) }}" type="text" readonly id="start_date" class="form-control" name="start_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 control-label">วันที่สิ้นสุด :</label>
                            <div class="col-sm-6">
                                <input value="{{ date('d/m/Y', strtotime($project->end_date)) }}" type="text" readonly id="end_date" class="form-control" name="end_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">งบประมาณ :</label>
                            <div class="col-sm-6">
                                <input value="{{$project->budget}}" type="text" class="form-control" placeholder="งบประมาณ" name="budget">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">สถานที่จัดโครงการ :</label>
                            <div class="col-sm-6">
                                <input value="{{$project->location}}" type="text" class="form-control" placeholder="สถานที่จัดโครงการ" name="location">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">วัตถุประสงค์ :</label>
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
                            <label for="inputEmail3" class="col-sm-2 control-label">ผลที่คาดว่าจะได้รับ :</label>
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
                            <label for="inputEmail3" class="col-sm-2 control-label">ผู้สนับสนุน :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="supports[]">
                                @if($project->project_supports != null)
                                    @foreach($project->project_supports as $project_support)
                                        <input value="{{$project_support->name}}" style="width:90%; display: inline;" type="text" class="form-control" name="supports[]">
                                        <button type="button" class="btn btn-danger btn-sm deletePrevInput"><i class="fas fa-minus-circle"></i></button>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('supports[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">รายละเอียดอื่น ๆ :</label>
                            <div class="col-sm-6">
                                <textarea rows="5" class="form-control"  name="project_description">{{$project->project_description}}</textarea>
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