<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'page_section_id',
        'form_name',
        'form_type',
        'form_data',
        'calculated_result',
        'ip_address',
        'user_agent',
        'submitted_at',
    ];

    protected $casts = [
        'form_data' => 'array',
        'calculated_result' => 'array',
        'submitted_at' => 'datetime',
    ];

    // Form type constants
    const TYPE_SUBMISSION = 'submission';
    const TYPE_CALCULATION = 'calculation';
    const TYPE_ACTION = 'action';

    /**
     * Get the page that owns the submission
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Get the page section that owns the submission
     */
    public function pageSection()
    {
        return $this->belongsTo(PageSection::class);
    }

    /**
     * Scope for submission-based forms
     */
    public function scopeSubmissionType($query)
    {
        return $query->where('form_type', self::TYPE_SUBMISSION);
    }

    /**
     * Scope for calculation-based forms
     */
    public function scopeCalculationType($query)
    {
        return $query->where('form_type', self::TYPE_CALCULATION);
    }

    /**
     * Scope for action-based forms
     */
    public function scopeActionType($query)
    {
        return $query->where('form_type', self::TYPE_ACTION);
    }

    /**
     * Scope for filtering by form name
     */
    public function scopeByFormName($query, $formName)
    {
        return $query->where('form_name', $formName);
    }

    /**
     * Get submissions by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('submitted_at', [$startDate, $endDate]);
    }
}
