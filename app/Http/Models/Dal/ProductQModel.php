<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class ProductQModel extends Model
{
    /**
     * get product by id
     * @param id
     * @return object|boolean : all properties from `products` table,
     * returns false if no products is founded
     */
    public static function get_product_by_id($id) {
        $result = DB::table(Constants::PRODUCTS)
                ->where('id', '=', $id)
                ->get();

        if (empty($result[0])) {
            return FALSE;
        }
        return $result[0];
    }

    /**
     * get and search products paging
     * @return object Illuminate\Pagination\LengthAwarePaginator
     */
    public static function get_products_paging($search) {
        return DB::table(Constants::PRODUCTS)
                ->where('name', 'like', $search.'%') 
                ->orderBy('id', 'desc')
                ->paginate(Constants::ADMIN_DEFAULT_PAGING);
    }  
}
