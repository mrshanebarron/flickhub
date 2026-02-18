<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('tmdb_id');
            $table->string('media_type', 10); // movie or tv
            $table->string('title');
            $table->string('poster_path')->nullable();
            $table->unsignedTinyInteger('rating'); // 1-10
            $table->text('body');
            $table->boolean('contains_spoilers')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'tmdb_id', 'media_type']);
            $table->index(['tmdb_id', 'media_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
