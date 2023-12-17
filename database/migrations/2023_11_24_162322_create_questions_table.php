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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->unsignedBigInteger('correctOption')->nullable();
            $table->integer('points');
            $table->unsignedBigInteger('quizId')->nullable();
            $table->foreign('quizId')->references('id')->on('quizzes')->onDelete('set null');
            $table->foreign('correctOption')->references('id')->on('options')->onDelete('set null');
            $table->index('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
