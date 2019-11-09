@extends('layouts.adminlte')

@section('content')

<div class="col-12">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">โครงการ</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>ชื่อโครงหาร</th>
                        <th>เจ้าของโครงการ</th>
                        <th style="width: 80px">สถานะ</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $key => $project)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $project->project_name }}</td>
                            <td>{{ \App\Helpers\GetBy::getFullnameById($project->project_owner_id) }}</td>
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