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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('magang')->after('email'); // admin, magang
            $table->string('institution')->nullable()->after('role'); // Asal Kampus / Sekolah
            $table->string('internship_period')->nullable()->after('institution'); // contoh: Periode Jan - Mar 2026
            $table->string('phone')->nullable()->after('internship_period');
            $table->boolean('is_active')->default(true)->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'institution', 'internship_period', 'phone', 'is_active']);
        });
    }
};
