<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    protected $table = 'mitra';
    protected $primaryKey = 'mitra_id';
    protected $fillable = [
        'detail_mitra',
        'ditambahkan_oleh'
    ];

    public function ditambahkanOleh()
    {
        return $this->belongsTo(User::class, 'ditambahkan_oleh');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'mitra_id');
    }

    public function rules()
    {
        return [
            'detail_mitra' => 'required',
            'ditambahkan_oleh' => 'required|integer|exists:user,user_id',
        ];
    }

    public function attributes()
    {
        return [
            'detail_mitra' => 'Detail Mitra',
            'ditambahkan_oleh' => 'Ditambahkan Oleh',
        ];
    }
}
