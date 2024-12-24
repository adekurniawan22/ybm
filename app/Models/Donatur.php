<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    protected $table = 'donatur';
    protected $primaryKey = 'donatur_id';
    protected $fillable = [
        'nama_donatur',
        'email',
        'sudah_diberi_notifikasi'
    ];

    public function pendanaan()
    {
        return $this->hasOne(Pendanaan::class, 'donatur_id');
    }

    public function rules()
    {
        return [
            'nama_donatur' => 'required|string',
            'email' => 'nullable|email',
        ];
    }

    public function attributes()
    {
        return [
            'nama_donatur' => 'Nama Donatur',
            'email' => 'Email',
        ];
    }
}
