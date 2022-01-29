<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Siswakelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SiswakelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $siswa = array(
            array('siswa_id'=> 1,'kelas_id'=> '1','created_at' => $date,'updated_at' => $date),
            array('siswa_id'=> 2,'kelas_id'=> '1','created_at' => $date,'updated_at' => $date),
        );
        Siswakelas::insert($siswa);
    }
}
