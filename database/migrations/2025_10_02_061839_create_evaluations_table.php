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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('review_period');
            $table->string('job_title');
            $table->string('department');
            $table->string('reviewer_name');
            $table->json('competencies');
            $table->text('strengths')->nullable();
            $table->text('improvements')->nullable();
            $table->text('development_plan')->nullable();
            $table->integer('employee_rating');
            $table->integer('confidence_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
