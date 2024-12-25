<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Pendanaan extends Model
{
    protected $table = 'pendanaan';
    protected $primaryKey = 'pendanaan_id';
    protected $fillable = [
        'donatur_id',
        'keuangan_id',
        'ditambahkan_oleh'
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'donatur_id');
    }

    public function keuangan()
    {
        return $this->belongsTo(Keuangan::class, 'keuangan_id');
    }

    public function ditambahkanOleh()
    {
        return $this->belongsTo(User::class, 'ditambahkan_oleh');
    }

    public function rules($isNewDonatur = false)
    {
        if ($isNewDonatur) {
            return [
                'nama_donatur' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'jumlah' => 'required|integer',
                'tanggal_transaksi' => 'required|date',
                'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
                'keterangan' => 'nullable|string',
            ];
        }

        return [
            'donatur_id' => 'required',
            'jumlah' => 'required|integer',
            'tanggal_transaksi' => 'required|date',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'keterangan' => 'nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'nama_donatur' => 'Nama Donatur',
            'email' => 'Email',
            'donatur_id' => 'Donatur',
            'tanggal_transaksi' => 'Tanggal Transaksi',
            'jumlah' => 'Jumlah',
            'file' => 'File',
            'keterangan' => 'Keterangan'
        ];
    }
}
