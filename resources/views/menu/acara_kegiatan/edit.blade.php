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
                            <a href="<?= route(session()->get('role') . '.acara_kegiatan.index') ?>">Acara dan Kegiatan</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="text-dark">Edit Acara dan Kegiatan</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row ms-0 me-1">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <form action="{{ route(session()->get('role') . '.acara_kegiatan.update', $data->acara_kegiatan_id) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label" for="nama_acara">Nama Acara/Kegiatan <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="nama_acara" name="nama_acara"
                                class="form-control @error('nama_acara') is-invalid @enderror"
                                value="{{ old('nama_acara', $data->nama_acara) }}"
                                placeholder="Masukkan nama acara/kegiatan">
                            @error('nama_acara')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" id="tanggal" name="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d')) }}"
                                placeholder="Masukkan tanggal">
                            @error('tanggal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="toggleButuhDana" name="butuh_dana"
                                {{ old('butuh_dana', $data->butuh_dana == '1') ? 'checked' : '' }}>
                            <label class="form-check-label" for="toggleButuhDana">
                                Butuh Dana?
                            </label>
                        </div>

                        <div class="form-group mb-3" id="jumlahDana">
                            <label class="form-label" for="jumlah_dana">Jumlah uang <span
                                    class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span
                                    class="input-group-text @error('jumlah_dana') border border-danger @enderror">Rp.</span>
                                <input type="text" id="jumlah_dana" name="jumlah_dana"
                                    class="form-control @error('jumlah_dana') is-invalid @enderror"
                                    value="@if (old('jumlah_dana')) {{ number_format((int) str_replace(',', '', old('jumlah_dana')), 0, ',', ',') }}@else{{ number_format($data->jumlah_dana, 0, ',', ',') }} @endif"
                                    placeholder="Masukkan jumlah uang" oninput="formatRibuan(this)">
                                @error('jumlah_dana')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="keterangan">
                                Keterangan <span class="text-danger">*</span>
                            </label>
                            <textarea id="keterangan" name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                                placeholder="Masukkan keterangan">{{ old('keterangan', $data->keterangan) }}</textarea>
                            @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-end my-3">
                            <a href="{{ route(session()->get('role') . '.acara_kegiatan.index') }}"
                                class="btn btn-dark">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        function toggleButuhDana(isButuhDana) {
            const jumlahDana = document.getElementById('jumlahDana');
            jumlahDana.style.display = isButuhDana ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('toggleButuhDana');
            toggleButuhDana(checkbox.checked);

            checkbox.addEventListener('change', function() {
                toggleButuhDana(this.checked);
            });
        });

        function formatRibuan(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            let jumlah_danaInput = document.getElementById('jumlah_dana');
            jumlah_danaInput.value = jumlah_danaInput.value.replace(/,/g, '');
        });
    </script>
@endsection
