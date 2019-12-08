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
                        <th>ชื่อตำแหน่ง</th>
                        <th style="width: 300px">ตั้งค่า</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $key => $position)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $position->position_name }}</td>
                            <td>
                                <a href="{{ route('project_positions.show',$position->id) }}" class="btn btn-sm btn-success">ดูข้อมูล</a>
                                <a href="{{ route('project_positions.edit',$position->id) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                                <a href="{{ route('project_positions.delete',$position->id) }}" data-msg="ต้องการลบตำแหน่งนี้ใช่หรือไม่" class="btn btn-sm btn-danger confirmLink">ลบ</a>
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
            <a href=" {{ route('project_positions.create') }} " class="btn btn-primary">
                <i class="fa fa-plus"></i> เพิ่มตำแหน่ง
            </a>
        </div>
    </div>
</div>

<br>

@endsection