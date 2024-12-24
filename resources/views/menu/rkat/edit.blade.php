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
                            <a href="<?= route(session()->get('role') . '.rkat.index') ?>">RKAT</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <span class="text-dark">Edit RKAT</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="row ms-0 me-1">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <form id="rkatForm" action="{{ route(session()->get('role') . '.rkat.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div id="rkatRows">
                            @foreach ($rkat as $index => $value)
                                <input type="hidden" name="rkat_id[]" value="{{ $value->rkat_id }}">
                                <div class="row rkat-row" data-index="{{ $index }}">
                                    <div class="col-9">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="nama_rkat">Nama RKAT <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="nama_rkat[]" class="form-control"
                                                placeholder="Masukkan nama kecamatan" value="{{ $value->nama_rkat }}">
                                            <div class="invalid-feedback">Nama RKAT harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="alokasi_persen">Alokasi Persen <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" step="0.01" name="alokasi_persen[]"
                                                    class="form-control" placeholder="Masukkan alokasi persen"
                                                    value="{{ $value->alokasi_persen }}">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <div class="invalid-feedback">Alokasi Persen harus diisi</div>
                                        </div>
                                    </div>
                                    <div class="col-1 d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-danger btn-sm delete-row"
                                            data-index="{{ $index }}">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="text-danger" id="totalPersenError"></div>

                        <div class="text-end my-3">
                            <button type="button" class="btn btn-primary" id="addRKAT">Tambah RKAT</button>
                            <a href="{{ route(session()->get('role') . '.rkat.index') }}" class="btn btn-dark">Kembali</a>
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
            $('#addRKAT').click(function() {
                var newIndex = $('#rkatRows .rkat-row').length;
                var newRow = `
                    <div class="row rkat-row" data-index="${newIndex}">
                        <input type="hidden" name="rkat_id[]" value="">
                        <div class="col-9">
                            <div class="form-group mb-3">
                                <label class="form-label" for="nama_rkat">Nama RKAT <span class="text-danger">*</span></label>
                                <input type="text" name="nama_rkat[]" class="form-control" placeholder="Masukkan nama kecamatan">
                                <div class="invalid-feedback">Nama RKAT harus diisi</div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group mb-3">
                                <label class="form-label" for="alokasi_persen">Alokasi Persen <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" step="0.01" name="alokasi_persen[]" class="form-control" placeholder="Alokasi persen">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="invalid-feedback">Alokasi Persen harus diisi</div>
                            </div>
                        </div>
                        <div class="col-1 d-flex align-items-center justify-content-center">
                            <button type="button" class="btn btn-danger btn-sm delete-row" data-index="${newIndex}">Hapus</button>
                        </div>
                    </div>
                `;
                $('#rkatRows').append(newRow);
            });

            $(document).on('click', '.delete-row', function() {
                var index = $(this).data('index');
                $(this).closest('.rkat-row').remove();
                checkTotalPersen();
            });

            function checkTotalPersen() {
                let totalPersen = 0;
                $('input[name="alokasi_persen[]"]').each(function() {
                    totalPersen += parseFloat($(this).val()) || 0;
                });

                if (totalPersen > 100) {
                    let excess = totalPersen - 100;
                    $('#totalPersenError').text('Total Alokasi Persen berlebih, lebih ' + excess.toFixed(2) + '%');
                } else if (totalPersen < 100) {
                    let deficit = 100 - totalPersen;
                    $('#totalPersenError').text('Total Alokasi Persen kurang, kurang ' + deficit.toFixed(2) + '%');
                } else {
                    $('#totalPersenError').text('');
                }
            }

            $('#rkatForm').submit(function(e) {
                let isValid = true;

                $('.invalid-feedback').hide();
                $('#totalPersenError').text('');

                $('input[name="nama_rkat[]"], input[name="alokasi_persen[]"]').each(function() {
                    if ($(this).val().trim() === '') {
                        isValid = false;
                        $(this).addClass('is-invalid');
                        $(this).siblings('.invalid-feedback').show();
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                checkTotalPersen();

                if ($('#totalPersenError').text() !== '') {
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });

            checkTotalPersen();
        });
    </script>
@endsection
