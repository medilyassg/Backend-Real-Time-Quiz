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
        Schema::create('quiz_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quizId')->nullable();
            $table->unsignedBigInteger('hostId')->nullable();
            $table->foreign('quizId')->references('id')->on('quizzes')->onDelete('set null');
            $table->foreign('hostId')->references('id')->on('hosts')->onDelete('set null');


            $table->timestamp('startTime');
            $table->timestamp('endTime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_sessions');
    }
};
