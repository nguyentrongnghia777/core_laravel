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
use App\Http\Models\Dal\CategoryCModel;
use App\Http\Models\Dal\CategoryQModel;

/**
 * Class BlogController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Show list and search categories.
     *
     * @return Response
     */
    public function index(Request $request) {
        //Get and search Categories
        if(isset($_POST['search-category'])) {
            $search = $_POST['search-category'];
        } else {
            $search = '';
        }
        $categories = CategoryQModel::get_categories_paging($search);

        if (empty($categories[0])) {
            $request->session()->flash('alert-danger', 'Tên thể loại này không có trong cơ sở dữ liệu!');
            return back();
        } else {
            return view('vendor.adminlte.category.list', compact('categories')); 
        }
}

    /**
     * Show form create blog.
     *
     * @return Response
     */
    public function create() {
        return view('vendor/adminlte/category/create');
    }

    /**
     * Store a new categories.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        // Validate and store the categories...
        $this->validate($request, [
            'category-name' => 'bail|required|min:5',
            'category-description' => 'required|min:5'
        ]);

        // Create item to insert db
        $data = [
            'name' => $_POST['category-name'],
            'description' => $_POST['category-description']
        ];
        
        if (CategoryCModel::insert_category($data)) {
            $request->session()->flash('alert-success', 'Thể loại đã được tạo thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Thể loại tạo không thành công!');
            return back();
        }
    }

    /**
     * Edit a category.
     *
     * @param id
     * @return Response
     */
    public function edit($id) {
        // Get categories
        $category = CategoryQModel::get_category_by_id($id);
        if (!$category) {
            return view('vendor.adminlte.errors.404');
        }

        return view('vendor.adminlte.category.edit', compact('category'));
    }

    /**
     * Update a category.
     *
     * @param id
     * @return Response
     */
    public function update($id, Request $request) {
        // Validate and store the blog...
        $this->validate($request, [
            'category-name' => 'required|min:3',
            'category-description' => 'required'
        ]);

        // Create needed array to update to DB
        $data = [
            'name' => $_POST['category-name'],
            'description' => $_POST['category-description']
        ];

        if (CategoryCModel::update_category($id, $data)) {
            $request->session()->flash('alert-success', 'Thể loại đã được cập nhật thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Thể loại cập nhật không thành công!');
            return back();
        }
    }

    /**
     * Delete a category.
     *
     * @param id
     * @param Request $request
     * @return Response
     */
    public function delete($id, Request $request) {
        if (CategoryCModel::delete_category($id)) {
            $request->session()->flash('alert-success', 'Thể loại đã được xóa thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Thể loại xóa không thành công!');
            return back();
        }
    }
}