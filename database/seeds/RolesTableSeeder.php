<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'IT',
        ]);
        DB::table('roles')->insert([
            'name' => 'Finance',
        ]);
        DB::table('roles')->insert([
            'name' => 'Support',
        ]);
    }
}
