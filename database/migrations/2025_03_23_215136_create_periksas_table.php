<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('periksas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_dokter');
            $table->dateTime('tgl_periksa')->nullable(false);
            $table->text('catatan')->nullable();
            $table->integer('biaya_periksa')->nullable();
            $table->timestamps();

            // Foreign Keys
            $table->foreign('id_pasien')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('periksas', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['id_pasien']);
            $table->dropForeign(['id_dokter']);
        });

        // Then drop the table
        Schema::dropIfExists('periksas');
    }
};
