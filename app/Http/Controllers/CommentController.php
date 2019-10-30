<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
class CommentController extends Controller
{
    public function store(Request $request)
    {
    	$comment=new Comment();
    	$comment->name=$request->get('name');
    	$comment->email=$request->get('email');
    	$comment->body=$request->get('comment_body');

    	$post=Post::find($request->get('post_id'));
    	$post->comments()->save($comment);
    	return back();
    }
    public function replyStore(Request $request)
    {
        $reply=new Comment();
        $reply->name=$request->get('name');
        $reply->email=$request->get('email');
        $reply->body=$request->get('comment_body');
        $reply->parent_id=$request->get('comment_id');
        $post=Post::find($request->get('post_id'));
        $post->comments()->save($reply);
        return back();
    }
}
