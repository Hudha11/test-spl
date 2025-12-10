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
        Schema::create('spl_items', function (Blueprint $table) {
            $table->id();
            // FK to spls table
            $table->foreignId('spl_id')->constrained('spls')->onDelete('cascade');
            // FK to users table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('duration_hours', 5, 2)->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->nullable();
            // notes
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spl_items');
    }
};
