<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomBlockUsage extends Model
{
    use HasFactory;

    protected $table = 'custom_block_usage';

    public $timestamps = false;

    protected $fillable = [
        'block_id',
        'page_id',
        'user_id',
        'used_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    /**
     * Get the block that was used
     */
    public function block()
    {
        return $this->belongsTo(CustomBlock::class, 'block_id');
    }

    /**
     * Get the page where the block was used
     */
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    /**
     * Get the user who used the block
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
