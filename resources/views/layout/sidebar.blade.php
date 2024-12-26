<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?= url('assets/onedash') ?>/images/logo.png" class="logo-icon me-2" alt="logo icon"
                style="width: 35px">
        </div>
        <div>
            <h5 class="logo-text text-dark">YBM</h5>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-list"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        {{-- Role Admin --}}
        @if (session('role') == 'admin')
            <li class="{{ Request::is('admin/dashboard*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/dashboard') ?>">
                    <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/user*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/user') ?>">
                    <div class="parent-icon"><i class="bi bi-person-circle"></i></div>
                    <div class="menu-title">User</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/rkat*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/rkat') ?>">
                    <div class="parent-icon"><i class="bi bi-clipboard-data"></i></div>
                    <div class="menu-title">RKAT</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/kecamatan*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/kecamatan') ?>">
                    <div class="parent-icon"><i class="bi bi-map"></i></div>
                    <div class="menu-title">Kecamatan</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/proposal*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/proposal') ?>">
                    <div class="parent-icon"><i class="bi bi-file-earmark-text"></i></div>
                    <div class="menu-title">Proposal</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/penyaluran_zis*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/penyaluran_zis') ?>">
                    <div class="parent-icon"><i class="bi bi-hand-thumbs-up"></i></div>
                    <div class="menu-title">Penyaluran ZIS</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/mitra*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/mitra') ?>">
                    <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div class="menu-title">Mitra</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/keuangan*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/keuangan') ?>">
                    <div class="parent-icon"><i class="bi bi-wallet2"></i></div>
                    <div class="menu-title">Keuangan</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/donatur*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/donatur') ?>">
                    <div class="parent-icon"><i class="bi bi-person-check"></i></div>
                    <div class="menu-title">Donatur</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/pendanaan*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/pendanaan') ?>">
                    <div class="parent-icon"><i class="bi bi-cash-stack"></i></div>
                    <div class="menu-title">Pendanaan</div>
                </a>
            </li>
            <li class="{{ Request::is('admin/acara-kegiatan*') ? 'mm-active' : '' }}">
                <a href="<?= url('admin/acara-kegiatan') ?>">
                    <div class="parent-icon"><i class="bi bi-calendar-event"></i></div>
                    <div class="menu-title">Acara dan Kegiatan</div>
                </a>
            </li>
        @endif

        {{-- Role Ketua --}}
        @if (session('role') == 'ketua')
            <li class="{{ Request::is('ketua/dashboard*') ? 'mm-active' : '' }}">
                <a href="<?= url('ketua/dashboard') ?>">
                    <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="{{ Request::is('ketua/user*') ? 'mm-active' : '' }}">
                <a href="<?= url('ketua/user') ?>">
                    <div class="parent-icon"><i class="bi bi-person-circle"></i></div>
                    <div class="menu-title">User</div>
                </a>
            </li>
            <li class="{{ Request::is('ketua/rkat*') ? 'mm-active' : '' }}">
                <a href="<?= url('ketua/rkat') ?>">
                    <div class="parent-icon"><i class="bi bi-clipboard-data"></i></div>
                    <div class="menu-title">RKAT</div>
                </a>
            </li>
            <li class="{{ Request::is('ketua/kecamatan*') ? 'mm-active' : '' }}">
                <a href="<?= url('ketua/kecamatan') ?>">
                    <div class="parent-icon"><i class="bi bi-map"></i></div>
                    <div class="menu-title">Kecamatan</div>
                </a>
            </li>
            <li class="{{ Request::is('ketua/proposal*') ? 'mm-active' : '' }}">
                <a href="<?= url('ketua/proposal') ?>">
                    <div class="parent-icon"><i class="bi bi-file-earmark-text"></i></div>
                    <div class="menu-title">Proposal</div>
                </a>
            </li>
            <li class="{{ Request::is('ketua/penyaluran_zis*') ? 'mm-active' : '' }}">
                <a href="<?= url('ketua/penyaluran_zis') ?>">
                    <div class="parent-icon"><i class="bi bi-hand-thumbs-up"></i></div>
                    <div class="menu-title">Penyaluran ZIS</div>
                </a>
            </li>
            <li class="{{ Request::is('ketua/acara-kegiatan*') ? 'mm-active' : '' }}">
                <a href="<?= url('ketua/acara-kegiatan') ?>">
                    <div class="parent-icon"><i class="bi bi-calendar-event"></i></div>
                    <div class="menu-title">Acara dan Kegiatan</div>
                </a>
            </li>
        @endif

        {{-- Role Distribusi --}}
        @if (session('role') == 'distribusi')
            <li class="{{ Request::is('distribusi/dashboard*') ? 'mm-active' : '' }}">
                <a href="<?= url('distribusi/dashboard') ?>">
                    <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="{{ Request::is('distribusi/proposal*') ? 'mm-active' : '' }}">
                <a href="<?= url('distribusi/proposal') ?>">
                    <div class="parent-icon"><i class="bi bi-file-earmark-text"></i></div>
                    <div class="menu-title">Proposal</div>
                </a>
            </li>
            <li class="{{ Request::is('distribusi/penyaluran_zis*') ? 'mm-active' : '' }}">
                <a href="<?= url('distribusi/penyaluran_zis') ?>">
                    <div class="parent-icon"><i class="bi bi-hand-thumbs-up"></i></div>
                    <div class="menu-title">Penyaluran ZIS</div>
                </a>
            </li>
            <li class="{{ Request::is('distribusi/mitra*') ? 'mm-active' : '' }}">
                <a href="<?= url('distribusi/mitra') ?>">
                    <div class="parent-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div class="menu-title">Mitra</div>
                </a>
            </li>
        @endif

        {{-- Role Bendahara --}}
        @if (session('role') == 'bendahara')
            <li class="{{ Request::is('bendahara/dashboard*') ? 'mm-active' : '' }}">
                <a href="<?= url('bendahara/dashboard') ?>">
                    <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="{{ Request::is('bendahara/penyaluran_zis*') ? 'mm-active' : '' }}">
                <a href="<?= url('bendahara/penyaluran_zis') ?>">
                    <div class="parent-icon"><i class="bi bi-hand-thumbs-up"></i></div>
                    <div class="menu-title">Penyaluran ZIS</div>
                </a>
            </li>
            <li class="{{ Request::is('bendahara/keuangan*') ? 'mm-active' : '' }}">
                <a href="<?= url('bendahara/keuangan') ?>">
                    <div class="parent-icon"><i class="bi bi-wallet2"></i></div>
                    <div class="menu-title">Keuangan</div>
                </a>
            </li>
        @endif

        {{-- Role Publikasi --}}
        @if (session('role') == 'publikasi')
            <li class="{{ Request::is('publikasi/dashboard*') ? 'mm-active' : '' }}">
                <a href="<?= url('publikasi/dashboard') ?>">
                    <div class="parent-icon"><i class="bi bi-house-door"></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li class="{{ Request::is('publikasi/penyaluran_zis*') ? 'mm-active' : '' }}">
                <a href="<?= url('publikasi/penyaluran_zis') ?>">
                    <div class="parent-icon"><i class="bi bi-hand-thumbs-up"></i></div>
                    <div class="menu-title">Penyaluran ZIS</div>
                </a>
            </li>
            <li class="{{ Request::is('publikasi/donatur*') ? 'mm-active' : '' }}">
                <a href="<?= url('publikasi/donatur') ?>">
                    <div class="parent-icon"><i class="bi bi-person-check"></i></div>
                    <div class="menu-title">Donatur</div>
                </a>
            </li>
            <li class="{{ Request::is('publikasi/pendanaan*') ? 'mm-active' : '' }}">
                <a href="<?= url('publikasi/pendanaan') ?>">
                    <div class="parent-icon"><i class="bi bi-cash-stack"></i></div>
                    <div class="menu-title">Pendanaan</div>
                </a>
            </li>
            <li class="{{ Request::is('publikasi/acara-kegiatan*') ? 'mm-active' : '' }}">
                <a href="<?= url('publikasi/acara-kegiatan') ?>">
                    <div class="parent-icon"><i class="bi bi-calendar-event"></i></div>
                    <div class="menu-title">Acara dan Kegiatan</div>
                </a>
            </li>
        @endif
    </ul>


    <!--end navigation-->
</aside>
<!--end sidebar -->
