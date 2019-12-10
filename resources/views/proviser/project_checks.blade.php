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
                <div class="card-body pb-0 pt-0">

                    <div class="col-12 text-right" style="color:#999;">
                        <p class="mb-0"><b>จำนวนโครงการของคุณ
                        <span style="font-size:36px; color:#20c997;">{{ $myProjectCount }}</span> 
                        โครงการ
                        </b></p>
                    </div>
                    
                    <div class="row d-flex align-items-stretch">
                        
                        @if($myProjectCount === 0)
                        <div style="padding:20px;">
                            <h6 style="color: #999;">- ไม่มีข้อมูล {{$title_s}} -</h6>
                        </div>
                        @endif

                        @foreach ($project_checks as $key => $project)
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
                                        <a href="{{ route('projects.show',$project->id) }}" class="btn btn-sm btn-primary" title="ดูข้อมูล" data-toggle="tooltip" data-placement="top">
                                            <i class="fas fa-info-circle"></i> 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-12" style="padding: 1.25rem;">
                    {{ $project_checks->appends(request()->except('page'))->links() }}
                </div>

            </div>

        </div>
    </div>
</div>


@endsection