@extends('layout.main')
@section('content')
    <main class="page-content">
        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"
            style="height: 37px; overflow: hidden; display: flex; align-items: center;">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?= route(session()->get('role') . '.dashboard') ?>"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= route(session()->get('role') . '.keuangan.index') ?>">Keuangan</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="text-dark">Edit Keuangan</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row ms-0 me-1">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <form action="{{ route(session()->get('role') . '.keuangan.update', $data->keuangan_id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="jenis">Jenis transaksi <span
                                            class="text-danger">*</span></label>
                                    <select id="jenis" name="jenis"
                                        class="form-select @error('jenis') is-invalid @enderror">
                                        <option value="">Pilih jenis transaksi</option>
                                        <option value="keluar"
                                            {{ old('jenis', $data->jenis) == 'keluar' ? 'selected' : '' }}>
                                            Keluar</option>
                                        <option value="masuk"
                                            {{ old('jenis', $data->jenis) == 'masuk' ? 'selected' : '' }}>
                                            Masuk</option>
                                    </select>
                                    @error('jenis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="tanggal_transaksi">Tanggal transaksi <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local" id="tanggal_transaksi" name="tanggal_transaksi"
                                        class="form-control @error('tanggal_transaksi') is-invalid @enderror"
                                        value="{{ old('tanggal_transaksi', $data->tanggal_transaksi) }}"
                                        placeholder="Masukkan tanggal transaksi">
                                    @error('tanggal_transaksi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="jumlah">Jumlah uang <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <span
                                            class="input-group-text @error('jumlah') border border-danger @enderror">Rp.</span>
                                        <input type="text" id="jumlah" name="jumlah"
                                            class="form-control @error('jumlah') is-invalid @enderror"
                                            value="@if (old('jumlah')) {{ number_format((int) str_replace(',', '', old('jumlah')), 0, ',', ',') }}@else{{ number_format($data->jumlah, 0, ',', ',') }} @endif"
                                            placeholder="Masukkan jumlah uang" oninput="formatRibuan(this)">
                                        @error('jumlah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="file">
                                        File transaksi <small class="text-muted">(opsional)</small>
                                    </label>
                                    @if ($data->file)
                                        <div class="mb-2">
                                            @php
                                                $fileExtension = pathinfo($data->file, PATHINFO_EXTENSION);
                                            @endphp
                                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                                                <!-- Menampilkan gambar jika file adalah gambar -->
                                                <div class="mb-2">
                                                    <img src="{{ asset($data->file) }}" alt="File gambar"
                                                        style="max-width: 500px; max-height: 220px;"
                                                        class="border border-dark">
                                                </div>
                                            @else
                                                <!-- Menampilkan nama file jika bukan gambar -->
                                                <div class="mb-2">
                                                    <small class="text-muted">{{ basename($data->file) }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    <input type="file" id="file" name="file"
                                        class="form-control @error('file') is-invalid @enderror" placeholder="Masukkan file"
                                        accept="image/*,.pdf">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="keterangan">
                                        Keterangan <small class="text-muted">(opsional)</small>
                                    </label>
                                    <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                        placeholder="Masukkan keterangan">{{ old('keterangan', $data->keterangan) }}</textarea>
                                    @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end my-3">
                            <a href="{{ route(session()->get('role') . '.keuangan.index') }}"
                                class="btn btn-dark">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#donatur_id").select2({
                theme: "bootstrap4",
                width: "100%",
                placeholder: 'Pilih donatur',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "Tidak ada data yang dicari";
                    },
                }
            });
        });

        function formatRibuan(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            let jumlahInput = document.getElementById('jumlah');
            jumlahInput.value = jumlahInput.value.replace(/,/g, '');
        });

        document.getElementById('file').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf'];
            const maxSize = 5 * 1024 * 1024;
            if (file) {
                const fileName = file.name.toLowerCase();
                const fileSize = file.size;

                const isValidExtension = allowedExtensions.some(extension => fileName.endsWith(extension));
                if (!isValidExtension) {
                    Lobibox.notify('error', {
                        title: 'Gagal',
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'bx bx-x-circle',
                        msg: 'File harus berformat (jpg, jpeg, png) atau pdf.'
                    });
                    event.target.value = '';
                    return;
                }

                if (fileSize > maxSize) {
                    Lobibox.notify('error', {
                        title: 'Gagal',
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'bx bx-x-circle',
                        msg: 'File tidak boleh melebihi 5 MB.'
                    });
                    event.target.value = '';
                }
            }
        });
    </script>
@endsection
