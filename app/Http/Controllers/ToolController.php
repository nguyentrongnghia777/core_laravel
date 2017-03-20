<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Models\Business\Post;
use App\Http\Helpers\Constant;
use App\Http\Models\Dal\PostQ;

class ToolController extends Controller
{
    /**
     * Show demo
     *
     * @return Response
     */
    public function index()
    {
        // var_dump($data);
        echo Constant::ROLES_ADMIN;

        $posts = Post::all();
        echo '<pre>';
            var_dump($posts);
        echo '</pre>';

        // foreach ($posts as $post) {
        //     echo $post->name . ' - ' . $post->user_id;
        //     echo '</br>';
        // }


    }

    public function demo_paging() {
        // $posts = DB::table('posts')->paginate(2);
        // echo '<pre>';
        //     var_dump($posts);
        // echo '</pre>';
        $posts = PostQ::get_posts_paging();
        echo '<pre>';
            var_dump($posts);
        echo '</pre>';
        // echo $posts->links();
    }
}
