@extends('layouts.adminlte')

@section('content')

<style>
p.text-muted{
    margin-bottom: 0;
}
</style>

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
                            @if($project_status === 'reject')
                                <button type="button" class="btn btn-sm btn-secondary float-left mr-2" onClick="rejectReason('project_{{$project->id}}')">เหตุผลตีกลับ</button>
                            @endif

                            @if($project_status === 'pending' || $project_status === 'reject')
                            <a href="{{ route('projects.edit',$project->id) }}" class="btn btn-sm btn-warning" title="แก้ไข" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-edit"></i> 
                            </a>
                            @endif
                            <a href="{{ route('myProjectDetail',$project->id) }}" class="btn btn-sm btn-primary" title="ดูข้อมูล" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-info-circle"></i> 
                            </a>
                            @if($project_status === 'request_done')
                            <a href="{{ route('summaryProjectDashboard',$project->id) }}" class="btn btn-sm bg-info" title="ดูผลการประเมิน" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-eye"></i> 
                            </a>
                            @endif

                            @if($project_status === 'pending')
                            <a href="{{ route('projects.delete',$project->id) }}" data-msg="ต้องการลบโครงการนี้ใช่หรือไม่" class="btn btn-sm bg-danger confirmLink" title="ลบ" data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-trash"></i> 
                            </a>
                            @endif

                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="project_{{$project->id}}" role="dialog">
                            <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">เหตุผลที่โครงการถูกตีกลับ</h4>
                                    </div>
                                    <div class="modal-body">
                                        @php $project_log = \App\Helpers\GetBY::getLastProjectLogReject($project->id) @endphp
                                        
                                        @if($project_log != null)
                                        <label>ตีกลับโดย : </label> {{ \App\User::getFullnameById($project_log->created_uid) }}

                                        <br><br>
                                        
                                        <label>เหตุผลที่ตีกลับ : </label> {{ $project_log->comment }}
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        
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

<script>
function rejectReason(modal)
{
    $('#'+modal).modal();
}
</script>



@endsection