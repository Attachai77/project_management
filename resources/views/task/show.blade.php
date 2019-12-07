@extends('layouts.adminlte')

@section('content')
<style>
.member-img{
    width:70px; 
    border-radius: 50%;
    margin-left:15px;
}
.products-list .product-info {
    margin-left: 80px;
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
                        <div class="col-sm-9">{{ $task->project->project_name }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">ชื่อกิจกรรม :</label>
                        <div class="col-sm-9">{{ $task->task_name }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">สถานะกิจกรรม :</label>
                        <div class="col-sm-9">{!! $task->status !!}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">เจ้าของกิจกรรม :</label>
                        <div class="col-sm-9">
                            <a href="#">{{ \App\User::getFullnameById($task->task_owner_id) }}</a>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">เพิ่มกิจกรรมโดย :</label>
                        <div class="col-sm-9">
                            <a href="#">{{ \App\User::getFullnameById($task->created_uid) }}</a>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">เริ่มเวลา:</label>
                        <div class="col-sm-9"><i class="nav-icon far fa-calendar-alt"></i> {{ $task->start_date }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">สิ้นสุด :</label>
                        <div class="col-sm-9"><i class="nav-icon far fa-calendar-alt"></i> {{ $task->end_date }}</div>
                    </div>

                    <div class="form-group row mb-0">
                        <label class="col-sm-3 control-label">รายละเอียดอื่น ๆ :</label>
                        <div class="col-sm-9">{{ $task->description }}</div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="/projects/{{$task->project_id}}" class="btn btn-default"><i class="fa fa-angle-left"></i> กลับก่อนหน้า</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> สรุปผลกิจกรรม</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="description-block">
                        <span class="description-percentage text-info">
                            <h1 style="margin-bottom:0px;"><b>{{ count($task_members)+1 }}</b></h1>
                        </span>
                        <span class="description-text">จำนวนผู้รับผิดชอบกิจกรรมนี้</span>
                    </div><br>

                    <div class="progress-group">
                        <span class="progress-text">ความคืบหน้ากิจกรรม</span>
                        <span class="float-right">50%</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

</div>


<div class="col-12">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i> ผู้รับผิดชอบกิจกรรม
                    </h3>

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

                        <li class="item">
                            <div class="product-img">
                            <img src="/img/user1-128x128.jpg" class="member-img img-size-50" alt="User Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{ \App\User::getFullnameById($task->task_owner_id) }}
                                    <span class="badge badge-warning">(เจ้าของกิจกรรม)</span>
                                    <span style="font-weight:normal; font-size:12px; color:#888;" 
                                    class="float-right">เข้าร่วมเมื่อ {{ $task->created_at }}</span>
                                </a>
                                <span class="product-description">
                                    หน้าที่ที่รับผิดชอบ
                                </span>
                            </div>
                        </li>

                        @foreach($task->member as $k => $member)
                        <li class="item">
                            <div class="product-img">
                            <img src="/img/user1-128x128.jpg" class="member-img img-size-50" alt="User Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{ \App\User::getFullnameById($member->user_id) }}
                                    <span style="font-weight:normal; font-size:12px; color:#888;" 
                                    class="float-right">เข้าร่วมเมื่อ {{ $member->created_at }}</span>
                                </a>
                                <span class="product-description">
                                    {{$member->mission}}
                                    @if(Auth::user()->id === $task->task_owner_id)
                                        <a href="{{ route('tasks.removeMember',$member->id) }}"><span class="float-right" style="font-size:12px; color:#ccc;">ลบออก</span></a>
                                    @endif
                                </span>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">ดูข้อมูลเพิ่มเติมโดยละเอียด</a>
                    <a href="javascript:void(0);" onCLick="addMember()" class="btn btn-info btn-sm float-right">
                        <i class="fas fa-plus"></i> เพิ่มผู้รับผิดชอบ
                    </a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
</div>

<script>
function addMember(){ $("#addMemberModel").modal() }
</script>

<!-- Modal -->
<div class="modal fade" id="addMemberModel">
    <div class="modal-dialog" style="max-width: 50%;">
        <div class="modal-content">
            <form action="{{route('tasks.addMember',$task->id)}}" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">เพิ่มผู้รับผิดชอบ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" value="{{$task->id}}" name="task_id">
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">เลือกผู้รับผิดชอบ :</label>
                        <div class="col-sm-8">
                            <select name="user_id" class="form-control">
                                @foreach($project_members as $project_member_id)
                                    @if($project_member_id == $task->task_owner_id || in_array($project_member_id, $task_members) )
                                        @php $hasMember = "disabled" @endphp
                                        @php $hasBeMember = "(เป็นผู้รับผิดชอบกิจกรรมอยู่แล้ว)" @endphp
                                    @else
                                        @php $hasMember = "" @endphp
                                        @php $hasBeMember = "" @endphp
                                    @endif
                                <option {{$hasMember}} value="{{$project_member_id}}">{{ \App\User::getFullnameById($project_member_id) }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 control-label">หน้าที่ที่รับผิดชอบ :</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="mission" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก / ปิด</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection