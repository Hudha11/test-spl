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
        Schema::create('spls', function (Blueprint $table) {
            $table->id();
            $table->string('kode_spl')->unique();
            $table->string('created_by');
            // FK to departments table
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            // FK to sections table
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('set null');
            $table->string('notes')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spls');
    }
};
