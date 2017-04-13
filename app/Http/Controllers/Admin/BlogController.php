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
use Illuminate\Support\Facades\Input;

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
            'blog-avatar' => 'image|mimes:jpeg,png,jpg,svg|required|max:3000'//Support dimension
        ]);

        // Process upload image
        // Check file
        if($request->hasFile('blog-avatar')){
            $destination = 'uploads/';
            $file = Input::file('blog-avatar');
            $name = $file->getClientOriginalName();

            // Create item to insert db
            $blog = [
                'user_id' => Auth::id(),
                'name' => $_POST['blog-name'],
                'avatar_url' => $name
            ];
            
            if (BlogCModel::insert_blog($blog)) {
                //Move file to server
                $file->move(public_path().'/'.$destination, $name);
                $request->session()->flash('alert-success', 'Bài viết đã được tạo thành công!');
                return back();
            } else {
                $request->session()->flash('alert-danger', 'Bài viết tạo không thành công!');
                return back();
            }

        }
        $request->session()->flash('alert-danger', 'Bài viết tạo không thành công!');
        return back();
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
        // $file = Input::file('blog-avatar');
        //     dd($file);
        // Validate and store the blog...
        $this->validate($request, [
            'blog-name' => 'required|min:3',
            'blog-avatar' => 'image|mimes:jpeg,png,jpg,svg|max:3000'//Support dimension
        ]);

        // Process upload image
        // Check file
        if($request->hasFile('blog-avatar')){
            $destination = 'uploads/';
            $file = Input::file('blog-avatar');
            $name = $file->getClientOriginalName();

            //Find old avatar file and delete it.
            // Get blog
            $blog = BlogQModel::get_blog_by_id($blog_id);
            $old_avatar = $blog->avatar_url;
            File::delete($old_avatar);


            // Create needed array to update to DB
            $blog = [
                'name' => $_POST['blog-name'],
                'avatar_url' => $name
            ];
            
            if (BlogCModel::update_blog($blog_id, $blog)) {
                //Move file to server
                $file->move(public_path().'/'.$destination, $name);
                $request->session()->flash('alert-success', 'Bài viết đã được cập nhật thành công!');
                return back();
            } else {
                $request->session()->flash('alert-danger', 'Bài viết cập nhật không thành công!');
                return back();
            }
        }
        $request->session()->flash('alert-danger', 'Bài viết cập nhật không thành công!');
        return back();
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