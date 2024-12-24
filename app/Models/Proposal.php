<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = 'proposal';
    protected $primaryKey = 'proposal_id';
    protected $fillable = [
        'kecamatan_id',
        'kategori_penerima',
        'sasaran_program',
        'detail_proposal',
        'tanggal_dibuat',
        'ditambahkan_oleh',
        'hasil_proposal',
        'pdf_proposal',
        'proposal_disetujui',
        'disetujui_oleh',
        'disurvey',
        'disurvey_oleh',
        'detail_survey_proposal',
        'pdf_survey',
        'hasil_survey_proposal',
        'survey_proposal_disetujui',
        'survey_proposal_disetujui_oleh',
        'mitra_id'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function ditambahkanOleh()
    {
        return $this->belongsTo(User::class, 'ditambahkan_oleh');
    }

    public function disetujuiOleh()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }

    public function disurveyOleh()
    {
        return $this->belongsTo(User::class, 'disurvey_oleh');
    }

    public function surveyProposalDisetujuiOleh()
    {
        return $this->belongsTo(User::class, 'survey_proposal_disetujui_oleh');
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    public function zis()
    {
        return $this->hasOne(Zis::class, 'proposal_id');
    }

    public function rules()
    {
        return [
            'kecamatan_id' => 'required|integer|exists:kecamatan,kecamatan_id',
            'kategori_penerima' => 'required|string',
            'sasaran_program' => 'required|string',
            'detail_proposal' => 'required',
            'tanggal_dibuat' => 'required|date',
            'ditambahkan_oleh' => 'required|integer|exists:user,user_id',
            'hasil_proposal' => 'nullable|string',
            'pdf_proposal' => 'nullable|file',
            'proposal_disetujui' => 'boolean',
            'disetujui_oleh' => 'nullable|integer|exists:user,user_id',
            'disurvey' => 'boolean',
            'disurvey_oleh' => 'nullable|integer|exists:user,user_id',
            'detail_survey_proposal' => 'nullable',
            'pdf_survey' => 'nullable|file',
            'hasil_survey_proposal' => 'nullable|string',
            'survey_proposal_disetujui' => 'boolean',
            'survey_proposal_disetujui_oleh' => 'nullable|integer|exists:user,user_id',
            'mitra_id' => 'nullable|integer|exists:mitra,mitra_id',
        ];
    }

    public function attributes()
    {
        return [
            'kecamatan_id' => 'ID Kecamatan',
            'kategori_penerima' => 'Kategori Penerima',
            'sasaran_program' => 'Sasaran Program',
            'detail_proposal' => 'Detail Proposal',
            'tanggal_dibuat' => 'Tanggal Dibuat',
            'ditambahkan_oleh' => 'Ditambahkan Oleh',
            'hasil_proposal' => 'Hasil Proposal',
            'pdf_proposal' => 'PDF Proposal',
            'proposal_disetujui' => 'Proposal Disetujui',
            'disetujui_oleh' => 'Disetujui Oleh',
            'disurvey' => 'Disurvey',
            'disurvey_oleh' => 'Disurvey Oleh',
            'detail_survey_proposal' => 'Detail Survey Proposal',
            'pdf_survey' => 'PDF Survey',
            'hasil_survey_proposal' => 'Hasil Survey Proposal',
            'survey_proposal_disetujui' => 'Survey Proposal Disetujui',
            'survey_proposal_disetujui_oleh' => 'Survey Proposal Disetujui Oleh',
            'mitra_id' => 'ID Mitra',
        ];
    }
}
