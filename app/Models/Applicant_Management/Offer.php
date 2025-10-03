<?php

namespace App\Models\Applicant_Management;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{   

    protected $table = 'offer_acceptance';

    protected $fillable = [
        'candidate_id',
        'offer_date',
        'offer_status',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
