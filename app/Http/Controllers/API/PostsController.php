<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    use ApiResponseTrait;
    // this is function to show all posts
    public function index() {
        // $posts = Posts::all();
        $posts = PostsResource::collection(Posts::all());
        return $this->ApiResponse($posts, 'Data Returned Successful!', 200);
    }
    // this is function to show post from id
    public function show($id) {
        $post = Posts::findOrFail($id);
        if($post):
            return $this->ApiResponse(new PostsResource($post), 'Data Returned Successful !', 200);
        else:
            return $this->ApiResponse(null, 'Post Is Not Found', 404);
        endif;
    }
    // this is function to store post in database
    public function store(Request $request) {
        $post = Posts::create([
            'title'=>$request->title,
            'body'=>$request->body
        ]);
        if($post):
            return $this->ApiResponse(new PostsResource($post), 'Data Returned Successful !', 200);
        else:
            return $this->ApiResponse(null, 'Post Is Not Found', 404);
        endif;
    }
}