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
        Schema::create('social_medias_users', function (Blueprint $table) {
            $table->id();

            $table->string('url');

            $table->unsignedBigInteger('social_media_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('social_media_id')->references('id')->on('social_medias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_medias_users');
    }
};
