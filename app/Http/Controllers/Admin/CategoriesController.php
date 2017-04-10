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
use App\Http\Models\Dal\CategoriesCModel;
use App\Http\Models\Dal\CategoriesQModel;

/**
 * Class BlogController
 * @package App\Http\Controllers\Admin
 */
class CategoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Show list categories.
     *
     * @return Response
     */
    public function index() {
        //Get Categories
        $categories = CategoriesQModel::get_categories_paging();
        return view('vendor.adminlte.categories.list', compact('categories'));  
    }

    /**
     * Show form create blog.
     *
     * @return Response
     */
    public function create() {
        return view('vendor/adminlte/categories/create');
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
            'name' => 'bail|required|min:5',
            'desc' => 'required|min:5'
        ]);

        // Create item to insert db
        $data = [
            'name' => $_POST['name'],
            'desc' => $_POST['desc']
        ];
        
        if (CategoriesCModel::insert_categories($data)) {
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
        $category = CategoriesQModel::get_categories_by_id($id);

        if (!$category) {
            return view('vendor.adminlte.errors.404');
        }

        return view('vendor.adminlte.categories.edit', compact('category'));
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
            'name' => 'required|min:3',
            'desc' => 'required'
        ]);

        // Create needed array to update to DB
        $data = [
            'name' => $_POST['name'],
            'desc' => $_POST['desc']
        ];

        if (CategoriesCModel::update_categories($id, $data)) {
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
        if (CategoriesCModel::delete_categories($id)) {
            $request->session()->flash('alert-success', 'Thể loại đã được xóa thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Thể loại xóa không thành công!');
            return back();
        }
    }
}