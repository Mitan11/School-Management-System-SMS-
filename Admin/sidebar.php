<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="../logout.php" class="nav-link" title="Logout">Logout &nbsp;<i class="fa fa-sign-out-alt"></i></a>
        </li>
    </ul>

</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $site_url ?>" class="brand-link">
        <img src="../Assets/imgs/GFA Logo.png" alt="" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= $site_url ?>Admin/dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Manage Accounts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/user-accounts.php?user=teacher" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Teachers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/user-accounts.php?user=student" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Parents</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/user-accounts.php?user=parent" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Parents</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/user-accounts.php?user=librarian" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Librarian</p>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>
                            Manage Classes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/sections.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sections</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/classes.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Classes</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/courses.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Courses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/subject.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subjects</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/lessions.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lessions</p>
                            </a>
                        </li> -->
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Manage Class Routines
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/periods.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Periods</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/tt.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Time Table</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Manage Attendants
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/attendance.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendants</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>
                            Manage Accounting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/student-fee.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student Fees Details</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-solid fa-image"></i>
                        <p>
                            Event Gallery 
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Admin/Image-Gallery.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Image Gallery</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">