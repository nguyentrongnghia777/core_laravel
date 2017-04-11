<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class CategoryQModel extends Model
{
    /**
     * get category by id
     * @param id
     * @return object|boolean : all properties from `categories` table,
     * returns false if no categories is founded
     */
    public static function get_category_by_id($id) {
        return DB::table(Constants::CATEGORIES)
                ->where('id', '=', $id)
                ->get();

        if (empty($result[0])) {
            return FALSE;
        }

        return $result[0];
    }

    /**
     * get and search categories paging
     * @return object Illuminate\Pagination\LengthAwarePaginator
     */
    public static function get_categories_paging($search) {
        return DB::table(Constants::CATEGORIES)
                ->where('name', 'like', $search.'%') 
                ->orderBy('id', 'desc')
                ->paginate(Constants::ADMIN_DEFAULT_PAGING);
    }  
}
