<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->increments('kecamatan_id');
            $table->string('nama_kecamatan')->nullable();
            $table->timestamps();
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('role');
            $table->string('nama');
            $table->string('email');
            $table->string('password');
            $table->string('no_hp', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('mitra', function (Blueprint $table) {
            $table->increments('mitra_id');
            $table->longText('detail_mitra');
            $table->unsignedInteger('ditambahkan_oleh');
            $table->timestamps();

            $table->foreign('ditambahkan_oleh')->references('user_id')->on('user');
        });

        Schema::create('keuangan', function (Blueprint $table) {
            $table->increments('keuangan_id');
            $table->enum('jenis', ['masuk', 'keluar']);
            $table->integer('jumlah');
            $table->dateTime('tanggal_transaksi');
            $table->boolean('verifikasi')->default(0);
            $table->string('file')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedInteger('ditambahkan_oleh')->nullable();
            $table->timestamps();

            $table->foreign('ditambahkan_oleh')->references('user_id')->on('user');
        });

        Schema::create('acara_kegiatan', function (Blueprint $table) {
            $table->increments('acara_kegiatan_id');
            $table->string('nama_acara')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->boolean('butuh_dana')->default(0);
            $table->unsignedInteger('keuangan_id')->nullable();
            $table->integer('jumlah_dana')->nullable();
            $table->boolean('disetujui_ketua')->default(0);
            $table->unsignedInteger('ditambahkan_oleh');
            $table->timestamps();

            $table->foreign('keuangan_id')->references('keuangan_id')->on('keuangan')->onDelete('set null');;
            $table->foreign('ditambahkan_oleh')->references('user_id')->on('user');
        });

        Schema::create('donatur', function (Blueprint $table) {
            $table->increments('donatur_id');
            $table->string('nama_donatur');
            $table->string('email')->nullable();
            $table->boolean('sudah_diberi_notifikasi')->default(1);
            $table->timestamps();
        });

        Schema::create('pendanaan', function (Blueprint $table) {
            $table->increments('pendanaan_id');
            $table->unsignedInteger('donatur_id');
            $table->unsignedInteger('keuangan_id');
            $table->unsignedInteger('ditambahkan_oleh');
            $table->timestamps();

            $table->foreign('donatur_id')->references('donatur_id')->on('donatur');
            $table->foreign('keuangan_id')->references('keuangan_id')->on('keuangan');
            $table->foreign('ditambahkan_oleh')->references('user_id')->on('user');
        });

        Schema::create('proposal', function (Blueprint $table) {
            $table->increments('proposal_id');
            $table->unsignedInteger('kecamatan_id');
            $table->string('kategori_penerima');
            $table->string('sasaran_program');
            $table->longText('detail_proposal');
            $table->dateTime('tanggal_dibuat');
            $table->unsignedInteger('ditambahkan_oleh');
            $table->string('hasil_proposal')->nullable();
            $table->string('pdf_proposal')->nullable();
            $table->boolean('proposal_disetujui')->default(0);
            $table->unsignedInteger('disetujui_oleh')->nullable();
            $table->boolean('disurvey')->default(0);
            $table->unsignedInteger('disurvey_oleh')->nullable();
            $table->longText('detail_survey_proposal')->nullable();
            $table->string('pdf_survey')->nullable();
            $table->string('hasil_survey_proposal')->nullable();
            $table->boolean('survey_proposal_disetujui')->default(0);
            $table->unsignedInteger('survey_proposal_disetujui_oleh')->nullable();
            $table->unsignedInteger('mitra_id')->nullable();
            $table->timestamps();

            $table->foreign('ditambahkan_oleh')->references('user_id')->on('user');
            $table->foreign('disetujui_oleh')->references('user_id')->on('user');
            $table->foreign('disurvey_oleh')->references('user_id')->on('user');
            $table->foreign('survey_proposal_disetujui_oleh')->references('user_id')->on('user');
            $table->foreign('mitra_id')->references('mitra_id')->on('mitra');
            $table->foreign('kecamatan_id')->references('kecamatan_id')->on('kecamatan');
        });

        Schema::create('rkat', function (Blueprint $table) {
            $table->increments('rkat_id');
            $table->string('nama_rkat');
            $table->float('alokasi_persen');
            $table->timestamps();
        });

        Schema::create('zis', function (Blueprint $table) {
            $table->increments('zis_id');
            $table->unsignedInteger('proposal_id')->nullable();
            $table->unsignedInteger('kecamatan_id');
            $table->boolean('dana_darurat')->default(0);
            $table->integer('jumlah_dana');
            $table->string('judul');
            $table->string('keterangan')->nullable();
            $table->boolean('sudah_disalurkan')->default(0);
            $table->enum('status', ['aktif', 'tidak aktif']);
            $table->longText('evaluasi')->nullable();
            $table->timestamps();

            $table->foreign('proposal_id')->references('proposal_id')->on('proposal');
            $table->foreign('kecamatan_id')->references('kecamatan_id')->on('kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zis');
        Schema::dropIfExists('rkat');
        Schema::dropIfExists('proposal');
        Schema::dropIfExists('pendanaan');
        Schema::dropIfExists('donatur');
        Schema::dropIfExists('acara_kegiatan');
        Schema::dropIfExists('keuangan');
        Schema::dropIfExists('mitra');
        Schema::dropIfExists('user');
        Schema::dropIfExists('kecamatan');
    }
};
