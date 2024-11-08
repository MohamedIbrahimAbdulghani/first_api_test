<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index() {
        $posts = Posts::all();
        $returned_data = [
            'data'=>$posts,
            'message'=>'Returned Data Successful !',
            'status'=>200
        ];
        return response($returned_data);
    }
}