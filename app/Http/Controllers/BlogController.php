<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BlogController extends Controller
{
    public function index($id=null)
    {
        $categories=Category::all();
        if(is_null($id))
        {
    	$posts=Post::all();
        }
        else
        {
            $posts=Post::get()->where('category_id',$id);
        }
        return view('home',compact('categories','posts'));  
    }
    public function show($slug)
    {
    	$post=Post::get()->where('slug',$slug)->first();
        $tag_id=$post->tag()->pluck('tag_id');
        $tags=Tag::get()->whereIn('id',$tag_id);
    	return view('post',compact('post','tags'));
    }
}
