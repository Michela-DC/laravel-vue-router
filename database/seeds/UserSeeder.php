<?php

use App\User;
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
        $user = new User();

        $user->name = 'Michela';
        $user->email = 'michela@gmail.com';
        $user->password = Hash::make('booleanLaravel');

        $user->save();
    }
}
