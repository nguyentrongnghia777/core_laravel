<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class CategoriesCModel extends Model
{
    /**
     * insert categories
     * @param array data
     * @return boolean
     */
    public static function insert_categories($data) {
        return DB::table(Constants::CATEGORIES)->insert($data);
    }

    /**
     * update categories
     * @param id
     * @param array data
     * @return boolean
     */
    public static function update_categories($id, $data) {
        return DB::table(Constants::CATEGORIES)
                ->where('id', $id)
                ->update($data);
    }

    /**
     * delete a category
     * @param id
     * @return boolean
     */
    public static function delete_categories($id) {
        return DB::table(Constants::CATEGORIES)
            ->where('id', '=', $id)
            ->delete();
    }
}
