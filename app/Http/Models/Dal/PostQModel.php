<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class PostQModel extends Model
{
    /**
     * get posts paging
     * @return object Illuminate\Pagination\LengthAwarePaginator
     */
    public static function get_posts_paging() {
        return DB::table(Constants::POSTS . ' as p')
                ->select('p.*', 'u.name as user_name', 'u.email as user_email')
                ->join(Constants::USERS . ' as u', 'p.user_id', '=', 'u.id')
                ->get();
    }    
}