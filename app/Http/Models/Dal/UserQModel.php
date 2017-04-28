<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class UserQModel extends Model
{
    /**
     * get role user by id
     * @param id
     * @return array role user
     */
    public static function get_role_user($id) {
        return DB::table(Constants::USERS_GROUPS . ' as ug')
                ->select('name')
                ->join(Constants::GROUPS . ' as g', 'g.id', '=', 'ug.group_id')
                ->where('ug.user_id', '=', $id)
                ->get();
    }

    /**
     * get role user by id
     * @param $username
     * @param $password (md5)
     * @return array role user
     */
    public static function get_user_by_username_password($username, $password) {

    }
}