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
        <img src="/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block"> {{ Auth::user()->username }} </a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="/" class="nav-link active">
            <i class="fas fa-home nav-icon"></i>
            <p> หน้าแรก</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('projects.create') }}" class="nav-link">
            <i class="fas fa-plus nav-icon"></i>
            <p> สร้างโครงการ</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link">
            <i class="fas fa-list-alt nav-icon"></i>
            <p> โครงการทั้งหมด<span class="right badge badge-info">43</span></p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('my_projects') }}" class="nav-link">
            <i class="fas fa-archive nav-icon"></i>
            <p> โครงการของคุณ<span class="right badge badge-warning">7</span></p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('projects.index') }}" class="nav-link">
            <i class="fas fa-bars nav-icon"></i>
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

            <a class="nav-link" href="javascript:void(0)"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" 
            >
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
                ออกจากระบบ
            </p>
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