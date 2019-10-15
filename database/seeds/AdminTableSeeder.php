<?php

use Illuminate\Database\Seeder;
use App\Admin;


class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->username = 'Super Admin';
        $admin->email = "admin@be-steam.com";
        $admin->phone = "01020104730";
        $admin->password =  bcrypt("admin123");
        $admin->save();
    }
}
