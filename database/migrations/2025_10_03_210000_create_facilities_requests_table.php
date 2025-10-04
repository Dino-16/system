<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facilities_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('requested_by')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facilities_requests');
    }
};
