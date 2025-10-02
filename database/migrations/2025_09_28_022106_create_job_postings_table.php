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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('requisition_id')->nullable();
            $table->string('job_title');
            $table->string('job_description');
            $table->enum('job_type', ['Full-Time', 'Part-Time'])->default('Full-Time');
            $table->enum('job_arrangement', ['On-Site', 'Remote'])->default('On-Site');
            $table->text('job_responsibilities');
            $table->text('job_qualifications');
            $table->enum('status', ['Posted', 'Removed'])->default('Posted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
