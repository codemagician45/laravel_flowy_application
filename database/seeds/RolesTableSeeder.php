<?php

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
            'role_name' => 'Quality Checker',
            'color' => '#0066ff'
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Head of Sales',
            'color' => '#009933'
        ]);
    }
}
