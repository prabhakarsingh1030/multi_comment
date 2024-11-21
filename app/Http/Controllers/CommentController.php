<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    
    public function index()
    {
     

    }

  
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        // dd ($request->all());
        // die();
        $co = new Comment;
        $co->post_id = $request->post_id;
        $co->content = $request->content;
        $co->depth = 0;
        $co->save();
        return redirect()->back();
    }

    
    public function show($id)
    {
    
        // $show = Comment::where('post_id',$id)->get();
        // $viewName = "frontend.homepageByid.$id"; 
        // dd($show);
        // return view($viewName, compact('show'));

        // $data = DB::table('posts')
        // ->join('comments','posts.id','=','comments.post_id')->select('comments.content')->where('posts.id',$id)->get();
        // $comment = DB::table('comments')
        // ->join('posts','comments.post_id','=','posts.id')->select('comments.content')->where('post.id',1)->get();
        // // dd ($comment);
        // $viewName = "frontend.homepageByid.$id";
        
        // return view($viewName,compact($comment));



    }

 
   
    public function edit(Comment $comment)
    {
    
    }


    public function update(Request $request, Comment $comment)
    {
     
    }

    
    public function destroy(Comment $comment)
    {
      
        

    }



    public function replyStore(Request $request){
        // dd($request->all());


$reply = DB::table('comments')->insert([
    'post_id'=>$request->post_id,
    'content'=>$request->content,
    'parent_comment_id'=>$request->parent_comment_id,
    'depth'=>0,
]);
return redirect()->back();
        
    }
}
