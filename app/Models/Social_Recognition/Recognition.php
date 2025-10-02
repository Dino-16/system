<?php

namespace App\Models\Social_Recognition;

use Illuminate\Database\Eloquent\Model;

class Recognition extends Model
{
    protected $table = 'recognitions';

    protected $fillable = [
        'name',
        'type',
        'date',
        'message',
    ];

}
