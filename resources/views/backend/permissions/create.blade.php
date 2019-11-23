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
                    <h3 class="card-title"><i class="fa fa-plus"></i> Add Permission</h3>
                </div>
                <form method="POST" action="{{ route('permissions.store') }}" class="form-horizontal">
                    @csrf
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Name: </label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ old('name') }}" required name="name" class="form-control" placeholder="Name">
                                <span style="color:red;">Example: create-user , delete-role</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Description: </label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ old('description') }}" required name="description" class="form-control" placeholder="Description">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Group: </label>
                            <div class="col-sm-6">
                                <select name="permission_group_id" class="form-control" >
                                    @foreach($permission_groups as $group_id => $group_name)
                                    <option value="{{$group_id}}">{{$group_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        

                    </div>

                    <div class="card-footer">
                        <a href="{{ route('permissions.index') }}" class="btn btn-default"><i class="fa fa-angle-left"></i> ยกเลิก / กลับ</a>
                        <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> บันทึก</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </div>
</div>

@endsection