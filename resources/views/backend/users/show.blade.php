@extends('layouts.adminlte')

@section('content')

<div class="col-12">
    <div class="row">
        <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="/img/user4-128x128.jpg"
                        alt="User profile picture" style="width: 150px;">
                    </div>

                    <h3 class="profile-username text-center">{{ \App\Helpers\GetBy::getFullnameById($user->id) }}</h3>

                    <p class="text-muted text-center"><b>เจ้าหน้าที่</b></p>
                    <h6 class="text-muted text-center">
                        <i class="fa fa-phone"></i> 099999999
                    </h6>
                    <h6 class="text-muted text-center">
                        <i class="fa fa-envelope"></i> project@gmail.com
                    </h6>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>ชื่อผู้ใช้งาน</b> <a class="float-right"> {{ $user->username }} </a>
                        </li>
                        <li class="list-group-item">
                            <b>ชื่อ</b> <a class="float-right"> {{ @$profile->firstname }} </a>
                        </li>
                        <li class="list-group-item">
                            <b>นามสกุล</b> <a class="float-right">{{ @$profile->lastname }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>บทบาท (Role)</b> <a class="float-right">เจ้าหน้าที่</a>
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
                            <a href=" {{ route('users.index') }} " class="btn btn-default btn-sm">กลับ</a>
                        </div>
                        <div class="col-6" style="text-align:right;">
                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-sm">แก้ไขข้อมูล</a>
                            <a href="#" class="btn btn-danger btn-sm">ลบผู้ใช้งาน</a>
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