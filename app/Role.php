<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public static function getNotAdminAndNotUserRoles()
    {
        return Role::whereNotIn('id', [1,3])->get();
    }
}
