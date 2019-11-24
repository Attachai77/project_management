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


            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row d-flex align-items-stretch">

                        @foreach ($projects as $key => $project)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch ">
                            <div class="card bg-light card-widget widget-user-2" style="width:100%">

                                <div class="widget-user-header bg-white">
                                    <div class="widget-user-image">
                                    <img class="" src="/img/project.png" alt="User Avatar">
                                    </div>
                                    <h5 class="widget-user-desc" style="font-size:18px;">{{ $project->project_name }}</h5>
                                </div>

                                <div class="card-body pt-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="text-muted text-sm">
                                                <b>เจ้าของโครงการ: </b>{{ \App\User::getFullnameById($project->project_owner_id) }}
                                            </p>

                                            <p class="text-muted text-sm">
                                                <b>สถานะ: </b> 
                                                {!! \App\Helpers\GetBy::getProjectStatusBladeByStatusId($project->status) !!}
                                            </p>

                                            <p class="text-muted text-sm">
                                                <b><i class="fas fa-calendar-alt"></i> เริ่ม: </b> 
                                                {{ $project->start_date }}
                                            </p>

                                            <p class="text-muted text-sm">
                                                <b><i class="fas fa-calendar-alt"></i> สิ้นสุด: </b> 
                                                {{ $project->end_date }}
                                            </p>

                                            <p class="text-muted text-sm">
                                                <b><i class="fas fa-users"></i> สมาชิก </b> 
                                                10 คน
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{ route('projects.edit',$project->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> แก้ไข
                                        </a>
                                        <a href="{{ route('projects.delete',$project->id) }}" class="btn btn-sm bg-danger">
                                            <i class="fas fa-trash"></i> ลบ
                                        </a>
                                        <a href="{{ route('projects.show',$project->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-info-circle"></i> ดูเพิ่มเติม
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <nav aria-label="Contacts Page Navigation">
                        <ul class="pagination justify-content-center m-0">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                        <li class="page-item"><a class="page-link" href="#">8</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- /.card-footer -->
            </div>

        </div>
    </div>
</div>


@endsection