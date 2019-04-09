<?php

use App\Core\Users\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int)$this->command->ask('How many users do you need ?', 10);

        $this->command->info("Creating {$count} users.");

        $users = factory(App\Core\Users\User::class, $count)->create();

        $this->command->info("Creating users complete.");
    }
}
