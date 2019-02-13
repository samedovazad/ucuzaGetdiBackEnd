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
        $user = new \App\User();
        $user->name = "Ahmad";
        $user->surname = "Mammadli";
        $user->birthday = \Carbon\Carbon::parse("27-09-1996");
        $user->username = "axmedbek";
        $user->user_type = "admin";
        $user->email = "axmed.memmedli.96@mail.ru";
        $user->first_phone = "077-598-31-64";
        $user->is_active = 1;
        $user->group_id = 1;
        $user->gender = 'k';
        $user->password = Hash::make("123456");
        $user->save();

    }
}
