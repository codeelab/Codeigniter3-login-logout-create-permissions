<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= base_url('home') ?>">Dashboard</a>
    </div> <!-- END nav-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <?php if (isset($_SESSION['logged_in']) === TRUE) { ?>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?= $_SESSION['username']; ?> <i class="fa fa-caret-down"></i>
                </a> <!-- END dropdown-toggle -->
                <ul class="dropdown-menu dropdown-user">

                    <li><a href="<?= base_url('home') ?>"><i class="fa fa-home fa-fw"></i> Home</a></li>

                    <li class="divider"></li>
                    <li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>

                </ul> <!-- END dropdown-menu -->
            <?php } else {?>
                <a class="menu-toggle" href="<?= base_url('login') ?>">
                    <i class="fa fa-sign-in fa-fw"></i></i>
                </a> <!-- END dropdown-toggle -->
            <?php } ?>
        </li> <!-- END dropdown -->
    </ul><!-- END navbar-top-links navbar-right -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?= base_url('home') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                     <a href="<?= base_url('admin') ?>"><i class="fa fa-cog fa-fw"></i> Admin</a>
                </li>
               
            </ul> <!-- side-menu -->
        </div> <!-- END sidebar-nav -->
    </div> <!-- END sidebar -->
</nav>