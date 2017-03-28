<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Business\UserModel;
use View;

class PageController extends Controller 
{
    public function __construct() {
        // do some thing ...

        // set global variable
        $this->middleware(function(Request $request, $next) {
            // set $can_manage
            $can_mange = FALSE;

            if (Auth::check()) {
                if (UserModel::check_admin(Auth::id())) {
                    $can_mange = TRUE;
                }
            }

            View::share('can_mange', $can_mange);
            return $next($request);
        });
    }    
}