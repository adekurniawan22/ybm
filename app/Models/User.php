<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'role',
        'nama',
        'email',
        'password',
        'no_hp'
    ];

    public function mitras()
    {
        return $this->hasMany(Mitra::class, 'ditambahkan_oleh');
    }

    public function keuangans()
    {
        return $this->hasMany(Keuangan::class, 'ditambahkan_oleh');
    }

    public function acaraKegiatans()
    {
        return $this->hasMany(AcaraKegiatan::class, 'ditambahkan_oleh');
    }

    public function pendanaans()
    {
        return $this->hasMany(Pendanaan::class, 'ditambahkan_oleh');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'ditambahkan_oleh');
    }

    public function proposalsDisetujui()
    {
        return $this->hasMany(Proposal::class, 'disetujui_oleh');
    }

    public function proposalsSurvey()
    {
        return $this->hasMany(Proposal::class, 'disurvey_oleh');
    }

    public function proposalsSurveyDisetujui()
    {
        return $this->hasMany(Proposal::class, 'survey_proposal_disetujui_oleh');
    }

    public function rules($isEdit = false)
    {
        return [
            'role' => 'required|string',
            'nama' => 'required|string',
            'email' => 'required|email',
            'password' => $isEdit ? 'nullable|string|min:8' : 'required|string|min:8',
            'no_hp' => 'nullable|string|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'role' => 'Role',
            'nama' => 'Nama',
            'email' => 'Email',
            'password' => 'Password',
            'no_hp' => 'Nomor HP',
        ];
    }
}
