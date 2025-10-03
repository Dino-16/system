<?php

namespace App\Models\Onboarding;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'document_checklists';

    protected $fillable = [
        'new_hire_name',
        'resume',
        'signed_application_form',
        'valid_government_id',
        'transcript_of_records',
        'medical_certificate',
        'nbi_clearance',
        'barangay_clearance',
        'signed_job_offer_contract',
    ];

    protected $casts = [
        'resume' => 'boolean',
        'signed_application_form' => 'boolean',
        'valid_government_id' => 'boolean',
        'transcript_of_records' => 'boolean',
        'medical_certificate' => 'boolean',
        'nbi_clearance' => 'boolean',
        'barangay_clearance' => 'boolean',
        'signed_job_offer_contract' => 'boolean',
    ];

}
