<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('detail_periksas', function (Blueprint $table) {
            if (!Schema::hasColumn('detail_periksas', 'harga_obat')) {
                $table->integer('harga_obat')->nullable()->after('id_obat');
            }
        });
    }

    public function down(): void {
        Schema::table('detail_periksas', function (Blueprint $table) {
            $table->dropColumn('harga_obat');
        });
    }
};