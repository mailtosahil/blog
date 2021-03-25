<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index()
    {
        //
        $userId = Auth::id();
        $data = Post::where('user_id', $userId)->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $response = array();
        $response['status'] = false;
        $response['data'] = '';
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'cover_image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->getMessageBag()->toArray();
            return response()->json($response, 422);
        }
        $slug = $this->createSlug($request->title);
        $path = '';
        if (isset($request->cover_image)) {
            $name = $request->cover_image->getClientOriginalName();
            $fileName = $request->cover_image->hashName();
            $path = $request->cover_image->storeAs('uploads', $fileName, 'public');
        }
        return Post::create([
            'title' => $request->title,
            'path' => $path,
            'user_id' => Auth::id(),
            'slug' => $slug,
            'cover_image' => $path

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Post::findOrFail($id);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = array();
        $response['status'] = false;
        $response['data'] = '';
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',

        ]);
        if ($validator->fails()) {
            $response['data'] = $validator->getMessageBag()->toArray();
            return response()->json($response, 422);
        }
        return Post::where('id', $id)
            ->update([
                'title' => $request->title,

            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Post::findOrFail($id);
        if ($data) {
            $data->delete();
        } else {
            return response()->json(['error' => 'Not found'], 403);
        }
        return response()->json(null);
    }
    public function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}
