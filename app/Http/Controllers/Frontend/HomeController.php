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

    public function postById($id)
    {
        $data = Post::find($id);


        $commentnew = DB::table('comments')
        ->where('post_id', $id) 
        ->get();

    
        function buildNestedComments($comments, $parentId = null) {
            $nestedComments = [];
        
            foreach ($comments as $comment) {
              
                if ($comment->parent_comment_id === $parentId) {
                 
                    $nestedComments[] = [
                        'comment' => $comment,
                        'replies' => buildNestedComments($comments, $comment->id)
                    ];
                }
            }
        
            return $nestedComments;
        }
        
        $nestedComments = buildNestedComments($commentnew);
        

        
        // return response()->json(['data'=>$nestedComments]);
        // exit();

        // dd($nestedComments);
        if ($data) {
            return view('frontend.postById', compact('data', 'nestedComments'));
        } else {
            return view('frontend.postById')->with('error', 'No records');
        }
    }



    //  for only test  api

    public  function getbyid($id){

        $data = Post::find($id);


        $commentnew = DB::table('comments')
        ->where('post_id', $id) 
        ->get();

    
        function NestedComments($comments, $parentId = null) {
            $nestedComments = [];
        
            foreach ($comments as $comment) {
                
                if ($comment->parent_comment_id === $parentId) {
                 
                    $nestedComments[] = [
                        'comment' => $comment,
                        'replies' => NestedComments($comments, $comment->id)
                    ];
                }
            }
        
            return $nestedComments;
        }
        
        $nestedComments = NestedComments($commentnew);
        

        
        return response()->json(['data'=>$nestedComments]);
        exit();

        // dd($nestedComments);
        if ($data) {
            return view('frontend.postById', compact('data', 'nestedComments'));
        } else {
            return view('frontend.postById')->with('error', 'No records');
        }
    }
}
