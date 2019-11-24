@extends('layouts.adminlte')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-12">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">แก้ไขข้อมูลตำแหน่ง</h3>
                </div>
                <form method="POST" action="{{ route('project_positions.update',$position->id) }}" class="form-horizontal">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อตำแหน่ง:</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ $position->position_name }}" required name="position_name" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="{{ route('project_positions.index') }}" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับ</a>
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> บันทึกการแก้ไข</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </div>
</div>

@endsection