<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $data = Post::orderBy('created_at', 'desc')->get();
        return view('frontend.homepage', compact('data'));
    }

    public function postById($id){
        $data = Post::find($id);
    

        $comment = DB::table('comments')
        ->join('posts','comments.post_id','=','posts.id')
        ->select('comments.*')
        ->where('comments.post_id',$id)
        ->get();

        $reply = DB::table('comments')
        ->join('posts','comments.post_id','=','posts.id')
        ->select('comments.*')
        ->where('comments.parent_comment_id',$id)
        ->get();
        
     
// dd($comment);
        if($data){
            return view('frontend.postById',compact('data','comment'));
        }else{
            return view('frontend.postById')->with('error','No records');
        }
        
    }
}
