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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('type'); // UU, PP, Perpres, Peraturan DPR, Risalah, Laporan Kinerja, dll
            $table->string('number')->nullable(); // Nomor dokumen
            $table->integer('year')->nullable(); // Tahun
            $table->string('file_path')->nullable(); // Path ke file PDF
            $table->string('file_url')->nullable(); // URL eksternal jika ada
            $table->bigInteger('file_size')->nullable(); // Ukuran file dalam bytes
            $table->integer('downloads')->default(0);
            $table->date('document_date')->nullable(); // Tanggal penetapan/terbit
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            $table->index('slug');
            $table->index('type');
            $table->index('year');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
