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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // relasi ke users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // relasi ke rooms
            $table->foreignId('room_id')->constrained()->onDelete('cascade');

            $table->string('nama_pemesan');
            $table->string('nomor_hp');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
