<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'salamaid.official@gmail.com';
        $user->password = bcrypt('qweasd123');
        $user->save();
    }
}
