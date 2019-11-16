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
                    <h3 class="card-title">กรอกข้อมูลผู้ใช้งาน</h3>
                </div>
                <form method="POST" action="/users/{{ $user->id }}" class="form-horizontal">
                    @csrf
                    {{ method_field('PATCH') }}
                    <div class="card-body">

                        <h6 class="text-right"><b><i>#ข้อมูลทั่วไป</i></b></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อ :</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ $user->first_name }}" required name="first_name" class="form-control" placeholder="ชื่อ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">นามสกุล :</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ $user->last_name }}" name="last_name" class="form-control" placeholder="นามสกุล">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">อีเมล :</label>
                            <div class="col-sm-6">
                                <input type="email" value="{{ $user->email }}" name="email" class="form-control" placeholder="อีเมล">
                            </div>
                        </div>
                        <hr>

                        <h6 class="text-right"><b><i>#ข้อมูลการเข้าใช้ระบบ</i></b></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">ชื่อผู้ใช้งาน :</label>
                            <div class="col-sm-6">
                                <input type="text" value="{{ $user->username }}" disabled name="username" class="form-control" placeholder="ชื่อ">
                            </div>
                        </div>
                        <hr>

                        <h6 class="text-right"><b><i>#สิทธิ์การใช้งานระบบ</i></b></h6>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label">บทบาท (Role) :</label>
                            <div class="col-sm-6">
                                <!-- <select name="role_id" id="role_id" class="form-control"> -->
                                @foreach($roles as $role_id => $role_name)

                                    @if(in_array($role_id , $user_roles))
                                        @php $beRole = "checked"; @endphp
                                    @else
                                        @php $beRole = ""; @endphp
                                    @endif
                                    <input type="checkbox" name="role_id[]" value="{{ $role_id }}" id="" {{$beRole}}>
                                    <label for="control-label">{{ $role_name }}</label>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">บันทึก</button>
                        <a href="{{ route('users.index') }}" class="btn btn-default float-right">ยกเลิก / กลับหน้ารายชื่อ</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>

        </div>
    </div>
</div>


@endsection