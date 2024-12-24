<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'kecamatan_id';
    protected $fillable = [
        'nama_kecamatan'
    ];

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'kecamatan_id');
    }

    public function zis()
    {
        return $this->hasMany(Zis::class, 'kecamatan_id');
    }

    public function rules()
    {
        return [
            'nama_kecamatan' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'nama_kecamatan' => 'Nama Kecamatan',
        ];
    }
}
