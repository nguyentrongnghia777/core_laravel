<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class BlogCModel extends Model
{
    /**
     * insert blog
     * @param blog_content
     * @return true or false
     */
    public static function insert_blog($blog_content) {
        return DB::table(Constants::BLOGS)->insert([$blog_content]);
    }

    /**
     * update blog
     * @param blog id
     * @return true or false
     */
    public static function update_blog($blog_id, $blog_content) {
        return DB::table(Constants::BLOGS)
                ->where('id', $blog_id)
                ->update($blog_content);
    }

    /**
     * delete blog
     * @param blog id
     * @return true or false
     */
    public static function delete_blog($blog_id) {
        return DB::table(Constants::BLOGS)->where('id', '=', $blog_id)->delete();
    }
}