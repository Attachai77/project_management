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
                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">ชื่อโครงการ :</label>
                        <div class="col-sm-9">
                        <a href="{{ route('projects.show',$project->id) }}"><span style="color: #20c997; font-weight:bold;">{{ $project->project_name }} </span></a>
                        </div>
                    </div>

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

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="#" onCLick="window.history.go(-1)"   class="btn btn-default">
                        <i class="fa fa-angle-left"></i> กลับ
                    </a>

                    @if($project->status === 3 && $projectCompleted && $project->project_owner_id === Auth::user()->id)
                    <a href="{{route('doneProject',$project->id)}}" class="btn btn-success float-right confirmLink"
                    data-msg="ต้องการปิดโครงการใช่หรือไม่">
                        <i class="fas fa-check"></i> ปิดโครงการ
                    </a>
                    @endif

                    @if( ($project->status === 0 || $project->status === 6) && $project->project_owner_id === Auth::user()->id)
                    <a href="{{route('sentCheck',$project->id)}}" class="btn btn-info float-right confirmLink"
                    data-msg="ต้องการส่งโครงการเพื่อตรวจสอบใช่หรือไม่">
                        <i class="far fa-paper-plane"></i> ส่งตรวจสอบ
                    </a>
                    @endif

                    @if($project->status === 2 && $project->project_owner_id === Auth::user()->id )
                    <a href="{{route('sentProgress',$project->id)}}" class="btn btn-info float-right confirmLink"
                    data-msg="ต้องการดำเนินโครงการนี้ใช่หรือไม่">
                        <i class="fas fa-running"></i> ดำเนินโครงการ
                    </a>
                    @endif

                    <!--  -->
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users"></i> สมาชิกโครงการ / ผู้จัดโครงการ</h3>

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

                <div class="card-footer">
                    <div class="text-right">
                        @if( ($project->project_owner_id == Auth::user()->id ) && ($project->status === 0 || $project->status === 2 || $project->status === 3 ) )
                        <a href="{{route('projects.projectMember',$project->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> เพิ่ม / แก้ไขสมาชิก</a>
                        @endif
                        <a href="javascript:voide(0)" onClick="projectMemberModal()" class="btn btn-sm btn-primary"><i class="fa fa-info"></i> ดูเพิ่มเติม</a>
                    </div>
                </div>

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
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>กิจกรรม</th>
                                <th>เจ้าของ/ผู้รับผิดชอบ</th>
                                <th>ความคืบหน้า</th>
                                <th>สถานะ</th>
                                <th width="14%">ตั้งค่า</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $k => $task)
                            <tr>
                                @php $task_status = \App\Helpers\Check::taskStatus($task->id) @endphp
                                <?php #dd($task_status); ?>
                                <td>{{ ++$k }}</td>
                                <td>{{ $task->task_name }}</td>
                                <td>{{ \App\User::getFullnameById($task->task_owner_id) }}</td>
                                <td>
                                    <div class="progress progress-xs" style="margin-top: 10px;">
                                        <div class="progress-bar bg-{{$task_status['badge'] }}" style="width: {{$task_status['percent'] }}%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-{{$task_status['badge']}}">{{ $task_status['status_th'] }}</span></td>
                                <td>
                                    <a href="{{ route('tasks.show',$task->id) }}" title="ดูรายละเอียด" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
                                    @if(Auth::user()->id === $task->task_owner_id)

                                    @php $completed = ""; @endphp
                                    @if($task->status === 2)
                                        @php $completed = "disabled"; @endphp
                                    @endif
                                    <a href="{{ route('tasks.edit',$task->id) }}" title="แก้ไข" class="{{$completed}} btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="{{ route('tasks.delete',$task->id) }}" title="ลบ" class="{{$completed}} btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="text-right">
                    @if(($project->status === 0 || $project->status === 2 || $project->status === 3 ) && in_array(Auth::user()->id, $project_member_id) )
                        <a href="{{route('tasks.create',$project->id)}}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i> เพิ่มกิจกรรม
                        </a>
                        <p class="mb-0" style="font-size:12px; color:#bbb; margin-top:2px;">*สมาชิกโครงการทุกคนสามารถเพิ่มกิจกรรมได้</p>
                    @endif
                    </div>
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
                    <h3 class="card-title">ผลที่คาดว่าจะได้รับ</h3>
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
function projectMemberModal(){
    $("#projectMemberModal").modal();
}
</script>


 <!-- The Modal -->
 <div class="modal fade" id="projectMemberModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">สมาชิกโครงการทั้งหมด</h4>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th style="width: 10px">#</th>
                            <th></th>
                            <th>ชื่อ - สกุล</th>
                            <th>ตำแหน่ง</th>
                            <th>เข้าร่วมเมื่อ</th>
                            <th>เพิ่มโดย</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($project->members as $key => $member)
                        @php $user = \App\User::find($member->user_id) @endphp
                            @if($user !== null)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>
                                    @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId($member->user_id) @endphp
                                    <img src="{{$img_url}}" class="member-img2" alt="User Image">
                                </td>
                                <td>{{ $user->first_name.' '.$user->last_name }}</td>
                                <td>{{ \App\Helpers\GetBy::getProjectPositionNameById($member->position_id) }}</td>
                                <td>{{ $member->created_at }}</td>
                                <td>{{ \App\User::getFullnameById($member->created_uid) }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
                
            </div>
        </div>
  </div>


<style>
.direct-chat-messages {
    -webkit-transform: translate(0,0);
    transform: translate(0,0);
    height: 365px;
    overflow: auto;
    overflow-x: hidden;
    padding: 0px;
}
.member-img2 {
    width: 60px;
    border-radius: 50%;
    margin-left: 25px;
    height: 60px;
}
</style>


@endsection