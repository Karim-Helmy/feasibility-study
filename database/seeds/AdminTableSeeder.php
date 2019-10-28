<?php

use Illuminate\Database\Seeder;
use App\User;


class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Karim';
        $admin->username = 'Karim';
        $admin->email = "user@user.com";
        $admin->phone = "010244104730";
        $admin->password =  bcrypt("123456");
        $admin->save();
    }
}
