<?php

namespace App\Models\Performance_Management;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $table = 'evaluations';

    protected $fillable = [
        'full_name', 
        'review_period', 
        'job_title', 
        'department', 
        'reviewer_name',
        'competencies', 
        'strengths', 
        'improvements', 
        'development_plan',
        'employee_rating', 
        'confidence_level'
    ];

    protected $casts = [
        'competencies' => 'array',
    ];
}
