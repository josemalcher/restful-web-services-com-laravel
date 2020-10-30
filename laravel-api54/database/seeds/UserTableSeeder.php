<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'José Junior',
            'email'=> 'empty@josemalcher.net',
            'password' => bcrypt('123456'),
        ]);
    }
}
