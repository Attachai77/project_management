@extends('layouts.adminlte')

@section('content')

<div class="col-12">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">เพิ่มสมาชิกโครงการ</h3>
                </div>
                <form method="POST" action="{{ route('projects.projectMember',$project->id) }}" class="form-horizontal">
                    @csrf
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อโครงการ:</label>
                            <div class="col-sm-6">{{ $project->project_name }}</div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label"># เพิ่มสมาชิก</label>

                            <div class="col-sm-8">
                                <div class="callout callout-info" style="background-color: #d2d2d2;">
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">
                                            <i class="fas fa-user fa-1x"></i> ชื่อ-นามสกุล :
                                        </label>
                                        <div class="col-sm-9">
                                            @php $officer_list =  \App\Helpers\ListData::getOfficerNameList() @endphp
                                            <select class="form-control" name="user_id" id="">
                                                @if(!empty($officer_list))
                                                    @foreach($officer_list as $user_id => $fullname)
                                                        <option value="{{$user_id}}">{{$fullname}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label">ตำแหน่ง :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="position_id" id="">
                                                @if(!empty($positions))
                                                    @foreach($positions as $position_id => $position)
                                                        <option value="{{$position_id}}">{{$position}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('projects.show',$project->id) }}" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับ</a>
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> บันทึก</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </div>
</div>
<br><br>

<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users"></i> สมาชิกปัจจุบัน</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 60px"></th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>ตำแหน่ง</th>
                            <th style="width: 100px">ตั้งค่า</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project_members as $key => $project_member)
                        <tr>
                            <td>{{ ++$key }}</td>
                            @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId($project_member->user_id) @endphp
                            <td><img src="{{$img_url}}" class="img-circle elevation-2" alt="User Image" style="width:50px;"></td>
                            <td>{{ $project_member->user->first_name.' '.$project_member->user->last_name }}</td>
                            <td>{{ $project_member->position->position_name }}</td>
                            <td><a href="{{ route('projects.deleteProjectMember',$project_member->id) }}" class="btn btn-sm btn-danger">ลบ</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>

@endsection