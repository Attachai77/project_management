@extends('layouts.adminlte')

@section('content')



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i> ข้อมูลตำแหน่ง
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <dl>
                    <dt>ชื่อตำแหน่ง</dt>
                    <dd>{{ $position->position_name }}</dd>

                    <dt>สร้างโดย</dt>
                    <dd>{{ \App\User::getFullnameById($position->created_uid) }}</dd>

                    <dt>สร้างเมื่อ</dt>
                    <dd>{{ $position->created_at }}</dd>
                </dl>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('project_positions.index') }}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i> กลับ
                </a>
            </div>

        </div>
        <!-- /.card -->
    </div>
</div>


@endsection