<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'subscriber_id';

    protected $fillable = [
        'news_id',
        'content',
        'subscriber_id',
    ];


    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class, 'news_id', 'news_id');
    }
}
