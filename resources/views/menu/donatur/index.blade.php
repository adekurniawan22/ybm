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
                <a href="{{ route(session()->get('role') . '.donatur.create') }}" class="btn btn-success">
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Notifikasi</th>
                                    <th data-sortable="false">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>
                                            @if ($item->nama_donatur === 'anonymous')
                                                Tidak diketahui
                                            @else
                                                {{ ucfirst($item->nama_donatur) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->email === 'anonymous' || $item->email === null)
                                                Tidak diketahui
                                            @else
                                                {{ $item->email }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->sudah_diberi_notifikasi == '1' && $item->email === 'anonymous')
                                                <span class="text-info">
                                                    <i class="bi bi-info-circle me-1"></i> Email tidak ada
                                                </span>
                                            @elseif($item->sudah_diberi_notifikasi == '1')
                                                <span class="text-success">
                                                    <i class="bi bi-check-circle me-1"></i> Sudah diberitahukan
                                                </span>
                                            @elseif($item->sudah_diberi_notifikasi == '0' && $item->email === null)
                                                <span class="text-info">
                                                    <i class="bi bi-info-circle me-1"></i> Email tidak ada
                                                </span>
                                            @else
                                                <span class="text-danger">
                                                    <i class="bi bi-x-circle me-1"></i> Belum diberitahukan
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-start justify-content-start gap-2 fs-6">
                                                <!-- Tombol Edit -->
                                                <a href="{{ route(session()->get('role') . '.donatur.edit', $item->donatur_id) }}"
                                                    class="btn btn-sm btn-warning text-white d-flex align-items-center">
                                                    <i class="bi bi-pencil-fill me-1"></i> Edit
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <button type="button"
                                                    class="btn btn-sm btn-danger d-flex align-items-center"
                                                    data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                    data-form-id="delete-form-{{ $item->donatur_id }}">
                                                    <i class="bi bi-trash-fill me-1"></i> Hapus
                                                </button>

                                                <!-- Form Hapus -->
                                                <form id="delete-form-{{ $item->donatur_id }}"
                                                    action="{{ route(session()->get('role') . '.donatur.destroy', $item->donatur_id) }}"
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
