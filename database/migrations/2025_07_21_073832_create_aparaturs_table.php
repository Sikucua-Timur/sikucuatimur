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
    Schema::create('aparaturs', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nip')->nullable();
        $table->string('jabatan');
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
        $table->string('agama')->nullable();
        $table->string('no_hp')->nullable();
        $table->string('email')->nullable();
        $table->text('alamat')->nullable();
        $table->string('pendidikan')->nullable();
        $table->string('foto')->nullable();
        $table->boolean('is_aktif')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparaturs');
    }
};
