<?php

namespace App\Models\Applicant_Management;

use Illuminate\Database\Eloquent\Model;

class ResumeData extends Model
{
    protected $table = 'filtered_resumes';

    protected $fillable = [
        'applicant_job_id',
        'applicant_job_title',
        'applicant_first_name',
        'applicant_last_name',
        'applicant_middle_name',
        'applicant_suffix',
        'applicant_address',
        'applicant_email',
        'applicant_phone',
        'applicant_age',
        'applicant_gender',
        'applicant_birth_date',
        'applicant_civil_status',
        'applicant_height', 
        'applicant_weight',
        'applicant_skills',
        'applicant_education',
        'applicant_experience',
        'ratings',
    ];
}
