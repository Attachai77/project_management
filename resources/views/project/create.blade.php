@extends('layouts.adminlte')

@section('content')

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="col-12">
    <div class="row">
        <div class="col-12">

            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">กรอกข้อมูลโครงการ</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('projects.store') }}">

                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">ชื่อโครงการ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" required placeholder="ชื่อโครงการ" name="project_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">ที่ปรึกษาโครงการ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="ที่ปรึกษาโครงการ" name="adviser">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 control-label">วันที่เริ่ม :</label>
                            <div class="col-sm-6">
                                <input type="text" readonly id="start_date" class="form-control" name="start_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 control-label">วันที่สิ้นสุด :</label>
                            <div class="col-sm-6">
                                <input type="text" readonly id="end_date" class="form-control" name="end_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">งบประมาณ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="งบประมาณ" name="budget">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">สถานที่จัดโครงการ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="สถานที่จัดโครงการ" name="location">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">วัตถุประสงค์ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="วัตถุประสงค์" name="purposes[]">
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('purposes[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">ผลที่คาดว่าจะได้รับ :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="ผลที่คาดว่าจะได้รับ" name="expecteds[]">
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('expecteds[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 control-label">ผู้สนับสนุน :</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" placeholder="ผู้สนับสนุน" name="supports[]">
                            </div>
                            <div class="col-1">
                                <button type="button" onClick="addItem('supports[]')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-warning">บันทึก</button>
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
    format: 'dd/mm/yyyy'
});

$('#end_date').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'dd/mm/yyyy'
});

function addItem(item){
    $("input[name='"+item+"']:first").clone().appendTo($("input[name='"+item+"']").parent()).show();
}
</script>

@endsection