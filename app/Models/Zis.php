<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Zis extends Model
{
    protected $table = 'zis';
    protected $primaryKey = 'zis_id';
    protected $fillable = [
        'proposal_id',
        'kecamatan_id',
        'dana_darurat',
        'jumlah_dana',
        'judul',
        'keterangan',
        'sudah_disalurkan',
        'status',
        'evaluasi'
    ];
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function rules()
    {
        return [
            'proposal_id' => 'nullable|integer|exists:proposal,proposal_id',
            'kecamatan_id' => 'required|integer|exists:kecamatan,kecamatan_id',
            'dana_darurat' => 'boolean',
            'jumlah_dana' => 'required|integer',
            'judul' => 'required|string',
            'keterangan' => 'nullable|string',
            'sudah_disalurkan' => 'boolean',
            'status' => 'required|in:aktif,tidak aktif',
            'evaluasi' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'proposal_id' => 'ID Proposal',
            'kecamatan_id' => 'ID Kecamatan',
            'dana_darurat' => 'Dana Darurat',
            'jumlah_dana' => 'Jumlah Dana',
            'judul' => 'Judul',
            'keterangan' => 'Keterangan',
            'sudah_disalurkan' => 'Sudah Disalurkan',
            'status' => 'Status',
            'evaluasi' => 'Evaluasi',
        ];
    }
}
