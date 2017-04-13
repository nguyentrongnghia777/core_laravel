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
use App\Http\Models\Dal\ProductCModel;
use App\Http\Models\Dal\ProductQModel;;
use Illuminate\Support\Facades\Input;


/**
 * Class BlogController
 * @package App\Http\Controllers\Admin
 */
class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Show list and search products.
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
        $products = ProductQModel::get_products_paging($search);

        if (empty($products[0])) {
            $request->session()->flash('alert-danger', 'Tên thể loại này không có trong cơ sở dữ liệu!');
            return back();
        } else {
            return view('vendor.adminlte.product.list', compact('products')); 
        }
}

    /**
     * Show form create product.
     *
     * @return Response
     */
    public function create() {
        return view('vendor/adminlte/product/create');
    }

    /**
     * Store a new products.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request) {
        // Validate and store the categories...
        /*$this->validate($request, [
            'product-name' => 'bail|required|min:5',
            'product-description' => 'required|min:5'
        ]);*/

        // Create item to insert db
        $data = [
            'name' => $_POST['product-name'],
            'description' => $_POST['product-description'],
            'slug' => $_POST['product-slug'],
            'quantity' => $_POST['product-quantity'],
            'images' => input::file('product-images')->getClientOriginalName()
        ];
        input::file('product-images')->move('uploads/',input::file('product-images')->getClientOriginalName());
        
        if (ProductCModel::insert_product($data)) {
            $request->session()->flash('alert-success', 'Thể loại đã được tạo thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Thể loại tạo không thành công!');
            return back();
        }
    }

    /**
     * Edit a product.
     *
     * @param id
     * @return Response
     */
    public function edit($id) {
        // Get products
        $product = ProductQModel::get_product_by_id($id);
        if (!$product) {
            return view('vendor.adminlte.errors.404');
        }

        return view('vendor.adminlte.product.edit', compact('product'));
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
     * Delete a product.
     *
     * @param id
     * @param Request $request
     * @return Response
     */
    public function delete($id, Request $request) {
        if (ProductCModel::delete_product($id)) {
            $request->session()->flash('alert-success', 'Thể loại đã được xóa thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Thể loại xóa không thành công!');
            return back();
        }
    }
}