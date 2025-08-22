<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profil_nagari', function (Blueprint $table) {
            $table->id();
            $table->string('nama_nagari');
            $table->string('kepala_nagari');
            $table->text('alamat');
            $table->text('visi')->nullable();
            $table->longText('misi')->nullable();
            $table->longText('sejarah')->nullable();
            $table->date('tanggal_berdiri')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->integer('jumlah_penduduk')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('logo')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_nagari');
    }
};

