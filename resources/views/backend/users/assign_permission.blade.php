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
            
            <form action="{{ route('users.assign_permission',$user->id) }}" method="POST">

            <!-- /.card-header -->
            <div class="card-body">
                @csrf

                <label for=""># กำหนดสิทธิ์เพิ่มเติมให้กับ : </label>
                <span class="username bold">
                    <a href="#"><b>{{ $user->first_name.' '.$user->last_name }}</b></a>
                </span>
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

                        @if(\App\Helpers\Permission::checkUserIdHasPermissionId($user->id, $permission->id))
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
                <h6 class="description">#คำอธิบาย : การกำหนดสิทธิ์เพิ่มเติมให้ผู้ใช้ จะแยกส่วนสิทธิ์การใช้งานกับบทบาทผู้ใช้ ซึ่งสิทธิ์เพิ่มเติมจะเป็นสิทธิ์เพิ่มเข้ามาจากสิทธิ์บทบาทของผู้ใช้นั้น ๆ</h6>
                <a href="{{ route('users.index') }}" class="btn btn-default">
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