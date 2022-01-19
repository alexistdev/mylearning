<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $role = array(
            array('name' => 'admin','created_at' => $date,'updated_at' => $date),
            array('name' => 'guru','created_at' => $date,'updated_at' => $date),
            array('name' => 'siswa','created_at' => $date,'updated_at' => $date),
        );
        Role::insert($role);
    }
}
