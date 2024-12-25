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
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="text-dark">Donatur</span>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route(session()->get('role') . '.pendanaan.create') }}" class="btn btn-success">
                    <i class="fadeIn animated bx bx-plus"></i>Tambah
                </a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row ms-0 me-1">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mt-1"></div>
                        <table id="example" class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Foto transaksi</th>
                                    <th>Verifikasi</th>
                                    <th data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td
                                            data-order="{{ \Carbon\Carbon::parse($item->keuangan->tanggal_transaksi)->format('Y-m-d H:i:s') }}">
                                            {{ \Carbon\Carbon::parse($item->keuangan->tanggal_transaksi)->locale('id')->isoFormat('D MMMM YYYY') }}
                                            <br>
                                            <small>
                                                Ditambahkan oleh : {{ $item->ditambahkanOleh->nama ?? 'Donatur' }}
                                            </small>
                                        </td>
                                        <td>
                                            @if ($item->keuangan->jenis === 'masuk')
                                                <span class="badge bg-success py-2 w-auto">
                                                    <i class="bi bi-arrow-right me-1"></i>
                                                    {{ ucfirst($item->keuangan->jenis) }}
                                                    <br>
                                                    <br>
                                                    Rp. {{ number_format($item->keuangan->jumlah, 0, ',', '.') }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger py-2 w-auto">
                                                    <i class="bi bi-arrow-left me-1"></i>
                                                    {{ ucfirst($item->keuangan->jenis) }}
                                                    <br>
                                                    <br>
                                                    Rp. {{ number_format($item->keuangan->jumlah, 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $item->keuangan->keterangan }}</td>
                                        <td>
                                            @if ($item->keuangan->file)
                                                <a href="{{ asset('keuangan/' . basename($item->keuangan->file)) }}"
                                                    class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="ms-0 bi bi-file-image"></i> Lihat
                                                </a>
                                            @else
                                                Tidak ada
                                            @endif
                                        </td>
                                        <td class="verification-status">
                                            @if ($item->keuangan->verifikasi == '1')
                                                <span class="text-success">
                                                    <i class="bi bi-check-circle me-1"></i> Sudah diverifikasi
                                                </span>
                                            @else
                                                <span class="text-danger">
                                                    <i class="bi bi-x-circle me-1"></i> Belum diverifikasi
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-start justify-content-start gap-2 fs-6">
                                                <!-- Edit Button -->
                                                <a href="{{ route(session()->get('role') . '.pendanaan.edit', $item->pendanaan_id) }}"
                                                    class="btn btn-sm btn-warning text-white d-flex align-items-center">
                                                    <i class="bi bi-pencil-fill me-1"></i> Edit
                                                </a>

                                                <!-- Delete Button -->
                                                <button type="button"
                                                    class="btn btn-sm btn-danger d-flex align-items-center"
                                                    data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                    data-form-id="delete-form-{{ $item->pendanaan_id }}">
                                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                                </button>

                                                <!-- Delete Form -->
                                                <form id="delete-form-{{ $item->pendanaan_id }}"
                                                    action="{{ route(session()->get('role') . '.pendanaan.destroy', $item->pendanaan_id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('[data-bs-target="#confirmDeleteModal"]');
            var confirmDeleteButton = document.getElementById('confirm-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var formId = button.getAttribute('data-form-id');
                    confirmDeleteButton.setAttribute('data-form-id', formId);
                });
            });

            confirmDeleteButton.addEventListener('click', function() {
                var formId = confirmDeleteButton.getAttribute('data-form-id');
                document.getElementById(formId).submit();
            });
        });
    </script>
@endsection
