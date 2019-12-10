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
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="/" class="nav-link {{ Request::is('/') || Request::is('home') ? 'active' : '' }}">
            <i class="fas fa-home nav-icon"></i>
            <p> หน้าแรก</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('projects.create') }}" class="nav-link {{ Request::is('projects/create') ? 'active' : '' }}">
            <i class="fas fa-plus nav-icon"></i>
            <p> สร้างโครงการ</p>
            </a>
        </li>

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
            <p> โครงการทั้งหมด<span class="right badge badge-info">43</span></p>
            </a>
        </li>

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
                <span class="badge badge-warning ml-1" style="">7</span>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('my_projects','pending') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'pending'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>โครงการร่าง</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','checking') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'checking'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>รอตรวจสอบ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','plan') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'plan'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>วางแผน</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','inprogress') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'inprogress'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>กำลังดำเนินการ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','reject') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'reject'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>โครงการตีกลับ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('my_projects','success') }}" class="nav-link {{ 
                        Request::is('my_projects','*') &&
                        Route::current()->parameter('status') === 'success'
                    ? 'active open' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>โครงการที่ปิดแล้ว</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link">
            <i class="fas fa-tasks nav-icon"></i>
            <p> กิจกรรมของคุณ<span class="right badge badge-danger">14</span></p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>จัดการระบบ<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>ข้อมูลผู้ใช้งาน</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>ข้อมูลกลุ่มบทบาท</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('project_positions.index') }}" class="nav-link">
                    <i class="fas fa-archive nav-icon"></i>
                    <p> ข้อมูลตำแหน่งโครงการ</p>
                    </a>
                </li>
            </ul>
        </li>

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
            </ul>
        </li>

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
        confirmButtonText: 'ไช่',
        cancelButtonText: 'ไม่ไช่'
        }).then((result) => {
            if (result.value) {
                $('#logout-form').submit();
            } 
    })
}
</script>