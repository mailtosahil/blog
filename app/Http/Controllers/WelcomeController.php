<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class WelcomeController extends Controller
{

    public function index()
    {
        $posts = Post::all();

        return view('welcome', compact('posts'));
    }
    public function singlePost(Post $post)
    {
        return view('single', compact('post'));
    }
}
