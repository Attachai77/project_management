@extends('layouts.adminlte')

@section('content')

<div class="col-md-12">
    <!-- USERS LIST -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title float-right">
                <span style="color:#20c997;">สมาชิกทั้งหมดจำนวน <b style="font-size:20px;">{{$membersCount}}</b> คน</span>
            </h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body p-0">
            <ul class="users-list clearfix">
                @foreach($members as $member)
                <a href="{{ route('users.show',$member->id) }}" data-toggle="tooltip" data-placement="top" title="คลิกเพื่อดูข้อมูลผู้ใช้เพิ่มเติม">
                    <li>
                    @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId($member->id) @endphp
                    <img src="{{$img_url}}" alt="User Image">
                    <a class="users-list-name" href="#">{{ $member->first_name.' '.$member->last_name }}</a>
                    <span class="users-list-date">
                    @php $role_list = \App\Helpers\Permission::getRoleListNameByUserId($member->id) @endphp
                        @if(!empty($role_list))
                            @foreach($role_list as $role_id => $role_name)
                            <span class="badge badge-info right">{{ '# '.$role_name }}</span>
                            @endforeach
                        @endif
                    </span>
                    </li>
                </a>
                @endforeach
            </ul>
        </div>
        <!-- /.card-body -->

    </div>
    <!--/.card -->
</div>

<style>


@media (min-width: 768px){
    .users-list>li {
        float: left;
        padding: 10px;
        text-align: center;
        width: 20%;
    }
    .users-list>li img {
        width: 90px;
        height: 90px;
    }
}
@media (max-width: 767px){
    .users-list>li {
        float: left;
        padding: 10px;
        text-align: center;
        width: 25%;
    }
    .users-list>li img {
        width: 90px;
        height: 90px;
    }
}
</style>

@endsection