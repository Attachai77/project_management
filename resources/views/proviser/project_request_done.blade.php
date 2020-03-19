@extends('layouts.adminlte')

@section('content')


<div class="col-12">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header border-transparent">
                <h3 class="card-title">#โครงการ</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                <div class="table-responsive table-hover">
                    <table class="table m-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>#ชื่อโครงการ</th>
                        <th>#ความคืบหน้า</th>
                        <th>ตั้งค่า</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($projects as $key => $project)
                        <tr class="project" onClick="viewProject( {{$project->id}} )">
                            <td>{{ ++$key }}</td>
                            <td>{{ $project->project_name }}</td>                                                 
                            <td>
                            @php $progress = \App\Helpers\Project::getProjectProgressPercent($project->id) @endphp
                            {{$progress }}
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-teal" role="progressbar" 
                                aria-volumenow="{{$progress}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$progress}}%">
                            </div>
                            </td>
                            <td>

                            <a href="{{ route('myProjectDetail',$project->id) }}" class="btn btn-sm btn-primary" title="ดูข้อมูล" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-info-circle"></i> 
                            </a>
                            
                            <a href="{{ route('summaryProjectDashboard',$project->id) }}" class="btn btn-sm bg-info" title="ดูผลการประเมิน" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-eye"></i> 
                            </a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
            </div>

        </div>
    </div>
</div>


@endsection