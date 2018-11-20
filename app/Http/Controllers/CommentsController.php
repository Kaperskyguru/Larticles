<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Resources\Comment as CommentResource;

class CommentsController extends Controller
{
       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comment = $request->isMethod('put') ? Comment::findOrFail($request->article_id) : new Comment;
        $comment->article_id = $request->input('article_id');
        $comment->title = $request->input('title');
        $comment->body = $request->input('body');
        if($comment->save()){
            return Comment::findOrFail($request->article_id);
        }
        
    }
    
    public function comments($id)
    {
        return $articles = Comment::orderBy('created_at', 'desc')->where('article_id' ,$id)->paginate(5);
    }
}
