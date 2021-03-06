<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Http\Models\Business\PostModel;
use App\Http\Helpers\Constant;
use App\Http\Models\Dal\PostQModel;

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

        $posts = PostModel::all();
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
        $posts = PostQModel::get_posts_paging();
        echo '<pre>';
            var_dump($posts);
        echo '</pre>';
        // echo $posts->links();
        return view('pages.home.home');
    }

    public function demo_debug() {
        // document https://github.com/barryvdh/laravel-debugbar
        
        // Debugbar::info($object);
        // Debugbar::error('Error!');
        // Debugbar::warning('Watch out…');
        // Debugbar::addMessage('Another message', 'mylabel');

        // Debugbar::startMeasure('render','Time for rendering');
        // Debugbar::stopMeasure('render');
        // Debugbar::addMeasure('now', LARAVEL_START, microtime(true));
        // Debugbar::measure('My long operation', function() {
        //     // Do something…
        // });
    }

    public function demo_hash_password() {
        echo '<pre>';
            // var_dump(Hash::make('123124'));
            // var_dump(Hash::check('123123','$2y$10$QC7An67rk5GnQ6agyL0VxehEXsEfPRwjILWqW/tqO.5DVxlqKUaHO'));
            var_dump(Hash::check('123123','$2y$10$Ygza8kBIBfGuwj6ywzlFTeKus6Smvhc/qJAmT00ZM4Z2q9mfaSmXi'));
        echo '</pre>'; 
    }
}
