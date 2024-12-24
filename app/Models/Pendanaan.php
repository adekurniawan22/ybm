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

    public function rules()
    {
        return [
            'donatur_id' => 'required|integer|exists:donatur,donatur_id',
            'keuangan_id' => 'required|integer|exists:keuangan,keuangan_id',
            'ditambahkan_oleh' => 'required|integer|exists:user,user_id',
        ];
    }

    public function attributes()
    {
        return [
            'donatur_id' => 'ID Donatur',
            'keuangan_id' => 'ID Keuangan',
            'ditambahkan_oleh' => 'Ditambahkan Oleh',
        ];
    }
}
