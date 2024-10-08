<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a href="../logout.php" class="nav-link" title="Logout">Logout &nbsp;<i class="fa fa-sign-out-alt"></i></a>
        </li>
    </ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $site_url ?>" class="brand-link">
        <img src="../Assets/imgs/GFA Logo.png" alt="" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php print_r(get_users(array('id' => $std_id))[0]->name); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= $site_url ?>Student/dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Class Routines
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Student/tt.php" class="nav-link">
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
                            <a href="<?= $site_url ?>Student/attendance.php" class="nav-link">
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
                            Fee details
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Student/fee-details.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fee Details</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-file"></i>
                        <p>
                            Study material
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="<?= $site_url ?>Student/study-materials.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Classes</p>
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
                            <a href="<?= $site_url ?>Student/Image-Gallery.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Image Gallery</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

    </div>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">