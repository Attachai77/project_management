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
                            <div class="col-sm-6">
                            <a href="{{ route('projects.show',$project->id) }}"><span style="color: #20c997; font-weight:bold;">{{ $project->project_name }} </span></a>
                            </div>
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
                                            <input type="text" class="form-control" name="member_name" placeholder=ชื่อสมาชิกโครงการ>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('myProjectDetail',$project->id) }}" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับ</a>
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
                            <th style="width: 100px">ตั้งค่า</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId($project->project_owner_id) @endphp
                            <td><img src="{{$img_url}}" class="img-circle elevation-2" alt="User Image" style="width:50px;"></td>
                            <td>{{ \App\User::getFullnameById(Auth::id()) }}</td>
                            <td></td>
                        </tr>
                        @foreach($project_members as $key => $project_member)
                        <tr>
                            <td>{{ ++$key }}</td>
                            @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId(null) @endphp
                            <td><img src="{{$img_url}}" class="img-circle elevation-2" alt="User Image" style="width:50px;"></td>
                            <td>{{ $project_member->member_name }}</td>
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