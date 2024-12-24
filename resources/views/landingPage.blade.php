<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.min.css">

    <title>YBM - Zakat, Infaq, dan Sedekah</title>
    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }

        .navbar {
            background-color: rgba(25, 133, 123, 0.8);
            backdrop-filter: blur(5px);
        }

        .jumbotron {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(https://picsum.photos/id/18/1200/600);
            background-size: cover;
            color: white;
        }

        .jumbotron .display-4 {
            font-weight: bold;
        }

        .btn-success {
            background-color: #19857b;
        }

        section {
            padding-top: 80px;
            padding-bottom: 80px;
        }

        section h2 {
            margin-bottom: 40px;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            color: #19857b;
        }

        .list-group-item i {
            margin-right: 10px;
            color: #19857b;
        }

        footer {
            background-color: #19857b;
            color: white;
        }

        footer p {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://picsum.photos/50" alt="Logo YBM" width="40"
                    class="d-inline-block align-text-top" />
                <span class="ms-2">YBM</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#program">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#donasi">Donasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Jumbotron Banner -->
    <div class="jumbotron py-5">
        <div class="container text-center my-5">
            <h1 class="display-4">Selamat Datang di YBM</h1>
            <p class="lead">Bergabunglah dengan gerakan kami dalam menebar kebaikan.</p>
            <a class="btn btn-success btn-lg" href="#donasi" role="button">Donasi Sekarang</a>
        </div>
    </div>

    <!-- About YBM -->
    <section id="tentang">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="https://picsum.photos/id/1/600/400" alt="Tentang YBM" class="img-fluid rounded" />
                </div>
                <div class="col-md-6 mt-3">
                    <h2>Mengenal YBM</h2>
                    <p class="lead">YBM adalah lembaga yang bergerak di bidang Zakat, Infaq, dan Sedekah.</p>
                    <p>
                        Visi kami adalah menjadi organisasi pengelola ZISWAF terdepan yang amanah, profesional,
                        akuntabel, dan
                        terkemuka dengan daerah operasi yang merata.
                    </p>
                    <a href="#" class="btn btn-outline-success">Pelajari lebih lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Program -->
    <section id="program" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Program Kami</h2>
                    <p class="lead">Kami memiliki beragam program yang bertujuan untuk memberdayakan masyarakat.</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="https://picsum.photos/id/180/400/250" class="card-img-top" alt="Pendidikan" />
                        <div class="card-body">
                            <h5 class="card-title">Pendidikan</h5>
                            <p class="card-text">
                                Kami menyediakan beasiswa dan bantuan pendidikan bagi anak-anak yang membutuhkan.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="https://picsum.photos/id/191/400/250" class="card-img-top" alt="Kesehatan" />
                        <div class="card-body">
                            <h5 class="card-title">Kesehatan</h5>
                            <p class="card-text">
                                Kami membantu memberikan layanan kesehatan gratis bagi masyarakat kurang mampu.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="https://picsum.photos/id/177/400/250" class="card-img-top" alt="Ekonomi" />
                        <div class="card-body">
                            <h5 class="card-title">Pemberdayaan Ekonomi</h5>
                            <p class="card-text">
                                Kami mendukung program-program yang bertujuan memberdayakan ekonomi masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Donasi -->
    <section id="donasi">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Donasi</h2>
                    <p class="lead">Salurkan donasi anda untuk mendukung berbagai program kami.</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6">
                    <img src="https://picsum.photos/id/104/600/500" alt="Donasi" class="img-fluid rounded" />
                </div>
                <div class="col-md-6">
                    <form class="p-4 rounded bg-light shadow-sm" id="donation-form" action="/donasi" method="POST"
                        enctype="multipart/form-data">
                        <!-- Optional Name -->
                        <div class="mb-3">
                            <label for="nama-donatur" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama-donatur" required />
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="nama-optional">
                                <label class="form-check-label" for="nama-optional">Biarkan kosong</label>
                            </div>
                        </div>

                        <!-- Optional Email -->
                        <div class="mb-3">
                            <label for="email-donatur" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email-donatur" required />
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="email-optional">
                                <label class="form-check-label" for="email-optional">Biarkan kosong</label>
                            </div>
                        </div>

                        <!-- Donation Amount with Format -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Donasi</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" id="jumlah" required />
                            </div>
                        </div>

                        <!-- Upload Transfer Proof -->
                        <div class="mb-3">
                            <label for="bukti" class="form-label">Upload Bukti Transfer</label>
                            <input class="form-control" type="file" id="bukti" accept="image/*" />
                            <small class="form-text text-muted">Maksimal ukuran file 5 MB dan hanya gambar yang
                                diperbolehkan.</small>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Kirim Donasi</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Kontak Kami</h2>
                    <p class="lead">Jika Anda memiliki pertanyaan, silakan hubungi kami melalui:</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <ul class="list-group list-group-flush shadow rounded">
                        <li class="list-group-item"><i class="fas fa-envelope"></i> info@ybm.org</li>
                        <li class="list-group-item"><i class="fas fa-map-marker-alt"></i> Jl. Sudirman No. 23, Jakarta
                        </li>
                        <li class="list-group-item"><i class="fab fa-twitter"></i> @yayasanberkahmulia</li>
                        <li class="list-group-item"><i class="fab fa-facebook"></i> Yayasan Berkah Mulia</li>
                        <li class="list-group-item"><i class="fab fa-instagram"></i> @yayasanberkahmulia</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-3">
        <div class="container text-center">
            <p>&copy; 2023 Yayasan Berkah Mulia</p>
        </div>
    </footer>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.3/dist/sweetalert2.all.min.js"></script>
    <script>
        // Toggle active class on nav links
        const navLinks = document.querySelectorAll(".nav-link");

        navLinks.forEach((link) => {
            link.addEventListener("click", () => {
                document.querySelector(".nav-link.active").classList.remove("active");
                link.classList.add("active");
            });
        });

        // Format number with thousand separators for "Jumlah Donasi"
        const jumlahInput = document.getElementById('jumlah');
        jumlahInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
            this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ","); // Add thousand separator
        });

        // Disable the inputs based on optional checkboxes
        const namaOptionalCheckbox = document.getElementById('nama-optional');
        const emailOptionalCheckbox = document.getElementById('email-optional');
        const namaInput = document.getElementById('nama-donatur');
        const emailInput = document.getElementById('email-donatur');

        // Function to update the input fields' disabled state based on the checkboxes
        function toggleInputState() {
            if (namaOptionalCheckbox.checked) {
                namaInput.disabled = true;
                namaInput.value = ''; // Clear the value if disabled
            } else {
                namaInput.disabled = false;
            }

            if (emailOptionalCheckbox.checked) {
                emailInput.disabled = true;
                emailInput.value = ''; // Clear the value if disabled
            } else {
                emailInput.disabled = false;
            }
        }

        // Add event listeners for checkboxes to toggle the input states
        namaOptionalCheckbox.addEventListener('change', toggleInputState);
        emailOptionalCheckbox.addEventListener('change', toggleInputState);

        // Initially set the state of the inputs
        toggleInputState();

        // Handle form submission
        const form = document.getElementById('donation-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const namaDonatur = namaOptionalCheckbox.checked ? "anonymous" : document.getElementById('nama-donatur')
                .value;
            const emailDonatur = emailOptionalCheckbox.checked ? "anonymous" : document.getElementById(
                'email-donatur').value;
            const jumlahDonasi = document.getElementById('jumlah').value;
            const bukti = document.getElementById('bukti').files[0];

            if (bukti) {
                const fileSize = bukti.size / 1024 / 1024; // Convert to MB
                if (fileSize > 5) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran file terlalu besar',
                        text: 'Maksimal 5 MB.'
                    });
                    return;
                }
                const fileType = bukti.type.split('/')[0];
                if (fileType !== 'image') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tipe file salah',
                        text: 'File yang diupload harus berupa gambar.'
                    });
                    return;
                }
            }

            const formData = new FormData();
            formData.append('nama_donatur', namaDonatur);
            formData.append('email_donatur', emailDonatur);
            formData.append('jumlah_donasi', parseInt(jumlahDonasi.replace(/[^0-9]/g, ''), 10));
            formData.append('bukti', bukti);

            console.log(bukti)

            const base_url = "{{ url('/') }}";
            fetch(`${base_url}/donasi`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Donasi berhasil!',
                            text: 'Donasi Anda telah dikirim dengan sukses.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan',
                            text: 'Coba lagi.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan',
                        text: 'Coba lagi.'
                    });
                });
        });
    </script>
</body>

</html>
