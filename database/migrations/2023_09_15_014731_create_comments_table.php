<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->text('content');
            $table->unsignedBigInteger('subscriber_id');
            $table->unsignedBigInteger('news_id');
            $table->timestamps();

            $table->foreign('news_id')->references('news_id')->on('news');
            $table->foreign('subscriber_id')->references('subscriber_id')->on('subscribers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
