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
        Schema::create('filtered_resumes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('applicant_job_id')->nullable();
            $table->string('applicant_job_title')->nullable();

            $table->string('applicant_first_name');
            $table->string('applicant_last_name');
            $table->string('applicant_middle_name')->nullable();
            $table->string('applicant_suffix')->nullable();

            $table->text('applicant_address')->nullable();
            $table->string('applicant_email')->nullable();
            $table->string('applicant_phone')->nullable();

            $table->integer('applicant_age')->nullable();
            $table->string('applicant_gender')->nullable();
            $table->date('applicant_birth_date')->nullable();
            $table->string('applicant_civil_status')->nullable();

            $table->float('applicant_height')->nullable(); // in cm
            $table->float('applicant_weight')->nullable(); // in kg

            $table->text('applicant_skills')->nullable();
            $table->text('applicant_education')->nullable();
            $table->text('applicant_experience')->nullable();

            $table->string('ratings')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filtered_resumes');
    }
};
