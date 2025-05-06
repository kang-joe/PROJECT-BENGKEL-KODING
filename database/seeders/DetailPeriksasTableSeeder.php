<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailPeriksasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DB::table('detail_periksas')->insert([
                'id_periksa' => 1,
                'id_obat' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}