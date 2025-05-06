<?php

namespace Database\Seeders;

use App\Models\Periksa;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PeriksasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Example data to populate the Periksas table
        Periksa::create([
            'id_pasien' => 3,
            'id_dokter' => 1,
            'tgl_periksa' => Carbon::now(),
            'catatan' => 'Pasien mengalami demam tinggi dan batuk.',
            'biaya_periksa' => 150000
        ]);

        Periksa::create([
            'id_pasien' => 3,
            'id_dokter' => 2,
            'tgl_periksa' => Carbon::now()->addDays(3),
            'catatan' => 'Pasien perlu pemeriksaan lanjutan.',
            'biaya_periksa' => 200000
        ]);
    }
}
