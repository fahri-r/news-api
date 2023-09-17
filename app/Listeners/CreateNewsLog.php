<?php

namespace App\Listeners;

use App\Models\News;
use App\Models\NewsLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateNewsLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $news = News::where('slug', $event->slug)->firstOrFail();
        NewsLog::create([
            'event' => $event->title,
            'news_id' => $news->news_id
        ]);
    }
}
