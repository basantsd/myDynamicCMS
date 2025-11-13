<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomBlockVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'variant_name',
        'variant_config',
        'html_template',
        'is_default',
    ];

    protected $casts = [
        'variant_config' => 'array',
        'is_default' => 'boolean',
    ];

    /**
     * Get the parent block
     */
    public function block()
    {
        return $this->belongsTo(CustomBlock::class, 'block_id');
    }

    /**
     * Scope for default variants
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }
}
