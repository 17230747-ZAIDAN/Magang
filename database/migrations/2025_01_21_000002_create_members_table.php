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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('photo')->nullable();
            $table->string('party'); // Partai Politik
            $table->string('electoral_district'); // Daerah Pemilihan
            $table->string('province')->nullable();
            $table->string('position')->nullable(); // Jabatan (Ketua, Wakil Ketua, Anggota)
            $table->string('commission')->nullable(); // Komisi yang dibawahi
            $table->string('faction')->nullable(); // Fraksi
            $table->text('biography')->nullable();
            $table->string('education')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('social_media')->nullable(); // JSON format untuk multiple social media
            $table->date('start_period')->nullable();
            $table->date('end_period')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('slug');
            $table->index('party');
            $table->index('province');
            $table->index('commission');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
