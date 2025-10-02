<?php

namespace App\Models\Recruitment_Management;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $table = 'requisitions';

    protected $fillable = [
        'requested_by',
        'department',
        'requisition_title',
        'requisition_description',
        'requisition_type',
        'requisition_arrangement',
        'requisition_responsibilities',
        'requisition_qualifications',
        'opening',
        'status',
    ];
}
