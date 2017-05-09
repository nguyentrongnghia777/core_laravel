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
use App\Http\Helpers\Constants;
use App\Http\Helpers\ImageHelper;
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
        //Get and search Products
        if(isset($_POST['search-product'])) {
            $search = $_POST['search-product'];
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
            'product-price' => 'integer|min:0',
            'product-quantity' => 'integer|min:0',
            'product-images' => 'image|mimes:jpeg,png,jpg,svg|required|max:3000',//Support dimension,
            'product-description' => 'required|min:5'
        ]);

        // Process upload image
        // Check file
        if (!$request->hasFile('product-images')) {
            $request->session()->flash('alert-danger', 'Sản phẩm tạo không thành công!');
            return back();
        }

        $file = Input::file('product-images');
        $product_image_name = ImageHelper::convert_image_name($file->getClientOriginalName());

        // Create item to insert db
        $data = [
            'name' => $_POST['product-name'],
            'description' => $_POST['product-description'],
            'price' => $_POST['product-price'],
            'slug' => str_slug($_POST['product-name']),
            'quantity' => $_POST['product-quantity'],
            'images' => Constants::URL_IMAGE_PRODUCT . $product_image_name
        ];
        
        if (ProductCModel::insert_product($data)) {
            //Move file to server
            ImageHelper::upload_image($file, $product_image_name, Constants::URL_IMAGE_PRODUCT);
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
     * @param product_id
     * @return Response
     */
    public function update($product_id, Request $request) {
        // Check if user input id error
        if (!$product_id  || !is_numeric($product_id)) {
            $request->session()->flash('alert-danger', 'Sản phẩm cập nhật không thành công!');
            return back();
        }

        //Validate and store the products...
        $this->validate($request, [
            'product-name' => 'bail|required|min:5|max:20',
            'product-description' => 'required|min:5',
            'product-price' => 'integer|min:0',
            'product-quantity' => 'integer|min:0'
        ]);

        // Get product
        $product = ProductQModel::get_product_by_id($product_id);

        // Create data_model to update to DB
        $data_model = [
            'name' => $_POST['product-name'],
            'description' => $_POST['product-description'],
            'price' => $_POST['product-price'],
            'slug' => str_slug($_POST['product-name']),
            'quantity' => $_POST['product-quantity'],
        ];
        
        // Process upload image
        $image_uploaded = FALSE;

        // Check file
        if ($request->hasFile('product-images')) {
            $image_uploaded = TRUE;
            $file = Input::file('product-images');
            $new_product_image_name = ImageHelper::convert_image_name($file->getClientOriginalName());

            // add new image url to data_model
            $data_model['images'] = Constants::URL_IMAGE_PRODUCT . $new_product_image_name;
        }
        
        // Process update product
        if (ProductCModel::update_product($product_id, $data_model)) {
            if ($image_uploaded == TRUE) {
                //upload new image
                ImageHelper::upload_image($file, $new_product_image_name, Constants::URL_IMAGE_PRODUCT);
                //delete old image
                ImageHelper::delete_image($product->images);
            }

            $request->session()->flash('alert-success', 'Sản phẩm đã được cập nhật thành công!');
            return back();
        } 
    }

    /**
     * Delete a product.
     *
     * @param product_id
     * @param Request $request
     * @return Response
     */
    public function delete($product_id, Request $request) {

        // Check if user input id error
        if (!$product_id  || !is_numeric($product_id)) {
            $request->session()->flash('alert-danger', 'Sản phẩm xóa không thành công!');
            return back();
        }

        // Get product
        $product = ProductQModel::get_product_by_id($product_id);
        // Get current image
        $old_image_url = $product->images;

        // process delete product
        if (ProductCModel::delete_product($product_id)) {
            //delete old image.
            ImageHelper::delete_image($old_image_url);

            $request->session()->flash('alert-success', 'Sản phẩm đã được xóa thành công!');
            return back();
        } 
    }
}