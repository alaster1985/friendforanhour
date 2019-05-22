<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RegularUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 6; $i++) {
            $user = new User();
            $user->name = 'user' . $i;
            $user->email = 'user' . $i . '@gmail.com';
            $user->password = bcrypt('user' . $i . '@gmail.com');
            $user->profile_id = $i;
            $user->sms_checked = true;
            $user->save();
            $user->attachRole(Role::find(3));
        }
    }
}
