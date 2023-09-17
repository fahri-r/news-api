<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;
    protected $primaryKey = 'news_id';

    protected $fillable = [
        'title',
        'content',
        'published',
        'author_id',
        'file_id',
        'slug',
    ];

    protected $hidden = [
        'file_id',
        'author_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'author_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'file_id');
    }
}
