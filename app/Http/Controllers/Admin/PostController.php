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
        return view('vendor.adminlte.post.list');
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
        $blog_content = [
            'user_id' => $user_id,
            'name' => $request_data['title']
        ];
        // dd($request_data);
        // dd($blog_content);
        // $blog = new BlogC;
        // $title = Input::get('title');
        // $body = Input::get('body');
        // $blog_content = Input::all();
        
        if (PostCModel::insertBlog($blog_content)) {
            $request->session()->flash('alert-success', 'Bài viết đã được tạo thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Bài viết tạo không thành công!');
        }
    }
}