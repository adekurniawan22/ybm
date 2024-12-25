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

    public function rules($isButuhDana = false)
    {
        if ($isButuhDana) {
            return [
                'nama_acara' => 'required|string',
                'keterangan' => 'required|string',
                'tanggal' => 'required|date',
                'jumlah_dana' => 'required|integer',
            ];
        }

        return [
            'nama_acara' => 'required|string',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'jumlah_dana' => 'nullable|integer',
        ];
    }

    public function attributes()
    {
        return [
            'nama_acara' => 'Nama Acara',
            'keterangan' => 'Keterangan',
            'tanggal' => 'Tanggal',
            'jumlah_dana' => 'Jumlah Dana',
        ];
    }
}
