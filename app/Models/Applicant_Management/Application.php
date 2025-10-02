<?php

namespace App\Models\Applicant_Management;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    protected $fillable = [
        'status',
    ];
}
