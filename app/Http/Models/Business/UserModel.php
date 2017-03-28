<?php

namespace App\Http\Models\Business;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;
use App\Http\Models\Dal\UserQModel;

class UserModel extends Authenticatable
{
    /**
     * check user is admin by id
     * @param id
     * @return boolean
     */
    public static function check_admin($id) {
        $roles = UserQModel::get_role_user($id);

        foreach ($roles as $role) {
            if ($role->name == Constants::ROLES_ADMIN) {
                return TRUE;
            }
        }

        return FALSE;
    }
}
