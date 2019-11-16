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
                        <th>บทบาท (role)</th>
                        <th style="width: 220px">ตั้งค่า</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>
                                <div class="image">
                                    <img src="/img/user2-160x160.jpg" width=45px" class="img-circle elevation-2" alt="User Image">
                                </div>
                            </td>
                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <a href="{{ route('users.show',$user->id) }}" class="btn btn-sm btn-success">ดูข้อมูล</a>
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="#" class="btn btn-sm btn-danger">ลบ</a>
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

@endsection