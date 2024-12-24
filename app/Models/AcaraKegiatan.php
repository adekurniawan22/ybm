<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AcaraKegiatan extends Model
{
    protected $table = 'acara_kegiatan';
    protected $primaryKey = 'acara_kegiatan_id';
    protected $fillable = [
        'nama_acara',
        'keterangan',
        'tanggal',
        'butuh_dana',
        'keuangan_id',
        'jumlah_dana',
        'disetujui_ketua',
        'ditambahkan_oleh'
    ];

    public function keuangan()
    {
        return $this->belongsTo(Keuangan::class, 'keuangan_id');
    }

    public function ditambahkanOleh()
    {
        return $this->belongsTo(User::class, 'ditambahkan_oleh');
    }

    public function rules()
    {
        return [
            'nama_acara' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'tanggal' => 'nullable|date',
            'butuh_dana' => 'boolean',
            'keuangan_id' => 'required|integer|exists:keuangan,keuangan_id',
            'jumlah_dana' => 'nullable|integer',
            'disetujui_ketua' => 'boolean',
            'ditambahkan_oleh' => 'required|integer|exists:user,user_id',
        ];
    }

    public function attributes()
    {
        return [
            'nama_acara' => 'Nama Acara',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
            'butuh_dana' => 'Butuh Dana',
            'keuangan_id' => 'ID Keuangan',
            'jumlah_dana' => 'Jumlah Dana',
            'disetujui_ketua' => 'Disetujui Ketua',
            'ditambahkan_oleh' => 'Ditambahkan Oleh',
        ];
    }
}
