<?php

namespace Database\Seeders;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SiswaSeeder extends Seeder
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
            array('user_id'=> 3,'nisn' => '12345678','phone'=>'08212345678','alamat'=> 'waykandis','created_at' => $date,'updated_at' => $date),
            array('user_id'=> 4,'nisn' => '232323','phone'=>'081245278','alamat'=> 'tanjung dalem','created_at' => $date,'updated_at' => $date),
        );
        Siswa::insert($siswa);
    }
}
