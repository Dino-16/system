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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_job_id');
            $table->string('candidate_job_title');
            $table->string('candidate_last_name');
            $table->string('candidate_first_name');
            $table->string('candidate_middle_name');
            $table->string('candidate_suffix_name')->nullable();
            $table->string('candidate_address');
            $table->string('candidate_email');
            $table->string('candidate_phone');
            $table->integer('candidate_age');
            $table->string('candidate_gender');
            $table->date('candidate_birth_date');
            $table->string('candidate_civil_status');
            $table->text('skills');
            $table->text('experience');
            $table->text('education');
            $table->date('interviewDate');
            $table->time('interviewTime');
            $table->enum('status', ['Scheduled', 'Initial', 'Final', 'Passed', 'Rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
