<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index() {

    }

    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;

        // check user

        // get token
        $token = md5($username + $password + time()) . '-' . base64_encode(time());

        // save token

        // $current_time = time();
        // var_dump($date_start);
        // return $date_start;

        return response(json_encode([
            'username' => $username,
            'password' => $password,
            'token' => $token,
        ]), 200)->header('Content-Type', 'application/json');
    }
}