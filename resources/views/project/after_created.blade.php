@extends('layouts.adminlte')

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-text-width"></i>
                รายละเอียดโครงการ
            </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-4 control-label">
                        <label>ชื่อโครงการ : </label>
                    </div>
                    <div class="col-8">
                        {{ $project->project_name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label">
                        <label>เจ้าของโครงการ / หัวหน้าโครงการ : </label>
                    </div>
                    <div class="col-8">
                        {{ \App\Helpers\GetBy::getFullnameById($project->project_owner_id) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label">
                        <label>ที่ปรึกษาโครงการ : </label>
                    </div>
                    <div class="col-8">
                        {{ $project->adviser }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label">
                        <label>วันที่เริ่ม : </label>
                    </div>
                    <div class="col-8">
                        {{ $project->start_date }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label">
                        <label>วันที่สิ้นสุด : </label>
                    </div>
                    <div class="col-8">
                        {{ $project->end_date }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label">
                        <label>งบประมาณ : </label>
                    </div>
                    <div class="col-8">
                        {{ $project->budget }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label">
                        <label>สถานที่่จัดโครงการ : </label>
                    </div>
                    <div class="col-8">
                        {{ $project->location }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label bg-success color-palette">
                        <label>วัตถุประสงค์การจัดโครงการ : </label>
                    </div>
                    <div class="col-8 bg-success disabled color-palette">
                        @php $i = 1; @endphp
                        @foreach($project_purposes as $k => $project_purpose)
                        <div>{{ $i++ }}. {{ $project_purpose->purpose_name }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label bg-warning">
                        <label>ผลที่คาดว่าจะได้รับ : </label>
                    </div>
                    <div class="col-8 bg-warning disabled color-palette">
                        @php $i = 1; @endphp
                        @foreach($project_expecteds as $k => $project_expected)
                        <div>{{ $i++ }}. {{ $project_expected->expected_name }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 control-label bg-primary">
                        <label>ผู้สนับสนุน : </label>
                    </div>
                    <div class="col-8 bg-primary disabled color-palette">
                        @php $i = 1; @endphp
                        @foreach($project_supports as $k => $project_support)
                        <div>{{ $i++ }}. {{ $project_support->name }}</div>
                        @endforeach
                    </div>
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- ./col -->
</div>


@endsection