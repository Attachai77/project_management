@extends('layouts.adminlte')

@section('content')

<div class="col-12">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th width="10%"></th>
                        <th>ชื่อ</th>
                        <th>ชื่อผู้ใช้งาน</th>
                        <th>กลุ่มผู้ใช้ (role)</th>
                        <th>เปิดใช้งาน</th>
                        <th style="width: 290px">ตั้งค่า</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                                <div class="image">
                                    @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId($user->id) @endphp
                                    <img src="{{$img_url }}" width=45px" class="img-circle elevation-2" alt="User Image">
                                </div>
                            </td>
                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @php $role_list = \App\Helpers\Permission::getRoleListNameByUserId($user->id) @endphp
                                @if(!empty($role_list))
                                    @foreach($role_list as $role_id => $role_name)
                                    <span class="badge badge-info right">{{ '# '.$role_name }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="icheck-teal d-inline">
                                    <input data-user="{{$user->id}}" type="checkbox" id="user_{{$user->id}}" {{ $user->active? "checked" : "" }} >
                                    <label for="user_{{$user->id}}"></label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('users.show',$user->id) }}" class="btn btn-sm btn-success">ดูข้อมูล</a>
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                                @if(Auth::user()->username === 'master')
                                <a href="{{ route('users.assign_permission',$user->id) }}" class="btn btn-sm btn-info">สิทธิ์เพิ่มเติม</a>
                                <a href="{{ route('users.delete',$user->id) }}" data-msg="ต้องการลบผู้ใช้งานคนนี้ใช่หรือไม่" class="btn btn-sm btn-danger confirmLink">ลบ</a>
                                @endif
                            </td>
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

<div class="col-12">
    <div class="row">
        <div class="col-12">
            <a href=" {{ route('users.create') }} " class="btn btn-primary"><i class="fa fa-plus"></i> เพิ่มผู้ใช้งาน</a>
        </div>
    </div>
</div>

<br>

<script>
$(document).on('change','input[type="checkbox"]',function(e){
    var active = $(this).prop("checked");
    var user_id = $(this).data('user');
    $.get("/users/enabledUser/"+user_id+"/"+active, function(data, status){
        if(data.success){
            sweetAlertSuccess("สำเร็จ!",data.msg,'ปิด');
        }else{
            sweetAlertError("เกิดข้อผิดพลาด!",'ไม่สามารถแก้ไขข้อมูลได้ มีบางอย่างผิดพลาด','ปิด');
        }
    });
});
</script>

@endsection