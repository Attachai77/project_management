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
                        <th>Permission Group Name</th>
                        <th style="width: 220px">ตั้งค่า</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissionGroups as $key => $permissionGroup)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $permissionGroup->group_name }}</td>
                            <td>
                                <a href="{{ route('permission_groups.show',$permissionGroup->id) }}" class="btn btn-sm btn-success">ดูข้อมูล</a>
                                <a href="{{ route('permission_groups.edit',$permissionGroup->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="{{ route('permission_groups.delete',$permissionGroup->id) }}" class="btn btn-sm btn-danger">ลบ</a>
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
            <a href=" {{ route('permission_groups.create') }} " class="btn btn-primary">
                <i class="fa fa-plus"></i> เพิ่ม Permission Group
            </a>
        </div>
    </div>
</div>

@endsection