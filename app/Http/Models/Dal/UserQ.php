<?php

namespace App\Http\Models\Dal;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class UserQ extends Authenticatable
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
}