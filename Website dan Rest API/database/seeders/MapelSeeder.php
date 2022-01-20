<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $mapel = array(
            array('kelas_id'=> '1','name' => 'Matematika','created_at' => $date,'updated_at' => $date),
        );
        Mapel::insert($mapel);
    }
}
