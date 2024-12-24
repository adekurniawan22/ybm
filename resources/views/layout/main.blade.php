<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= url('assets/onedash') ?>/images/icon.png" type="image/jpg" />

    <!--plugins-->
    <link href="<?= url('assets/onedash') ?>/plugins/notifications/css/lobibox.min.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="<?= url('assets/onedash') ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/css/style.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <!-- loader-->
    <link href="<?= url('assets/onedash') ?>/css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="<?= url('assets/onedash') ?>/css/dark-theme.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/css/light-theme.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/css/semi-dark.css" rel="stylesheet" />
    <link href="<?= url('assets/onedash') ?>/css/header-colors.css" rel="stylesheet" />
    @yield('style')

    <title>{{ $title }}</title>
</head>

<body>

    @php
        use App\Models\User;

        // Ambil data user berdasarkan user_id dari session dengan relasi role
        $user = User::where('user_id', session('user_id'))->first();

    @endphp

    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3">
                <div class="mobile-toggle-icon fs-3 d-flex d-lg-none">
                    <i class="bi bi-list"></i>
                </div>

                <div class="top-navbar-right ms-auto">
                </div>
                <div class="dropdown dropdown-user-setting">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center gap-3">
                            <img src="<?= url('assets/onedash') ?>/images/avatars/user_profil.png" class="user-img"
                                alt="">
                            <div class="d-none d-sm-block">
                                <p class="user-name mb-0">{{ $user->nama }}</p>
                                <small
                                    class="mb-0 dropdown-user-designation">{{ ucwords(str_replace('_', ' ', strtolower($user->role))) }}</small>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmLogout">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="fadeIn animated bx bx-log-out"></i></div>
                                    <div class="ms-3"><span>Logout</span></div>
                                </div>
                            </button>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->

        @include('layout.sidebar')

        @yield('content')

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirm-delete" class="btn btn-success">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Logout -->
        <div class="modal fade" id="confirmLogout" tabindex="-1" aria-labelledby="confirmLogoutLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmLogoutLabel">Konfirmasi Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin keluar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="{{ route('logout') }}" type="button" id="confirm-delete"
                            class="btn btn-success">Ya</a>
                    </div>
                </div>
            </div>
        </div>

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--start footer-->
        <footer class="footer">
            <strong>YBM</strong>
        </footer>
        <!--end footer-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

    </div>
    <!--end wrapper-->

    <!-- Load jQuery first -->
    <script src="<?= url('assets/onedash') ?>/js/jquery.min.js"></script>

    <!--notification js -->
    <script src="<?= url('assets/onedash') ?>/plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?= url('assets/onedash') ?>/plugins/notifications/js/notifications.min.js"></script>
    <script src="<?= url('assets/onedash') ?>/plugins/notifications/js/notification-custom-script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Notification Success
            @if (session()->has('success'))
                function notifSuccess() {
                    Lobibox.notify('success', {
                        title: 'Berhasil',
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'bx bx-check-circle',
                        msg: '{{ session('success') }}'
                    });
                }
                notifSuccess();
            @endif

            // Notification Info
            @if (session()->has('info'))
                function notifSuccess() {
                    Lobibox.notify('info', {
                        title: 'Info',
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'bx bx-check-circle',
                        msg: '{{ session('info') }}'
                    });
                }
                notifSuccess();
            @endif

            // Notification Error
            @if (session()->has('error'))
                function notifError() {
                    Lobibox.notify('error', {
                        title: 'Gagal',
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'bx bx-x-circle',
                        msg: '{{ session('error') }}'
                    });
                }
                notifError();
            @endif
        });
    </script>

    <!-- Bootstrap bundle JS -->
    <script src="<?= url('assets/onedash') ?>/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= url('assets/onedash') ?>/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= url('assets/onedash') ?>/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= url('assets/onedash') ?>/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?= url('assets/onedash') ?>/plugins/select2/js/select2.min.js"></script>
    <script src="<?= url('assets/onedash') ?>/js/form-select2.js"></script>

    {{-- DataTables --}}
    <script src="<?= url('assets/onedash') ?>/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?= url('assets/onedash') ?>/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= url('assets/onedash') ?>/js/table-datatable.js"></script>
    <!--app-->
    <script src="<?= url('assets/onedash') ?>/js/app.js"></script>
    @yield('script')
</body>

</html>
