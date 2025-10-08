<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class FacilitiesRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_path',
        'category',
        'description',
        'requested_by',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
