@extends('layouts.adminlte')

@section('content')

<div class="col-12">
    <div class="row">
        <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId($user->id) @endphp
                    <img class="profile-user-img img-fluid img-circle"
                        src="{{$img_url}}"
                        alt="User profile picture" style="width: 150px; height:150px;">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->first_name.' '.$user->last_name }}</h3>

                    <p class="text-muted text-center">
                        @php $role_list = \App\Helpers\Permission::getRoleListNameByUserId($user->id) @endphp
                        @if(!empty($role_list))
                            @foreach($role_list as $role_id => $role_name)
                            <span class="badge badge-info right">{{ '# '.$role_name }}</span>
                            @endforeach
                        @endif
                    </p>
                    <h6 class="text-muted text-center">
                        <i class="fa fa-phone"></i> {{ $user->tel_no }}
                    </h6>
                    <h6 class="text-muted text-center">
                        <i class="fa fa-envelope"></i> {{$user->email}}
                    </h6>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>ชื่อผู้ใช้งาน</b> <a class="float-right"> {{ $user->username }} </a>
                        </li>
                        <li class="list-group-item">
                            <b>ชื่อ</b> <a class="float-right"> {{ $user->first_name }} </a>
                        </li>
                        <li class="list-group-item">
                            <b>นามสกุล</b> <a class="float-right">{{ @$user->lastname }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>กลุ่มผู้ใช้ (Role)</b> 
                            <a class="float-right">
                                @php $role_list = \App\Helpers\Permission::getRoleListNameByUserId($user->id) @endphp
                                @if(!empty($role_list))
                                    @foreach($role_list as $role_id => $role_name)
                                    <span class="badge badge-info right">{{ '# '.$role_name }}</span>
                                    @endforeach
                                @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>สร้างโดย</b> <a class="float-right"> {{ @$user->created_uid }} </a>
                        </li>
                        <li class="list-group-item">
                            <b>สร้างเมื่อ</b> <a class="float-right"> {{ @$user->created_at }} </a>
                        </li>
                        <li class="list-group-item">
                            <b>แก้ไขข้อมูลล่่าสุดเมื่อ</b> <a class="float-right">{{ @$user->updated_at }}</a>
                        </li>
                    </ul>

                    <br>
                    <br>
                    <br>

                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:history.back();" class="btn btn-default btn-sm">กลับ</a>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-sm">แก้ไขข้อมูล</a>
                            <a href="{{ route('users.delete',$user->id) }}" class="btn btn-danger btn-sm">ลบผู้ใช้งาน</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
    </div>
</div>


@endsection