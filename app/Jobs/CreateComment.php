<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CreateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $news_id, $content, $subscriber_id;
    /**
     * Create a new job instance.
     */
    public function __construct($news_id, $content, $subscriber_id)
    {
        $this->news_id = $news_id;
        $this->content = $content;
        $this->subscriber_id = $subscriber_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Redis::throttle('any_key')->allow(2)->every(1)->then(function () {

            $comment = Comment::create([
                'news_id' => $this->news_id,
                'content' => $this->content,
                'subscriber_id' => $this->subscriber_id,
            ]);
            Log::info('Created Comment ' . $comment->id);
        }, function () {
            // Could not obtain lock; this job will be re-queued
            return $this->release(2);
        });
    }
}
