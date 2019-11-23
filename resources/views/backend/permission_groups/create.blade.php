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
                    <h3 class="card-title"><i class="fa fa-plus"></i> Add Permission Group</h3>
                </div>
                <form method="POST" action="{{ route('permission_groups.store') }}" class="form-horizontal">
                    @csrf
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Group Name: </label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ old('group_name') }}" required name="group_name" class="form-control" placeholder="Group Name">
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="{{ route('permission_groups.index') }}" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับ</a>
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> บันทึก</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </div>
</div>

@endsection