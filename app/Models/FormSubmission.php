<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'data',
        'ip_address',
        'user_agent',
        'user_id',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Get the form that owns the submission
     */
    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Get the user who submitted the form
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
