<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'author_id';

    protected $fillable = [
        'user_id',
        'name',
        'file_id',
    ];

    protected $hidden = [
        'deleted_at',
        'file_id'
    ];


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
