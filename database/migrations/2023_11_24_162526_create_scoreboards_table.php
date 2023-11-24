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
        Schema::create('scoreboards', function (Blueprint $table) {
            $table->unsignedBigInteger('participantId')->nullable();
            $table->foreign('participantId')->references('id')->on('participants')->onDelete('set null');
            $table->unsignedBigInteger('sessionId')->nullable();
            $table->foreign('sessionId')->references('id')->on('quiz_sessions')->onDelete('set null');
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scoreboards');
    }
};
