@extends('layouts.adminlte')

@section('content')

<style>
.info-box .info-box-number {
    font-size: 24px;
}
.project{
  cursor: pointer;
}
.users-list>li {
    width: 33.3333%;
}
</style>

<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">

        <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-warning   elevation-1">
                  <i class="fas fa-tasks"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">กำลังดำเนินการ</span>
                    <span class="info-box-number">2</span>
                </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1">
                <i class="nav-icon far fa-calendar-alt"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">กำลังวางแผน</span>
                    <span class="info-box-number">21</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success  elevation-1">
                <i class="fas fa-calendar-check"></i>
                </span>

                <div class="info-box-content">
                    <span class="info-box-text">โครงการที่ปิดแล้ว</span>
                    <span class="info-box-number">20</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1">
                <i class="fas fa-list-alt"></i>
              </span>

                <div class="info-box-content">
                    <span class="info-box-text">โครงการทั้งหมด</span>
                    <span class="info-box-number">43</span>
                </div>
            </div>
        </div>

        
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">#โครงการที่อยู่ในช่วงดำเนินการ</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive table-hover">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>#โครงการ</th>
                      <th>#ความคืบหน้า</th>
                      <th>#เจ้าของโครงการ</th>
                      <th>#สมาชิก</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($projects as $key => $project)
                      <tr class="project">
                          <td>{{ ++$key }}</td>
                          <td>{{ $project->project_name }}</td>                          
                          <td>
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-teal" role="progressbar" aria-volumenow="57" aria-volumemin="0" aria-volumemax="100" style="width: 57%">
                            </div>
                          </td>
                          <td>{{ \App\User::getFullnameById($project->project_owner_id) }}</td>  
                          <td>10 คน</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">ดูทั้งหมด</a>
              </div>
              <!-- /.card-footer -->
            </div>
        </div>
        <div class="col-md-3">
            <!-- USERS LIST -->
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">สมาชิก</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                    </button>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="users-list clearfix">
                      <li>
                      <img src="/img/user1-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander Pierce</a>
                      <span class="users-list-date">Today</span>
                      </li>
                      <li>
                      <img src="/img/user8-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Norman</a>
                      <span class="users-list-date">Yesterday</span>
                      </li>
                      <li>
                      <img src="/img/user7-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Jane</a>
                      <span class="users-list-date">12 Jan</span>
                      </li>
                      <li>
                      <img src="/img/user6-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">John</a>
                      <span class="users-list-date">12 Jan</span>
                      </li>
                      <li>
                      <img src="/img/user2-160x160.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Alexander</a>
                      <span class="users-list-date">13 Jan</span>
                      </li>
                      <li>
                      <img src="/img/user5-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Sarah</a>
                      <span class="users-list-date">14 Jan</span>
                      </li>
                      <li>
                      <img src="/img/user4-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nora</a>
                      <span class="users-list-date">15 Jan</span>
                      </li>
                      <li>
                      <img src="/img/user3-128x128.jpg" alt="User Image">
                      <a class="users-list-name" href="#">Nadia</a>
                      <span class="users-list-date">15 Jan</span>
                      </li>
                  </ul>
                </div>
                <div class="card-footer text-center">
                <a href="javascript::">View All Users</a>
                </div>
            </div>
        </div>
    </div>

</div>
<br>


<button onclick="sw()">kkk</button>

<script>
function sw(){
    sweetAlertError("Error!",'kkkkkk','ปิด');
}
</script>




@endsection