<?php

use App\Core\Roles\Role;
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
        $roles = Role::defaultRoles();
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
        $this->command->info("Creating roles complete.");
    }
}
