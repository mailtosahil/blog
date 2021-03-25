<?php

namespace App\Http\Controllers;

use Auth;
use App\Like;
use App\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {

        $like = new Like;
        $like->liked = true;
        $like->user()->associate($request->user());
        $post = Post::find($request->post_id);
        $post->likes()->save($like);
        return back();
    }

    public function delete(Request $request)
    {
        Like::where('post_id', $request->post_id)->where('user_id', Auth::id())->delete();
        return back();
    }
}
