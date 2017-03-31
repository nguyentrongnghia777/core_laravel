<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class BlogQModel extends Model
{
    /**
     * get blog by id
     * @return blog
     */
    public static function get_blog_by_id($blog_id) {
        return DB::table(Constants::BLOGS . ' as b')
                ->select('b.*', 'u.name as user_name', 'u.email as user_email')
                ->where('b.id', '=', $blog_id)
                ->join(Constants::USERS . ' as u', 'b.user_id', '=', 'u.id')
                ->get();
    }

    /**
     * get blogs paging
     * @return object Illuminate\Pagination\LengthAwarePaginator
     */
    public static function get_blogs_paging() {
        return DB::table(Constants::BLOGS . ' as b')
                ->select('b.*', 'u.name as user_name', 'u.email as user_email')
                ->join(Constants::USERS . ' as u', 'b.user_id', '=', 'u.id')
                ->orderBy('id', 'desc')
                ->paginate(5);
    }    
}
