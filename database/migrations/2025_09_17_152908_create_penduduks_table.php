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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nik', 50)->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->foreignId('pekerjaan_id')->constrained('pekerjaans');
            $table->enum('pendidikan', [
                'PAUD',
                'SD Sederajat',
                'SMP Sederajat',
                'SMA/SMK Sederajat',
                'D1',
                'D2',
                'D3',
                'D4',
                'S1',
                'S2',
                'S3'
            ]);
            $table->foreignId('keluarga_id')->constrained('keluargas');
            $table->enum('peran_dalam_keluarga', ['Kepala Keluarga', 'Istri', 'Anak', 'Lainnya'])->default('Lainnya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
