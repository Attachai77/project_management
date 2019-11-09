@extends('layouts.adminlte')

@section('content')

<div class="col-12">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ตำแหน่งโครงการ</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>ชื่อตำแหน่ง</th>
                        <th style="width: 80px">สถานะ</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($ms_project_roles as $key => $ms_project_role)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $ms_project_role->ms_project_role_name }}</td>
                            <td></td>
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

@endsection