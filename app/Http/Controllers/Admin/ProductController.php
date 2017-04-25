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
use App\Http\Helpers\CommonHelpers;
use File;


/**
 * Class ProductController
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
        $this->validate($request, [
            'product-name' => 'bail|required|min:5|max:20',
            'product-description' => 'required|min:5',
            'product-price' => 'integer|min:0',
            'product-quantity' => 'integer|min:0'
        ]);


        // Create item to insert db
        $description = $_POST['product-description'];
        $slug = $_POST['product-name'];
        $data = [
            'name' => $_POST['product-name'],
            'description' => CommonHelpers::strip_tags($description),
            'price' => $_POST['product-price'],
            'slug' => CommonHelpers::str_slug($slug),
            'quantity' => $_POST['product-quantity'],
            'images' => input::file('product-images')->getClientOriginalName()
        ];

        input::file('product-images')->move('uploads/',input::file('product-images')->getClientOriginalName());
        
        if (ProductCModel::insert_product($data)) {
            $request->session()->flash('alert-success', 'Sản phẩm đã được tạo thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Sản phẩm tạo không thành công!');
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
     * Update a product.
     *
     * @param id
     * @return Response
     */
    public function update($id, Request $request) {

        //Validate and store the products...
        $this->validate($request, [
            'product-name' => 'bail|required|min:5|max:20',
            'product-description' => 'required|min:5',
            'product-price' => 'integer|min:0',
            'product-quantity' => 'integer|min:0'
        ]);

        // Create variable
        $space = $_POST['product-price'];
        $slug = $_POST['product-name'];
        $product = ProductQModel::get_product_by_id($id);
        $img_old='uploads/' . $product->images;
        $img_new = Input::file('product-images');

        // Create array input data
        $data = [
            'name' => $_POST['product-name'],
            'description' => $_POST['product-description'],
            'price' => CommonHelpers::str_replace($space),
            'slug' => CommonHelpers::str_slug($slug),
            'quantity' => $_POST['product-quantity'],
        ];

        // Handling images in here
        if (!empty($img_new)) { 
            $data['images'] = $img_new->getClientOriginalName();
            $img_new->move('uploads/',$img_new->getClientOriginalName());
            if(File::exists($img_old)){
                File::delete($img_old);
            }
        }
        // Update data
        if (ProductCModel::update_product($id, $data)) {
            $request->session()->flash('alert-success', 'Sản phẩm đã được sửa thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Sản phẩm sửa không thành công!');
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
            $request->session()->flash('alert-success', 'Sản phẩm đã được xóa thành công!');
            return back();
        } else {
            $request->session()->flash('alert-danger', 'Sản phẩm xóa không thành công!');
            return back();
        }
    }
}