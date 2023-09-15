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
        Schema::create('news', function (Blueprint $table) {
            $table->id('news_id');
            $table->string('title', 100);
            $table->string('slug')->unique();
            $table->text('content');
            $table->boolean('published')->default(false);
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('author_id');
            $table->timestamps();

            $table->foreign('image_id')->references('file_id')->on('files');
            $table->foreign('author_id')->references('author_id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
