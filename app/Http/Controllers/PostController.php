<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    return view('post');
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

        $validate = $request->validate([
            'title'=>'required|string',
            'content'=>'required|string|max:500',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect('/post')->with('msg','Content Added Successfully');

    }

  
    public function show(Post $post)
    {
        //
    }

    
    public function edit(Post $post)
    {
        //
    }

   
    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }
}
