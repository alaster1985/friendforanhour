<?php

use App\Permission;
use App\Role;
use App\User;
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
        //create administrator role
        $adminRole = new Role();
        $adminRole->name = 'admin';
        $adminRole->display_name = 'administrator';
        $adminRole->description = 'CRUD moderators';
        $adminRole->save();

        //create moderator role
        $moderatorRole = new Role();
        $moderatorRole->name = 'moderator';
        $moderatorRole->display_name = 'moderator';
        $moderatorRole->description = 'RU other users profiles';
        $moderatorRole->save();

        //create user role
        $userRole = new Role();
        $userRole->name = 'user';
        $userRole->display_name = 'regular user';
        $userRole->description = 'regular user for friendship, RU own profile, CRUD own services, R other users profiles';
        $userRole->save();

        //create guest role
//        $guestRole = new Role();
//        $guestRole->name = 'guest';
//        $guestRole->display_name = 'unregistered user';
//        $guestRole->description = 'limited reading other users profiles, just to get acquainted with the site';
//        $guestRole->save();

        //permission to create moderators
        $createModerators = new Permission();
        $createModerators->name = 'create_moderators';
        $createModerators->display_name = 'create moderators';
        $createModerators->description = 'CRUD moderators';
        $createModerators->save();

        $adminRole->attachPermission($createModerators);

        //permission to RU users profiles
        $editUsersProfiles = new Permission();
        $editUsersProfiles->name = 'RU_profiles';
        $editUsersProfiles->display_name = 'edit users profiles';
        $editUsersProfiles->description = 'edit (RU) users profiles';
        $editUsersProfiles->save();

        $adminRole->attachPermission($editUsersProfiles);
        $moderatorRole->attachPermission($editUsersProfiles);

        //permission to edit own profiles
        $editOwnProfiles = new Permission();
        $editOwnProfiles->name = 'edit_own_profile';
        $editOwnProfiles->display_name = 'RU own profile';
        $editOwnProfiles->description = 'RU own profile, CRUD own services, R other users profiles';
        $editOwnProfiles->save();

        $userRole->attachPermission($editOwnProfiles);

        //example of admin
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('admin@gmail.com');
        $admin->profile_id = null;
        $admin->save();

        $admin->attachRole($adminRole);

        //example of moderator
        $moderator = new User();
        $moderator->name = 'moderator';
        $moderator->email = 'moderator@gmail.com';
        $moderator->password = bcrypt('moderator@gmail.com');
        $moderator->profile_id = null;
        $moderator->save();

        $moderator->attachRole($moderatorRole);
    }
}
