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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('requested_by');
            $table->string('department');     
            $table->string('requisition_title');
            $table->string('requisition_description');
            $table->enum('requisition_type', ['Full-Time', 'Part-Time'])->default('Full-Time');
            $table->enum('requisition_arrangement', ['On-Site', 'Remote'])->default('On-Site');
            $table->text('requisition_responsibilities');
            $table->text('requisition_qualifications');
            $table->integer('opening');      
            $table->enum('status', ['Open', 'In-Progress', 'Draft', 'Closed'])->default('Open'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
