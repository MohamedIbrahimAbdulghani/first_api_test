<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationAboutCreatePost;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::all();
        return view('posts.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationAboutCreatePost $request)
    {
        Posts::create([
            'title'=>$request->title,
            'body'=>$request->body
        ]);
        session()->flash('Add', 'Added Success');
        return redirect('posts');
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Posts::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationAboutCreatePost $request, $id)
    {
        $post = Posts::findOrFail($id);
        $post->update([
            'title'=>$request->title,
            'body'=>$request->body
        ]);
        session()->flash('Update', 'Updated Successful');
        // return redirect()->back();
        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Posts::findOrFail($id)->delete();
        session()->flash('Delete', 'Delete Successful');
        return redirect()->back();
    }
}