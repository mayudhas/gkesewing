<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow navbar-dark bg-primary">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="moon"></i>
                </a>
            </li>
            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder"><?= \App\Helpers\CookieHelper::getCookie()->user_name ?></span>
                        <span class="user-status"><?= \App\Helpers\CookieHelper::getCookie()->user_level_id == 1 ? 'Administrator' : (\App\Helpers\CookieHelper::getCookie()->user_level_id == 2 ? 'Pegawai' : '') ?></span>
                    </div>
                    <span class="avatar">
                        <img class="round" src="<?= base_url('app-assets/images/portrait/small/default.png') ?>"
                             alt="avatar" height="40" width="40">
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="page-profile.html">
                        <i class="me-50" data-feather="user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="<?= site_url('/'); ?>">
                        <i class="me-50" data-feather="power"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>