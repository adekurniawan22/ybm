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
                            <a href="{{ route(session()->get('role') . '.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route(session()->get('role') . '.donatur.index') }}">Donatur</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="text-dark">Edit Donatur</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row ms-0 me-1">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <form action="{{ route(session()->get('role') . '.donatur.update', $data->donatur_id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label" for="nama_donatur">Nama Donatur</label>
                            <input type="text" id="nama_donatur" name="nama_donatur"
                                class="form-control @error('nama_donatur') is-invalid @enderror"
                                value="{{ old('nama_donatur', $data->nama_donatur) }}" placeholder="Masukkan nama donatur">
                            @error('nama_donatur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="email">Email Donatur</label>
                            <input type="text" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $data->email) }}" placeholder="Masukkan nama donatur">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-end my-3">
                            <a href="{{ route(session()->get('role') . '.donatur.index') }}"
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
        document.addEventListener('DOMContentLoaded', function() {
            const noHpInput = document.getElementById('no_hp');

            // Function to format the input value
            function formatNoHp(value) {
                // Hanya ambil angka dari input
                value = value.replace(/\D/g, '');

                // Tambahkan "08" di depan angka jika belum ada
                if (value.length > 0 && !value.startsWith('08')) {
                    value = '08' + value;
                }
                return value;
            }

            noHpInput.addEventListener('input', function(e) {
                e.target.value = formatNoHp(e.target.value);
            });

            noHpInput.addEventListener('focus', function() {
                // Tambahkan "08" di depan jika tidak ada angka sama sekali
                if (noHpInput.value.length > 0 && !noHpInput.value.startsWith('08')) {
                    noHpInput.value = '08' + noHpInput.value;
                }
            });

            // Jika ada nilai default di server-side, tambahkan "08" di depannya
            if (noHpInput.value && !noHpInput.value.startsWith('08')) {
                noHpInput.value = '08' + noHpInput.value;
            }
        });
    </script>
@endsection
