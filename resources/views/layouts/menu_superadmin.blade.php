<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/beranda" class="nav-link {{Request::is('beranda') ? 'active' : ''}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    BERANDA
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/slideshow" class="nav-link {{Request::is('slideshow*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    SLIDESHOW
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/link" class="nav-link {{Request::is('link*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    LINK
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/kategori" class="nav-link {{Request::is('kategori*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    KATEGORI
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/pegawai" class="nav-link {{Request::is('pegawai*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    PEGAWAI
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/data/masuk" class="nav-link {{Request::is('data/masuk*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    DATA MASUK
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/data/keluhanwa" class="nav-link {{Request::is('data/keluhanwa*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    KELUHAN WA BOT
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/berita" class="nav-link {{Request::is('berita*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    BERITA
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/profil" class="nav-link {{Request::is('profil*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    PROFIL
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/tentang" class="nav-link {{Request::is('tentang*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    TENTANG APP
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/kontak" class="nav-link {{Request::is('kontak*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    KONTAK
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/laporan" class="nav-link {{Request::is('laporan*') ? 'active' : ''}}">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    LAPORAN
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