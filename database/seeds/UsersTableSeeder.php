<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->delete();
			$user = User::create([
				'name' => 'Dave Medrano',
				'email' => 'evadonardem@gmail.com',
				'password' => Hash::make('123456')
			]);
			
			$user->roles()->attach('ADMIN');
    }
}
