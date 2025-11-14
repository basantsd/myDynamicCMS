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
        'form_name',  // Keep for backward compatibility
        'form_type',
        'form_data',
        'calculated_result',
        'page_id',
        'page_section_id',
        'data',
        'ip_address',
        'user_agent',
        'user_id',
        'submitted_at',
    ];

    protected $casts = [
        'data' => 'array',
        'form_data' => 'array',
        'calculated_result' => 'array',
        'submitted_at' => 'datetime',
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
