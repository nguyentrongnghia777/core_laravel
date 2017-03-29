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
     * @return true oor false
     */
    public static function insertBlog($blog_content) {
        return DB::table(Constants::POSTS)->insert([$blog_content]);
    }
}