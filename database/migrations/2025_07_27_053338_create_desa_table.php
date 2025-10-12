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
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->char('kode_desa', length: 20)->unique();
            $table->string('nama_desa');
            $table->decimal('latitude', total: 10, places: 8);
            $table->decimal('longitude', total: 11, places: 8);
            $table->unsignedBigInteger('OBJECTID')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa');
    }
};
