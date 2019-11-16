@extends('layouts.master', ['title' => 'Create User Form'])

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

{{-- {!! Form::open(['url' => 'users/store']) !!} --}}
{{-- {!! Form::open(['route' => 'users.store']) !!} --}}
{{-- {!! Form::open(['action' => 'UsersController@store']) !!} --}}
{!! Form::open(['action' => 'UsersController@store']) !!}

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user"></i> User Information</h3>
            </div>

            <div class="card-body">

                <div class="form-group row">
                    <label class="col-md-2 col-sm-12 control-label">First Name :</label>
                    <div class="col-md-4 col-sm-12">
                        {{ Form::text('first_name',NULL,['class'=>'form-control','placeholder'=>'First Name']) }}
                    </div>
                    <label class="col-md-2 col-sm-12 control-label">Last Name :</label>
                    <div class="col-md-4 col-sm-12">
                        {{ Form::text('last_name',NULL,['class'=>'form-control','placeholder'=>'Last Name']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-sm-12 control-label">E-Mail :</label>
                    <div class="col-md-4 col-sm-12">
                        {{ Form::text('email',NULL,['class'=>'form-control','placeholder'=>'E-Mail']) }}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-lock"></i> Login</h3>
            </div>

            <div class="card-body">

                <div class="form-group row">
                    <label class="col-md-2 col-sm-12 control-label">Username :</label>
                    <div class="col-md-4 col-sm-12">
                        {{ Form::text('username',NULL,['class'=>'form-control','placeholder'=>'Username']) }}
                    </div>
                    <label class="col-md-2 col-sm-12 control-label">Password :</label>
                    <div class="col-md-4 col-sm-12">
                        {{ Form::password('password',['class'=>'form-control','placeholder'=>'Password']) }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-sm-12 control-label">Password Confiirm :</label>
                    <div class="col-md-4 col-sm-12">
                        {{ Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Password Confiirm']) }}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <i class="fa fa-users"></i> Role</h3>
            </div>

            <div class="card-body">

                <div class="form-group row">
                    <label class="col-md-2 col-sm-12 control-label">Role :</label>
                    <div class="col-md-4 col-sm-12">
                        @foreach(\App\Role::getRoleList() as $role_id => $role_name)
                            <p>
                                {{ Form::checkbox('role_id[]', $role_id , false ,[
                                    'class'=>''
                                ]) }}
                                <span>{{ $role_name }}</span>
                            </p>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <a href="{{ URL::previous() }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Create</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>

@endsection