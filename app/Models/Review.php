<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'tmdb_id', 'media_type', 'title',
        'poster_path', 'rating', 'body', 'contains_spoilers',
    ];

    protected $casts = [
        'contains_spoilers' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
