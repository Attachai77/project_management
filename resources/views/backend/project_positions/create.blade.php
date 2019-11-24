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
                    <h3 class="card-title">กรอกข้อมูลกลุ่มบทบาท</h3>
                </div>
                <form method="POST" action="{{ route('project_positions.store') }}" class="form-horizontal">
                    @csrf
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อตำแหน่ง:</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ old('position_name') }}" required name="position_name" class="form-control" placeholder="ชื่อตำแหน่ง">
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="{{ route('project_positions.index') }}" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับ</a>
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> บันทึก</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </div>
</div>

@endsection