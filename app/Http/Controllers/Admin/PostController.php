<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Dal\PostCModel;
use App\Http\Models\Dal\PostQModel;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 */
class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show list blog posts.
     *
     * @return Response
     */
    public function index()
    {
        //Get Posts
        $posts = PostQModel::get_posts();
        // dd($posts);
        return view('vendor.adminlte.post.list', compact('posts'));
    }

    /**
     * Show form crate post.
     *
     * @return Response
     */
    public function create()
    {
        return view('vendor/adminlte/post/create');
    }

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate and store the blog post...
        $this->validate($request, [
            'title' => 'required|min:3',
        ]);


        // The blog post is valid, store in database...

        //Get request data
        $request_data = $_POST;
        $user_id = Auth::user()->id;
        // dd($user_id);

        //Create needed array to store to DB
        $post_content = [
            'user_id' => $user_id,
            'name' => $request_data['title']
        ];
        // dd($request_data);
        
        if (PostCModel::insert_post($post_content)) {
            $request->session()->flash('alert-success', 'Bài viết đã được tạo thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Bài viết tạo không thành công!');
        }
    }

    /**
     * Edit a blog post.
     *
     * @param  post id
     * @return Response
     */
    public function edit($post_id)
    {
        //Get Post
        $post = PostQModel::get_post_by_id($post_id);
        // dd($post);
        if (count($post)) {
            return view('vendor.adminlte.post.edit', compact('post'));
        }
        return view('vendor.adminlte.errors.404');
    }

    /**
     * Update a blog post.
     *
     * @param  post id
     * @return Response
     */
    public function update($post_id, Request $request)
    {
        // Validate and store the blog post...
        $this->validate($request, [
            'title' => 'required|min:3',
        ]);

        // return $post_id;
        // Get request data
        $request_data = $_POST;

        //Create needed array to update to DB
        $post_content = [
            'name' => $request_data['title']
        ];
        // dd($post_content);

        if (PostCModel::update_post($post_id, $post_content)) {
            $request->session()->flash('alert-success', 'Bài viết đã được cập nhật thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Bài viết cập nhật không thành công!');
            return back();
        }
    }

    /**
     * Delete a blog post.
     *
     * @param  post id
     * @return Response
     */
    public function delete($post_id, Request $request)
    {
        if (PostCModel::delete_post($post_id)) {
            $request->session()->flash('alert-success', 'Bài viết đã được xóa thành công!');
            return back();
        } else {
            return view('vendor.adminlte.errors.404');
        }
    }
}