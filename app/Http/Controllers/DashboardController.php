<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $posts = Post::where('user_id',$userId)->get()->count();
        $data['totalPosts'] = $posts;
        return $data;
    }
}
