<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('pendidikan_1152', function (Blueprint $table) {
            $table->id();
            $table->foreignId('biodata_id')->constrained('biodata_1152')->onDelete('cascade');
            $table->string('nama_instansi');
            $table->string('keterangan');
            $table->string('tahun');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendidikan_1152');
    }
};
