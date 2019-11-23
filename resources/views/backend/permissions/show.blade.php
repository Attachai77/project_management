@extends('layouts.adminlte')

@section('content')



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i> ข้อมูล Permission
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <dl>
                    <dt>Permission Name</dt>
                    <dd>{{ $permission->name }}</dd>

                    <dt>Description</dt>
                    <dd>{{ $permission->description }}</dd>

                    <dt>Group</dt>
                    <dd>{{ $permission->permission_group_id }}</dd>

                    <dt>สร้างเมื่อ</dt>
                    <dd>{{ $permission->created }}</dd>
                </dl>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('permissions.index') }}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i> กลับ
                </a>
            </div>

        </div>
        <!-- /.card -->
    </div>
</div>


@endsection