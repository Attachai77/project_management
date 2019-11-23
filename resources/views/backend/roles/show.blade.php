@extends('layouts.adminlte')

@section('content')



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i> ข้อมูลกลุ่มบทบาท
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <dl>
                    <dt>ชื่อกลุ่ม (ที่ใช้แสดง)</dt>
                    <dd>{{ $role->display_name }}</dd>

                    <dt>ชื่อกลุ่ม (key name)</dt>
                    <dd>{{ $role->name }}</dd>

                    <dt>คำอธิบาย</dt>
                    <dd>{{ $role->description }}</dd>
                </dl>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('roles.index') }}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i> กลับ
                </a>
            </div>

        </div>
        <!-- /.card -->
    </div>
</div>


@endsection