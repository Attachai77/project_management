@extends('layouts.master')

@section('content')

<style>
    .btn-40{
        width: 40px !important;
    }
</style>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User List</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th style="width: 10px">No.</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th style="width: 200px">Actions</th>
                    </tr>

                    @foreach($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id ) }}" class="btn btn-40 btn-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('users.show', $user->id ) }}" class="btn btn-40 btn-success">
                                <i class="fa fa-check"></i>
                            </a>
                            <a href="{{ route('users.edit', $user->id ) }}" class="btn btn-40 btn-warning">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="{{ route('users.show', $user->id ) }}" class="btn btn-40 btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>
            <!-- /.card-body -->

            <div class="card-footer clearfix">
                {{ $users->appends(request()->except('page'))->links() }}
            </div>

        </div>
        <!-- /.card -->
  
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <a href="{{ route('users.create') }}" class="btn btn-outline-success">
            <i class="fa fa-user-plus"></i> New User
        </a>
    </div>
</div>


@endsection