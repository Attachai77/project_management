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
                <form method="POST" action="{{ route('permissions.update',$permission->id) }}" class="form-horizontal">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Name: </label>
                            <div class="col-sm-6">
                                <input type="text" disabled value="{{ $permission->name }}" required name="name" class="form-control">
                                <span style="color:red;">Can not change this</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Description: </label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ $permission->description }}" required name="description" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label">Group: </label>
                            <div class="col-sm-6">
                                <select name="permission_group_id" class="form-control" >
                                    @foreach($permission_groups as $group_id => $group_name)
                                    
                                    @if($group_id == $permission->permission_group_id)
                                        @php $selected = "selected" @endphp
                                    @else 
                                        @php $selected = "" @endphp
                                    @endif

                                    <option value="{{$group_id}}" {{$selected}}>{{$group_name}}</option>
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