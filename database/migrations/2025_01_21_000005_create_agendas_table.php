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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type'); // Sidang Paripurna, Rapat Komisi, Rapat Kerja, dll
            $table->string('location')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->string('commission')->nullable(); // Komisi terkait
            $table->string('status')->default('scheduled'); // scheduled, ongoing, completed, cancelled
            $table->text('note')->nullable();
            $table->timestamps();
            
            $table->index('type');
            $table->index('start_time');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
