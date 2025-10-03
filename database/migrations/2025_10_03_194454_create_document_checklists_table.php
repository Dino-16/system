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

    Schema::create('document_checklists', function (Blueprint $table) {
        $table->id();
        $table->string('new_hire_name');

        // One column per document
        $table->boolean('resume')->default(false);
        $table->boolean('signed_application_form')->default(false);
        $table->boolean('valid_government_id')->default(false);
        $table->boolean('transcript_of_records')->default(false);
        $table->boolean('medical_certificate')->default(false);
        $table->boolean('nbi_clearance')->default(false);
        $table->boolean('barangay_clearance')->default(false);
        $table->boolean('signed_job_offer_contract')->default(false);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_checklists');
    }
};
