@extends('layouts.adminlte')

@section('content')

<style>
    .pj-member{
        padding:10px;
    }
    .member-img{
        width:70px; 
        border-radius: 50%;
        margin-left:25px;
        height:70px;
    }
    .member-name{
        color: #a2aab1;
        font-size: .975rem;
        font-weight: bold;
        margin-bottom:3px;
    }
</style>

<div class="col-12">

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">รายละเอียดโครงการ</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">

                    @php 
                    $types = \App\Helpers\GetBy::getNameMasterProject('project_types', $project->type);
                    $university_consistencies = \App\Helpers\GetBy::getNameMasterProject('project_university_consistencies', $project->university_consistencies);
                    $faculty_consistencies = \App\Helpers\GetBy::getNameMasterProject('project_faculty_consistencies', $project->faculty_consistencies);
                    $student_consistencies = \App\Helpers\GetBy::getNameMasterProject('project_student_consistencies', $project->student_consistencies);
                    @endphp

                    <div class="form-group row">
                            <label class="col-sm-3 control-label">ประเภทโครงการ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach($types as $id => $name)
                                <label class="form-check-label col-12">{{++$id }} . {{$name}}</label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องของโครงการกับยุทธศาสตร์ของมหาวิทยาลัย :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach($university_consistencies as $id => $name)
                                <label class="form-check-label col-12">{{++$id }} . {{$name}}</label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องของโครงการกับยุทธศาสตร์ของคณะ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach($faculty_consistencies as $id => $name)
                                <label class="form-check-label col-12">{{++$id }} . {{$name}}</label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 control-label">ความสอดคล้องกับการส่งเสริมคุณลักษณะบัณฑิตตามมาตรฐานผลการเรียนรู้ตามกรอบมาตรฐานคุณวุติแห่งชาติ ประการ :</label>
                            <div class="col-sm-8 ml-3 row" >
                                @foreach($student_consistencies as $id => $name)
                                <label class="form-check-label col-12">{{++$id }} . {{$name}}</label>
                                @endforeach
                            </div>
                        </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">ชื่อโครงการ :</label>
                        <div class="col-sm-9">
                        <a href="{{ route('projects.show',$project->id) }}"><span style="color: #20c997; font-weight:bold;">{{ $project->project_name }} </span></a>
                        </div>
                    </div>

                    <?php #dd($project->adviser_id); ?>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">ที่ปรึกษาโครงการ :</label>
                        <div class="col-sm-9">{{ \App\User::getFullnameById($project->adviser_id) }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">สถานะโครงการ :</label>
                        <div class="col-sm-9">{!! \App\Helpers\GetBy::getProjectStatusBladeByStatusId($project->status) !!}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">เจ้าของโครงการ :</label>
                        <div class="col-sm-9">
                            <a href="#">{{ \App\User::getFullnameById($project->project_owner_id) }}</a>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">เพิ่มข้อมูลโดย :</label>
                        <div class="col-sm-9">
                            <a href="#">{{ \App\User::getFullnameById($project->created_uid) }}</a>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">เริ่มโครงการ :</label>
                        <div class="col-sm-9"><i class="nav-icon far fa-calendar-alt"></i> {{ $project->start_date }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">สิ้นสุดโครงการ :</label>
                        <div class="col-sm-9"><i class="nav-icon far fa-calendar-alt"></i> {{ $project->end_date }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">งบประมาณ :</label>
                        <div class="col-sm-9">{{ $project->budget }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">สถานที่จัดโครงการ :</label>
                        <div class="col-sm-9">{{ $project->location }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">รายละเอียดอื่น ๆ :</label>
                        <div class="col-sm-9">{{ $project->project_description }}</div>
                    </div>

                    @if($project->adviser_id === Auth::user()->id && $project->status === 1)
                    <hr>
                    <div class="text-center">
                        <a href="{{route('approveProject', $project->id)}}" data-msg="ตรวจสอบผ่านโครงการนี้เพื่อดำเนินโครงการต่อไปใช่หรือไม่" class="btn btn-success btn-sm confirmLink"><i class="fas fa-check"></i>
                            ตรวจสอบ / ดำเนินโครงการต่อไป
                        </a>
                        <a href="{{route('rejectProject', $project->id )}}" data-msg="ต้องการส่งกลับโครงการนี้เพื่อแก้ไขใช่หรือไม่" class="btn btn-warning btn-sm reject"><i class="fas fa-edit"></i>
                            ส่งกลับ / แก้ไข
                        </a>
                        <a href="{{route('cancelProject', $project->id )}}"  data-msg="ต้องการยกเลิกโครงการนี้ใช่หรือไม่" class="btn btn-danger btn-sm confirmLink"><i class="fas fa-times"></i>
                            ไม่ผ่าน / ยกเลิก
                        </a>
                    </div>
                    @endif

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="javascript:history.back()"  class="btn btn-default"><i class="fa fa-angle-left"></i> กลับ</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user"></i> เจ้าของโครงการ</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">

                <div class="direct-chat-messages">
                    
                    @foreach($project->members as $member)
                    @php $user = \App\User::find($member->user_id) @endphp
                        @if($user !== null)
                        <div class="row pj-member">
                            <div class="col-4">
                                @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId($member->user_id) @endphp
                                <img src="{{$img_url}}" class="member-img" alt="User Image">
                            </div>
                            <div class="col-8">
                                <h6 class="member-name">{{ $user->first_name.' '.$user->last_name }}</h6>
                                <h6 style="font-size:12px; margin-bottom:3px;">
                                    <b style="color:#888;">ตำแหน่ง: </b>
                                    <span class="badge badge-info">
                                        {{ \App\Helpers\GetBy::getProjectPositionNameById($member->position_id) }}
                                    </span>
                                </h6>
                                <h6 style="font-size:12px; margin-bottom:3px;">
                                    <b style="color:#888;">เข้าร่วมเมื่อ: </b>
                                    {{ $member->created_at }}
                                </h6>
                            </div>
                        </div>
                        @endif
                    @endforeach

                </div>
                </div>

                <!-- <div class="card-footer">
                    <div class="text-right">
                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-info"></i> ดูเพิ่มเติม</a>
                    </div>
                </div> -->

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">กิจกรรมทั้งหมด ของโครงการนี้</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>กิจกรรม</th>
                                <th>เจ้าของ/ผู้รับผิดชอบ</th>
                                <th>ความคืบหน้า</th>
                                <th>สถานะ</th>
                                <!-- <th width="14%"></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $k => $task)
                            @php $task_status = \App\Helpers\Check::taskStatus($task->id) @endphp
                            <tr class="pointer" >
                                <td>{{ ++$k }}</td>
                                <td>{{ $task->task_name }}</td>
                                <td>{{ \App\User::getFullnameById($task->task_owner_id) }}</td>
                                <td>
                                    <div class="progress progress-xs" style="margin-top: 10px;">
                                        <div class="progress-bar bg-{{$task_status['badge'] }}" style="width: {{$task_status['percent'] }}%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-{{$task_status['badge']}}">{{ $task_status['status_th'] }}</span></td>
                                <!-- <td>
                                    @if($project->project_owner_id === Auth::user()->id  || $task->task_owner_id === Auth::user()->id)
                                    <a href="{{ route('tasks.edit',$task->id) }}" title="แก้ไข" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('tasks.delete',$task->id) }}" title="ลบ" class="btn btn-danger btn-sm "><i class="far fa-trash-alt"></i></a>
                                    @endif
                                    <a href="{{ route('tasks.show',$task->id) }}" title="ดูรายละเอียด" class="btn btn-info btn-sm "><i class="fas fa-info"></i></a>
                                    
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">จุดประสงค์โครงการ</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach(@$project->project_purposes as $project_purpose)
                        <li class="item">
                            <div class="product-info ml-0">
                                <span class="product-description">
                                    <i class="fas fa-circle" ></i> {{$project_purpose->purpose_name}}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ประโยชน์ที่คาดว่าจะได้รับ</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach(@$project->project_expecteds as $project_expecteds)
                        <li class="item">
                            <div class="product-info ml-0">
                                <span class="product-description">
                                    <i class="fas fa-circle" ></i> {{$project_expecteds->expected_name}}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ผู้สนับสนุนโครงการ</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach(@$project->project_supports as $project_supports)
                        <li class="item">
                            <div class="product-info ml-0">
                                <span class="product-description">
                                    <i class="fas fa-circle" ></i> {{$project_supports->name}}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

<script>

$(".reject").on('click',function(){
    var link = $(this).attr('href');
    var title = $(this).data('title-msg') == undefined ? "กรุณายืนยัน!" : $(this).data('title-msg') ;
    var msg = $(this).data('msg') == undefined ? "confirm msg?" : $(this).data('msg') 

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: title,
            text: msg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่! ยืนยัน',
            cancelButtonText: 'ไม่! ยกเลิก',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $("#rejectCommentModal").modal();
            } 
    })

    
    return false
});
</script>


<style>
.direct-chat-messages {
    -webkit-transform: translate(0,0);
    transform: translate(0,0);
    height: 365px;
    overflow: auto;
    overflow-x: hidden;
    padding: 0px;
}
.pointer {cursor: pointer;}
</style>


<!-- Modal -->
<div class="modal fade" id="rejectCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">กรุณากรอกเหตุผล ที่ตีกลับโครงการ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('rejectProject') }} " method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" value="{{$project->id}}">
                <textarea class="form-control" name="comment" required cols="30" rows="5"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i>   ยกเลิก
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-reply-all"></i> ตีกลับ
                </button>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection