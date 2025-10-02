<?php

namespace App\Models\Recruitment_Management;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $table = 'job_postings';
    
    protected $fillable = [
        'requisition_id',
        'job_title',
        'job_description',
        'job_type',
        'job_arrangement',
        'job_responsibilities',
        'job_qualifications',
    ];
}
