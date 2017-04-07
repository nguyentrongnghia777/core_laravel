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
use App\Http\Models\Dal\BlogCModel;
use App\Http\Models\Dal\BlogQModel;

/**
 * Class BlogController
 * @package App\Http\Controllers\Admin
 */
class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Show list blogs.
     *
     * @return Response
     */
    public function index() {
        //Get Blogs
        $blogs = BlogQModel::get_blogs_paging();
        return view('vendor.adminlte.blog.list', compact('blogs'));
    }

    /**
     * Show form create blog.
     *
     * @return Response
     */
    public function create() {
        return view('vendor/adminlte/blog/create');
    }

    /**
     * Store a new blog.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        // Validate and store the blog...
        $this->validate($request, [
            'blog-name' => 'bail|required|min:3',
        ]);

        // Create item to insert db
        $blog = [
            'user_id' => Auth::id(),
            'name' => $_POST['blog-name'],
        ];
        
        if (BlogCModel::insert_blog($blog)) {
            $request->session()->flash('alert-success', 'Bài viết đã được tạo thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Bài viết tạo không thành công!');
            return back();
        }
    }

    /**
     * Edit a blog blog.
     *
     * @param blog_id
     * @return Response
     */
    public function edit($blog_id) {
        // Get blog
        $blog = BlogQModel::get_blog_by_id($blog_id);

        if (!$blog) {
            return view('vendor.adminlte.errors.404');
        }

        return view('vendor.adminlte.blog.edit', compact('blog'));
    }

    /**
     * Update a blog.
     *
     * @param blog_id
     * @return Response
     */
    public function update($blog_id, Request $request) {
        // Validate and store the blog...
        $this->validate($request, [
            'blog-name' => 'required|min:3',
        ]);

        // Create needed array to update to DB
        $blog = [
            'name' => $_POST['blog-name']
        ];

        if (BlogCModel::update_blog($blog_id, $blog)) {
            $request->session()->flash('alert-success', 'Bài viết đã được cập nhật thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Bài viết cập nhật không thành công!');
            return back();
        }
    }

    /**
     * Delete a blog blog.
     *
     * @param blog_id
     * @param Request $request
     * @return Response
     */
    public function delete($blog_id, Request $request) {
        if (BlogCModel::delete_blog($blog_id)) {
            $request->session()->flash('alert-success', 'Bài viết đã được xóa thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Bài viết xóa không thành công!');
            return back();
        }
    }
}