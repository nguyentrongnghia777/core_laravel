<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Dal\BlogCModel;
use App\Http\Models\Dal\BlogQModel;

/**
 * Class BlogController
 * @package App\Http\Controllers\Api
 */
class ToolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {

    }

    public function get_blog_by_id(Request $request)
    {
        return $request->id;
    }

    public function create_blog(Request $request)
    {
        return json_encode([
            'token' => $request->header('token'),
            'blog_name' => $request->name, 
            'blog_description' => $request->description
        ]);
    }

    public function update_blog(Request $request)
    {
        return json_encode([
            'token' => $request->header('token'),
            'blog_name' => $request->name, 
            'blog_description' => $request->description
        ]);
    }

    public function delete_blog(Request $request)
    {
        return json_encode([
            'token' => $request->header('token'),
            'blog_id' => $request->id
        ]);
    }
}