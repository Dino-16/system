<?php

namespace App\Models\Applicant_Management;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';

    protected $fillable = [
        'applicant_job_id',
        'candidate_job_title', 
        'candidate_last_name',
        'candidate_first_name',
        'candidate_middle_name',
        'candidate_suffix_name',
        'candidate_address',
        'candidate_email',
        'candidate_phone',
        'candidate_age' ,
        'candidate_gender',
        'candidate_birth_date',
        'candidate_civil_status',
        'skills',
        'experience',
        'education',
        'interviewDate',
        'interviewTime',
    ];
}
