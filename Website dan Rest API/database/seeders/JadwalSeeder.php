<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $jadwal = array(
            array('mapel_id'=>'1','name' => 'Senin, pkl.07.00 - 08.00','created_at' => $date,'updated_at' => $date),
            array('mapel_id'=>'1','name' => 'Rabu, pkl.10.00 - 11.00','created_at' => $date,'updated_at' => $date),
        );
        Jadwal::insert($jadwal);
    }
}
