<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Models\Business\User;
use View;

class PageController extends Controller 
{
    public function __construct() {
        // do some thing ...

        // set global $can_manage
        $this->middleware(function(Request $request, $next) {

            $can_mange = FALSE;

            if (Auth::check()) {
                if (User::check_admin(Auth::id())) {
                    $can_mange = TRUE;
                }
            }

            View::share('can_mange', $can_mange);
            return $next($request);
        });
    }    
}