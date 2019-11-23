@extends('layouts.adminlte')

@section('content')



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i> ข้อมูลกลุ่ม Permission
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <dl>
                    <dt>Permission Group Name</dt>
                    <dd>{{ $group->group_name }}</dd>

                    <dt>สร้างโดย</dt>
                    <dd>{{ $group->created_uid }}</dd>

                    <dt>สร้างเมื่อ</dt>
                    <dd>{{ $group->created }}</dd>
                </dl>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('permission_groups.index') }}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i> กลับ
                </a>
            </div>

        </div>
        <!-- /.card -->
    </div>
</div>


@endsection