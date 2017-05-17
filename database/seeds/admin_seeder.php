<?php

use Illuminate\Database\Seeder;

class admin_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Sudaraka Jayathilaka',
            'email' => 'sudarakayasindu@gmail.com',
            'type' => 'ADMIN',
            'password' => bcrypt('111111'),
        ]);
        
    }
}
