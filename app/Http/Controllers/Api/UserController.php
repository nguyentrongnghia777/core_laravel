<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\ResponseHelper;
use App\Http\Models\Business\UserModel;

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
        $device = $request->device;
        $type_device = $request->type_device;

        // validate
        if (!$username || !$password) {
            return ResponseHelper::error(
                ResponseHelper::USERNAME_PASSWORD_REQUIRE,
                ['Tài khoản và mật khẩu không được để trống'],
                400
            );
        }
        
        // check user login
        if (!UserModel::app_login($username, $password, $device, $type_device)) {
            return ResponseHelper::error(
                ResponseHelper::USERNAME_PASSWORD_INCORRECT,
                ['Tài khoản và mật khẩu không đúng'],
                403
            );            
        }

        // get token
        $token = md5($username + $password + time()) . '-' . base64_encode(time());

        // save token

        // $current_time = time();
        // var_dump($date_start);
        // return $date_start;
        $data = [
            'username' => $username,
            'password' => $password,
            'token' => $token,
        ];

        // return ResponseHelper::success((object)$data, 200);
        return ResponseHelper::error(ResponseHelper::NOT_FOUND, ['not found'], 400);
    }
}