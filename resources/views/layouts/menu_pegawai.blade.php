<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/pegawai" class="nav-link {{Request::is('pegawai') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    BERANDA
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/gantipassword" class="nav-link {{Request::is('gantipassword*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    GANTI PASSWORD
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    LOGOUT
                </p>
            </a>
        </li>
    </ul>
</nav>