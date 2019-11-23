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
                        <th>Permission Name</th>
                        <th>Description</th>
                        <th style="width: 220px">ตั้งค่า</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <a href="{{ route('permissions.show',$permission->id) }}" class="btn btn-sm btn-success">ดูข้อมูล</a>
                                <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="{{ route('permissions.delete',$permission->id) }}" class="btn btn-sm btn-danger">ลบ</a>
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
            <a href=" {{ route('permissions.create') }} " class="btn btn-primary">
                <i class="fa fa-plus"></i> เพิ่ม Permission
            </a>
        </div>
    </div>
</div>
<br>

@endsection