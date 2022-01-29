<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $kelas = array(
            array('name' => 'Kelas X','guru_id' => '1','created_at' => $date,'updated_at' => $date),
        );
        Kelas::insert($kelas);
    }
}
