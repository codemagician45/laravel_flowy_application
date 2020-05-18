<?php

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
        DB::table('users')->insert([
            'name' => 'Raffale',
            'email' => 'cutewolf4575@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
