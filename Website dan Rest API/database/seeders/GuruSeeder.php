<?php

namespace Database\Seeders;
use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $guru = array(
            array('user_id'=> 2,'nip' => '12345678','phone'=>'08212345678','alamat'=> 'waykandis','created_at' => $date,'updated_at' => $date),
        );
        Guru::insert($guru);

    }
}
