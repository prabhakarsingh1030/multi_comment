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
        ->where('post_id', $id) // Filter by the specific post ID
        ->get();


        $nestedComments = [];
        foreach ($commentnew as $comment) {
            if ($comment->parent_comment_id === null) {
                // Parent comment
                $nestedComments[$comment->id] = [
                    'comment' => $comment,
                    'replies' => []
                ];
            } else {
                // Reply to a parent comment
                $nestedComments[$comment->parent_comment_id]['replies'][] = $comment;
            }
        }

        


        // dd($nestedComments);
        if ($data) {
            return view('frontend.postById', compact('data', 'nestedComments'));
        } else {
            return view('frontend.postById')->with('error', 'No records');
        }
    }
}
