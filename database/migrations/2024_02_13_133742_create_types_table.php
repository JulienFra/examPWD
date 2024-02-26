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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('o_answer_id')->nullable();
            $table->unsignedBigInteger('multiple_answer_id')->nullable();
            $table->unsignedBigInteger('single_answer_id')->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('o_answer_id')->references('id')->on('o_answer')->onDelete('cascade');
            $table->foreign('multiple_answer_id')->references('id')->on('multiple_answer')->onDelete('cascade');
            $table->foreign('single_answer_id')->references('id')->on('single_answer')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
