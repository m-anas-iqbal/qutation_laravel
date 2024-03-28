<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
	        'role_id' => 1,
	        'name' => 'Admin',
	        'email' => 'admin@demo.com',
	        'password' => bcrypt('password'),
        ]);
    }
}
