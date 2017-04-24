<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class ProductCModel extends Model
{
    /**
     * insert product
     * @param array data
     * @return boolean
     */
    public static function insert_product($data) {
        return DB::table(Constants::PRODUCTS)->insert($data);
    }

    /**
     * update product
     * @param id
     * @param array data
     * @return boolean
     */
    public static function update_product($id, $data) {
        return DB::table(Constants::PRODUCTS)
                ->where('id', $id)
                ->update($data);
    }
    /**
     * delete a product
     * @param id
     * @return boolean
     */
    public static function delete_product($id) {
        return DB::table(Constants::PRODUCTS)
            ->where('id', '=', $id)
            ->delete();
    }
}
