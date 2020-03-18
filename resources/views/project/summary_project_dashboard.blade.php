@extends('layouts.adminlte')

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 style="font-weight:bold;">ชื่อโครงการ : {{$project->project_name}}</h5>
            </div>
        </div>
        </div>
    </div>

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
                    {{ $summary->male }} คน
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
                    {{ $summary->female }} คน
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

                    <?php 
                        $all_level = $summary->level_1 +  $summary->level_2 + $summary->level_3 + $summary->level_4 + $summary->level_other;
                        function percentLevel($level_num, $all_level){
                            if ($all_level == 0); return 0;
                            return $level_num * 100 / $all_level;
                        }
                    ?>


                    <div class="progress-group">
                      ปี 4
                      <span class="float-right"><b>{{ $summary->level_4 }}</b> คน</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: {{percentLevel($summary->level_4, $all_level)}}%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      ปี 3
                      <span class="float-right"><b>{{ $summary->level_3 }}</b> คน</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: {{percentLevel($summary->level_3, $all_level)}}%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">ปี 2</span>
                      <span class="float-right"><b>{{ $summary->level_2 }}</b> คน</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: {{percentLevel($summary->level_2, $all_level)}}%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      ปี 1
                      <span class="float-right"><b>{{ $summary->level_1 }}</b> คน</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: {{percentLevel($summary->level_1, $all_level)}}%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                  <!-- /.progress-group -->
                  <div class="progress-group">
                      อื่น ๆ
                      <span class="float-right"><b>{{ $summary->level_other }}</b> คน</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" style="width: {{percentLevel($summary->level_other, $all_level)}}%"></div>
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
                            <span class="info-box-number">{{$summary->cs_count}} คน</span>
                        </div>
                    </div>

                    <div class="info-box mb-3 bg-success" style="padding:0px; min-height:50px;">
                        <span class="info-box-icon"><i class="fas fa-network-wired"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">เทคโนโลยีสาระสนเทศ</span>
                            <span class="info-box-number">{{ $summary->it_count? $summary->it_count : 0 }} คน</span>
                        </div>
                    </div>

                    <div class="info-box mb-3 bg-danger" style="padding:0px; min-height:50px;">
                        <span class="info-box-icon"><i class="fas fa-square-root-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">คณิตศาสตร์</span>
                            <span class="info-box-number">{{ $summary->math_count? $summary->math_count : 0  }} คน</span>
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
                        <td>{{ number_format($summary->r_1, 2) }}</td>
                    </tr>
                    <tr>
                        <td>2. </td>
                        <td>ความพอใจของท่านต่อผู้ดำเนินงาน ของผู้จัดโครงการ</td>
                        <td>{{ number_format($summary->r_2, 2) }}</td>
                    </tr>
                    <tr>
                        <td>3. </td>
                        <td>ความพอใจของท่านต่อวิทยากรที่จัดโครงการ</td>
                        <td>{{ number_format($summary->r_3, 2) }}</td>
                    </tr>
                    <tr>
                        <td>4. </td>
                        <td>ความพร้อมของวัสดุ อุปกรณ์ ในการจัดกิจกรรม </td>
                        <td>{{ number_format($summary->r_4, 2) }}</td>
                    </tr>
                    <tr>
                        <td>5. </td>
                        <td>ความพร้อมของสถานที่ ในการจัดกิจกรรม</td>
                        <td>{{ number_format($summary->r_5, 2) }}</td>
                    </tr>
                    <tr>
                        <td>6. </td>
                        <td>ความเหมาะสมของระยะเวลา ในการจัดกิจกรรม</td>
                        <td>{{ number_format($summary->r_6, 2) }}</td>
                    </tr>
                    <tr>
                        <td>7. </td>
                        <td>ความสำเร็จ/ประโยชน์ที่ได้รับจากกิจกรรมที่เกิดขึ้น</td>
                        <td>{{ number_format($summary->r_7, 2) }}</td>
                    </tr>
                    <tr>
                        <td>8. </td>
                        <td>ความรับผิดชอบของผู้จัดต่อการดำเนินกิจกรรม</td>
                        <td>{{ number_format($summary->r_8, 2) }}</td>
                    </tr>
                    <tr>
                        <td>9. </td>
                        <td>การตอบข้อซักถาม ในการดำเนอนกิจกรรม</td>
                        <td>{{ number_format($summary->r_9, 2) }}</td>
                    </tr>
                    <tr>
                        <td>10. </td>
                        <td>ความต้องการให้มีกิจกรรมนี้อีกในอนาคต</td>
                        <td>{{ number_format($summary->r_10, 2) }}</td>
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

                @foreach($summary_comments as $comment)
                <div class="info-box mb-3" style="padding:0px; min-height:50px; background: #ddd;">
                    <span class="info-box-icon"><i class="fas fa-comment"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ $comment->comment }}</span>
                    </div>
                </div>
                @endforeach

              </div>
            </div>
        </div>
    </div>

    <div class="row pb-5">
        <div class="col-12">
            <a href="javascript:history.back()"  class="btn btn-default"><i class="fa fa-angle-left"></i> กลับ</a>
            
            @if($project->status === 7 && $project->adviser_id === Auth::user()->id)
            <a href="{{route('doneProject',$project->id)}}" class="btn btn-success float-right confirmLink"
            data-msg="ต้องการปิดโครงการใช่หรือไม่">
                <i class="fas fa-check"></i> ปิดโครงการ
            </a> 
            @endif

        </div>
    </div>

</div>


@endsection
