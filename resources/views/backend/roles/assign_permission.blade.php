@extends('layouts.adminlte')

@section('content')



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cog"></i> เลือกสิทธิ์การใช้งาน
                </h3>
            </div>
            
            <form action="{{ route('roles.assignPermission',$role->id) }}" method="POST">

            <!-- /.card-header -->
            <div class="card-body">
                @csrf

                <label for=""># ชื่อกลุ่ม : </label>
                <span>{{ $role->display_name }}</span>
                <br><br>

                <label for=""># สิทธิ์การใช้งาน </label>
                <ol type="1">
                    @foreach($permission_groups as $key => $permission_group)
                    <b>
                    <li>
                    <input type="checkbox" class="checkALl" data-id="{{$permission_group->id}}"> 
                    {{ $permission_group->group_name }}
                    </li>
                    </b>

                    <ul style="list-style-type:circle;">
                        @foreach($permission_group->permissions as $key => $permission)

                        @if(\App\Helpers\Permission::checkRoleIdHasPermissionId($role->id, $permission->id))
                            @php $checked = "checked" @endphp
                        @else
                            @php $checked = "" @endphp
                        @endif
                        <li><input type="checkbox" class="group_{{$permission_group->id}}" {{$checked}} name="permission_id[]" value="{{$permission->id}}"> {{$permission->description}}</li>
                        @endforeach
                    </ul>
                    @endforeach
                </ol>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('roles.index') }}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i> กลับ
                </a>
                <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> บันทึกสิทธิ์</button>
            </div>

            </form>

        </div>
        <!-- /.card -->
    </div>
</div>

<script>
$(".checkALl").on('click',function(){
    var id = $(this).data('id');
    if($(this).prop("checked")){
        $('.group_'+id).prop('checked', true);
    }else{
        $('.group_'+id).prop('checked', false);
    }
});
</script>


@endsection