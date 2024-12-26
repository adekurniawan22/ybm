<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RKAT extends Model
{
    protected $table = 'rkat';
    protected $primaryKey = 'rkat_id';
    protected $fillable = [
        'nama_rkat',
        'alokasi_persen'
    ];

    public function rules()
    {
        return [
            'nama_rkat' => 'required|string',
            'alokasi_persen' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'nama_rkat' => 'Nama RKAT',
            'alokasi_persen' => 'Alokasi Persen',
        ];
    }
}
