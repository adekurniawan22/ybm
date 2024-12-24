<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 'keuangan';
    protected $primaryKey = 'keuangan_id';
    protected $fillable = [
        'jenis',
        'jumlah',
        'tanggal_transaksi',
        'verifikasi',
        'file',
        'keterangan',
        'ditambahkan_oleh'
    ];

    public function ditambahkanOleh()
    {
        return $this->belongsTo(User::class, 'ditambahkan_oleh');
    }

    public function acaraKegiatan()
    {
        return $this->hasOne(AcaraKegiatan::class, 'keuangan_id');
    }

    public function pendanaan()
    {
        return $this->hasOne(Pendanaan::class, 'keuangan_id');
    }

    public function rules()
    {
        return [
            'jenis' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer',
            'tanggal_transaksi' => 'required|date',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'keterangan' => 'nullable|string',
        ];
    }


    public function attributes()
    {
        return [
            'jenis' => 'Jenis',
            'jumlah' => 'Jumlah',
            'tanggal_transaksi' => 'Tanggal Transaksi',
            'file' => 'File',
            'keterangan' => 'Keterangan',
        ];
    }
}
