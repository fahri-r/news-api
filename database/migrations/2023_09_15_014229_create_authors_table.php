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
        Schema::create('authors', function (Blueprint $table) {
            $table->id('author_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->unsignedBigInteger('file_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('file_id')->references('file_id')->on('files');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
