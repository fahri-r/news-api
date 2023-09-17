<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLog extends Model
{
    protected $primaryKey = 'news_log_id';

    protected $fillable = [
        'event',
        'news_id',
    ];
}
