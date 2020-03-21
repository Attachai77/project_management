<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-teal elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
    <img src="/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">ระบบจัดการโครงการ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @php $img_url = \App\Helpers\GetBy::getProfileImgByUSerId(Auth::user()->id) @endphp
            <img src="{{$img_url}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block"> {{ Auth::user()->first_name.' '.Auth::user()->last_name }} </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="/" class="nav-link {{ Request::is('/') || Request::is('home') ? 'active' : '' }}">
            <i class="fas fa-home nav-icon"></i>
            <p> หน้าแรก</p>
            </a>
        </li>

        @can('project-checking-list')
        <li class="nav-item">
            <a href="{{route('projectChecking')}}" class="nav-link 
            {{ 
                Route::currentRouteName()=='projectChecking' 
            ? 'active' : '' }}"
            ">
            <i class="fas fa-pen-square nav-icon"></i>
            <p> โครงการรอตรวจสอบ <span class="right badge badge-warning">
                {{ \App\Helpers\Project::countProjectCheckingAdviser() }}
            </span></p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('projectRequestDone')}}" class="nav-link 
            {{ 
                Route::currentRouteName()=='projectRequestDone' 
            ? 'active' : '' }}"
            ">
            <i class="fas fa-pen nav-icon"></i>
            <p> สรุป / รอปิดโครงการ <span class="right badge badge-warning">
                {{ \App\Helpers\Project::countProjectRequestDone() }}
            </span></p>
            </a>
        </li>
        @endcan

        @can('create-project')
        <li class="nav-item">
            <a href="{{ route('projects.create') }}" class="nav-link {{ Request::is('projects/create') ? 'active' : '' }}">
            <i class="fas fa-plus nav-icon"></i>
            <p> สร้างโครงการ</p>
            </a>
        </li>
        @endcan

        @can('your-project-list')
        <li class="nav-item  has-treeview {{ 
                Request::is('my_projects/*')  
            ? 'menu-open' : '' }}">
            <a href="#" class="nav-link 
            {{ 
                Request::is('my_projects/*')  
            ? 'active' : '' }}">
                <i class="fas fa-archive nav-icon"></i>
                <p> โครงการของคุณ
                <i class="right fas fa-angle-left"></i> 
                <span class="badge badge-info ml-1" style="">
                    {{ \App\Helpers\Project::countAllMyProjectOfficer() }}
                </span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('my_projects','pending') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'pending'
                    ? 'active open' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p class="bg-secondary project-status-menu">โครงการร่าง
                        <span class="badge badge-secondary right" style="">
                            {{ \App\Helpers\Project::countMyProjectOfficerByStatus(0) }}
                        </span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','checking') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'checking'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p class="bg-pink project-status-menu">รอตรวจสอบ
                        <span class="badge badge-pink right" style="">
                            {{ \App\Helpers\Project::countMyProjectOfficerByStatus(1) }}
                        </span>
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','plan') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'plan'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p class="bg-info project-status-menu">วางแผน
                        <span class="badge badge-info right" style="">
                            {{ \App\Helpers\Project::countMyProjectOfficerByStatus(2) }}
                        </span>
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','inprogress') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'inprogress'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p class="bg-warning project-status-menu">กำลังดำเนินการ
                        <span class="badge badge-warning right" style="">
                            {{ \App\Helpers\Project::countMyProjectOfficerByStatus(3) }}
                        </span>
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','reject') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'reject'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p class="bg-danger project-status-menu">โครงการตีกลับ
                        <span class="badge badge-danger right" style="">
                            {{ \App\Helpers\Project::countMyProjectOfficerByStatus(6) }}
                        </span>
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','request_done') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'request_done'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p class="bg-primary project-status-menu">สรุป / รอปิดโครงการ
                        <span class="badge badge-primary right" style="">
                            {{ \App\Helpers\Project::countMyProjectOfficerByStatus(7) }}
                        </span>
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','success') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'success'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p class="bg-success project-status-menu">โครงการที่ปิดแล้ว
                        <span class="badge badge-success right" style="">
                            {{ \App\Helpers\Project::countMyProjectOfficerByStatus(4) }}
                        </span>
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','cancel') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'cancel'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p class="bg-secondary project-status-menu">โครงการที่ยกเลิก
                        <span class="badge badge-secondary right" style="">
                            {{ \App\Helpers\Project::countMyProjectOfficerByStatus(5) }}
                        </span>
                    </p>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('project-list')
        <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link 
            {{ 
                Route::currentRouteName()=='projects.index' ||
                Route::currentRouteName()=='projects.show' ||
                Route::currentRouteName()=='projects.edit' || 
                Route::currentRouteName()=='projects.projectMember' 
            ? 'active' : '' }}"
            >
            <i class="fas fa-list-alt nav-icon"></i>
            <p> โครงการทั้งหมด<span class="right badge badge-warning">
                {{ \App\Helpers\Project::countAllProjectAdviser() }}
            </span></p>
            </a>
        </li>
        @endcan

        @can('your-task-list')
        <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link">
            <i class="fas fa-tasks nav-icon"></i>
            <p> กิจกรรมของคุณ<span class="right badge badge-danger">14</span></p>
            </a>
        </li>
        @endcan

        @canAny(['user-list','role-list','project-position-list'])
        <li class="nav-item has-treeview {{ Request::is('users','users/*','roles','roles/*','project_positions','project_positions/*')? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ Request::is('users','users/*','roles','roles/*','project_positions','project_positions/*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>จัดการระบบ<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                @can('user-list')
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users','users/*')  ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>ข้อมูลผู้ใช้งาน</p>
                    </a>
                </li>
                @endcan
                @can('role-list')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles','roles/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>ข้อมูลกลุ่มบทบาท</p>
                    </a>
                </li>
                @endcan
                <!-- @can('project-position-list')
                <li class="nav-item">
                    <a href="{{ route('project_positions.index') }}" class="nav-link {{ Request::is('project_positions','project_positions/*') ? 'active' : '' }}">
                    <i class="fas fa-archive nav-icon"></i>
                    <p> ข้อมูลตำแหน่งโครงการ</p>
                    </a>
                </li>
                @endcan -->
            </ul>
        </li>
        @endcan

        @if(Auth::user()->username === 'master')
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>สำหรับ Dev<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('permission_groups.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>Permissions Group</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permissions.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>Permissions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('clear') }}" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>Clear Cash</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        <li class="nav-item">

            <!-- <a class="nav-link" href="javascript:void(0)"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" 
            >
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>ออกจากระบบ</p>
            </a> -->
            <a class="nav-link" href="javascript:void(0)" onCLick="logOut()">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>ออกจากระบบ</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
function logOut(){
    Swal.fire({
        title: 'ต้องการออกจากระบบใช่หรือไม่?',
        text: '...',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่ใช่'
        }).then((result) => {
            if (result.value) {
                $('#logout-form').submit();
            } 
    })
}
</script>


<style>
.project-status-menu{
    border-radius: .25rem; 
    padding: .25rem!important;
}
.alert-pink, .bg-pink, .badge-pink {
    background-color: #FFAE9E!important;
}
</style>