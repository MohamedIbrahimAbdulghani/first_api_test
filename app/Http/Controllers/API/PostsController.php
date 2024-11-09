<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidationAboutCreatePost;
use App\Http\Resources\PostsResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'title'=>'required|min:3',
            'body'=>'required'
        ]);
        if($validator->fails()):
            return $this->ApiResponse(null, $validator->errors(), 400);
        else:
            $post = Posts::create($request->all());
        endif;
        if($post):
            return $this->ApiResponse(new PostsResource($post), 'The Post Save', 200);
        else:
            return $this->ApiResponse(null, 'The Post Not Save', 404);
        endif;
    }
    // this is function to update post in database
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title'=>'required|min:3',
            'body'=>'required'
        ]);
        if($validator->fails()):
            return $this->ApiResponse(null, $validator->errors(), 400);
        endif;
        $post = Posts::findOrFail($id);
        $post->update($request->all());
        if($post):
            return $this->ApiResponse(new PostsResource($post), 'The Post Updated', 200);
        else:
            return $this->ApiResponse($post, 'The Post Not Update', 404);
        endif;
    }
}