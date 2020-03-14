@extends('layouts.adminlte')

@section('content')

<style>
.control-label{
    font-weight: 100 !important;
}
textarea{
    margin-bottom:10px;
}
</style>

<div class="col-12">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">#สรุปผล</h3>
                </div>
                <div class="card-body">

                    <div class="ml-5">
                        <h5>ชื่อโครงการ :
                            <span>{{ $project->project_name }}</span>
                        </h5>
                    </div>

                    <br>
                    <br>

                    <form action="{{ route('summaryResult',$project->id) }}" method="post">
                        @csrf

                        <div class="row col-12">
                            <p><b class="ml-5">1. ข้อมูลพื้นฐานของผู้ตอบ</b></p>

                            <div class="col-11 offset-1">
                                <p>1.1 เพศ</p>
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">ชาย :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="male" class="form-control" required>
                                </div>
                                คน
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">หญิง :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="female" class="form-control" required>
                                </div>
                                คน
                            </div>

                            <!-- ********************************************************* -->
                            <div class="col-11 offset-1">
                                <p>1.2 ชั้นปี</p>
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">1 :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="level_1" class="form-control" required>
                                </div>
                                คน
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">2 :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="level_2" class="form-control" required>
                                </div>
                                คน
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">3 :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="level_3" class="form-control" required>
                                </div>
                                คน
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">4 :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="level_4" class="form-control">
                                </div>
                                คน
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">อื่น ๆ :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="level_other" class="form-control">
                                </div>
                                คน
                            </div>
                            <!-- ############################################################ -->

                            <div class="col-11 offset-1">
                                <p>1.3 สาขาวิชา</p>
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">วิทยาการคอมพิวเตอร์ :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="cs_count" class="form-control">
                                </div>
                                คน
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">เทคโนโลยีสาระสนเทศ :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="it_count" class="form-control">
                                </div>
                                คน
                            </div>
                            <div class="form-group row col-12">
                                <label class="col-sm-2 control-label">คณิตศาสตร์ :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="mt_count" class="form-control">
                                </div>
                                คน
                            </div>

                            <!-- ############################################################ -->


                        </div>

                        <hr/>


                        <div class="row col-12">
                            <p><b class="ml-5">2. ระดับความคิดเห็นต่อการจัดโครงการ/กิจกรรม (เฉลี่ย)</b></p>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">การประชาสัมพันธ์กิจกรรมโครงการให้ทราบ ก่อนการเริ่มกิจกรรม :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_1" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">ความพอใจของท่านต่อผู้ดำเนินงาน ของผู้จัดโครงการ :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_2" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">ความพอใจของท่านต่อวิทยากรที่จัดโครงการ :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_3" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">ความพร้อมของวัสดุ อุปกรณ์ ในการจัดกิจกรรม :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_4" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">ความพร้อมของสถานที่ ในการจัดกิจกรรม :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_5" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">ความเหมาะสมของระยะเวลา ในการจัดกิจกรรม :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_6" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">ความสำเร็จ/ประโยชน์ที่ได้รับจากกิจกรรมที่เกิดขึ้น :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_7" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">ความรับผิดชอบของผู้จัดต่อการดำเนินกิจกรรม :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_8" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">การตอบข้อซักถาม ในการดำเนอนกิจกรรม :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_9" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                            <div class="form-group row col-12">
                                <label class="col-sm-6 control-label">ความต้องการให้มีกิจกรรมนี้อีกในอนาคต :</label>
                                <div class="col-sm-4" >
                                    <input type="text" name="r_10" class="form-control">
                                </div>
                                (โดยเฉลี่ย)
                            </div>

                        </div>

                        <hr />

                        <div class="row col-12">
                            <p><b class="ml-5">3. ข้อเสนอแนะ</b></p>
                            <div class="form-group row col-12">
                                <div class="col-sm-10 offset-1">
                                    <textarea  name="comment[]" class="form-control" cols="30" rows="2"></textarea>
                                </div>
                                <div class="col-1">
                                    <button type="button" onClick="addComment('comment[]')" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <br>
                        <br>
                        <button type="submit" class="btn btn-info float-right">บันทึกผลสรุปโครงการ และขอปิดโครงการ</button>

                    </form>

                </div>

                <div class="card-footer">
                    <a href="javascript:history.back()"  class="btn btn-default"><i class="fa fa-angle-left"></i> กลับ</a>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
function addComment(item){
    $("textarea[name='"+item+"']:first").clone().appendTo($("textarea[name='"+item+"']").parent()).show();
}

$(document).ready(function () {
  $("input").keypress(function (event) {
    if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        toastr.error('กรุณากรอกข้อมูลเป็นจำนวนตัวเลข')
        return false
    }
   });
});
</script>




@endsection