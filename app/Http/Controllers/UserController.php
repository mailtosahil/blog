<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Redirect;

class UserController extends Controller
{

    public function logout()
    {

        $user_id = Auth::id();
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
    }
}
