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
            $table->foreignId('form_id')->constrained()->onDelete('cascade'); // Clé étrangère vers l'ID du formulaire
            $table->text('content');
            $table->boolean('have_a_comment');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('single_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Clé étrangère vers l'ID de la question
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('multiple_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Clé étrangère vers l'ID de la question
            $table->text('content');
            $table->timestamps();
        });

        Schema::create('o_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Clé étrangère vers l'ID de la question
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_answers');
        Schema::dropIfExists('multiple_answers');
        Schema::dropIfExists('single_answers');
        Schema::dropIfExists('questions');
    }
};



