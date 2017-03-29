<?php

namespace App\Http\Models\Dal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Constants;

class PostCModel extends Model
{
	/**
     * insert post
     * @param blog_content
     * @return true or false
     */
    public static function insert_post($post_content) {
        return DB::table(Constants::POSTS)->insert([$post_content]);
    }

    /**
     * update post
     * @param post id
     * @return true or false
     */
    public static function update_post($post_id, $post_content) {
        return DB::table(Constants::POSTS)
            	->where('id', $post_id)
            	->update($post_content);
    }

    /**
     * delete post
     * @param post id
     * @return true or false
     */
    public static function delete_post($post_id) {
        return DB::table(Constants::POSTS)->where('id', '=', $post_id)->delete();
    }
}