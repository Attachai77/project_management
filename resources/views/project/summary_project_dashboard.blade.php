@extends('layouts.adminlte')

@section('content')

<div class="container-fluid">

    <h5 class="mb-2">เพศ</h5>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning   elevation-1">
                    <i class="fas fa-male"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">ชาย</span>
                    <span class="info-box-number" style="font-size:24px;">
                    11 คน
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info   elevation-1">
                    <i class="fas fa-female"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">หญิง</span>
                    <span class="info-box-number" style="font-size:24px;">
                    12 คน
                    </span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <h5 class="mb-2 mt-4">ชั้นปี</h5>
            <div class="card">
                <div class="card-body">
                <div class="col-md-12">
                    <p class="text-center">
                      <strong>แบ่งตามชั้นปี</strong>
                    </p>

                    <div class="progress-group">
                      ปี 4
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      ปี 3
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">ปี 2</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      ปี 1
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                  <!-- /.progress-group -->
                  <div class="progress-group">
                      อื่น ๆ
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: 50%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                  </div>
                </div>
            </div>
        </div>

    
        <div class="col-md-6 col-sm-12">
            <h5 class="mb-2 mt-4">สาขาวิชา</h5>
            <div class="card">
                <div class="card-body pb-1">
                    <p class="text-center">
                      <strong>แบ่งตามสาขาวิชา</strong>
                    </p>

                    <div class="info-box mb-3 bg-warning" style="padding:0px; min-height:50px;">
                        <span class="info-box-icon"><i class="fas fa-laptop-code"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">วิทยาการคอมพิวเตอร์</span>
                            <span class="info-box-number">5,200</span>
                        </div>
                    </div>

                    <div class="info-box mb-3 bg-success" style="padding:0px; min-height:50px;">
                        <span class="info-box-icon"><i class="fas fa-network-wired"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">เทคโนโลยีสาระสนเทศ</span>
                            <span class="info-box-number">92,050</span>
                        </div>
                    </div>

                    <div class="info-box mb-3 bg-danger" style="padding:0px; min-height:50px;">
                        <span class="info-box-icon"><i class="fas fa-square-root-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">คณิตศาสตร์</span>
                            <span class="info-box-number">114,381</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <h5 class="mb-2 mt-4">ระดับความคิดเห็นต่อการจัดโครงการ/กิจกรรม</h5>
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>หัวข้อ</th>
                    <th>ค่าเฉลี่ย</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>1. </td>
                        <td>การประชาสัมพันธ์กิจกรรมโครงการให้ทราบ ก่อนการเริ่มกิจกรรม</td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>2. </td>
                        <td>ความพอใจของท่านต่อผู้ดำเนินงาน ของผู้จัดโครงการ</td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>3. </td>
                        <td>ความพอใจของท่านต่อวิทยากรที่จัดโครงการ</td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>4. </td>
                        <td>ความพร้อมของวัสดุ อุปกรณ์ ในการจัดกิจกรรม </td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>5. </td>
                        <td>ความพร้อมของสถานที่ ในการจัดกิจกรรม</td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>6. </td>
                        <td>ความเหมาะสมของระยะเวลา ในการจัดกิจกรรม</td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>7. </td>
                        <td>ความสำเร็จ/ประโยชน์ที่ได้รับจากกิจกรรมที่เกิดขึ้น</td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>8. </td>
                        <td>ความรับผิดชอบของผู้จัดต่อการดำเนินกิจกรรม</td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>9. </td>
                        <td>การตอบข้อซักถาม ในการดำเนอนกิจกรรม</td>
                        <td>0.4</td>
                    </tr>
                    <tr>
                        <td>10. </td>
                        <td>ความต้องการให้มีกิจกรรมนี้อีกในอนาคต</td>
                        <td>0.4</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>

    <h5 class="mb-2 mt-4">ข้อเสนอแนะ</h5>
    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-body p-3">

                <div class="info-box mb-3" style="padding:0px; min-height:50px; background: #ddd;">
                    <span class="info-box-icon"><i class="fas fa-comment"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">coment.....</span>
                    </div>
                </div>


              </div>
            </div>
        </div>
    </div>

</div>


@endsection
