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
                        <th>ชื่อกลุ่มบทบาท</th>
                        <th>คำอธิบาย</th>
                        <th style="width: 300px">ตั้งค่า</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                <a href="{{ route('roles.show',$role->id) }}" class="btn btn-sm btn-success">ดูข้อมูล</a>
                                <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="{{ route('roles.delete',$role->id) }}" class="btn btn-sm btn-danger">ลบ</a>
                                <a href="{{ route('roles.assignPermission',$role->id) }}" class="btn btn-sm btn-info">กำหนดสิทธิ์</a>
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
            <a href=" {{ route('roles.create') }} " class="btn btn-primary">
                <i class="fa fa-plus"></i> เพิ่มกลุ่มบทบาท
            </a>
        </div>
    </div>
</div>

@endsection