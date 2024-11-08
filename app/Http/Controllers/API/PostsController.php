<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    use ApiResponseTrait;
    public function index() {
        $posts = Posts::all();
        return $this->apiResponse($posts, 'Data Returned Successful!', 200);
    }
    public function show($id) {
        $post = Posts::findOrFail($id);
        if($post):
            return $this->ApiResponse($post);
        else:
            return $this->ApiResponse(null, 'Post Is Not Found', 404);
        endif;
    }
}