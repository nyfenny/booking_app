<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');       // nama kamar
            $table->integer('capacity');  // kapasitas orang
            $table->decimal('price', 10, 2); // harga per malam
            $table->text('description')->nullable(); // deskripsi kamar
            $table->string('image')->nullable(); // foto kamar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
