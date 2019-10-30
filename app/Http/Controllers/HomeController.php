<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=Post::all();
        return view('user.index',compact('posts'));
    }
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('user.post',compact('categories','tags'));
    }
    public function store(Request $request)
    {
        $id=Auth::user()->id;
        $data=$request->validate([
           'title'=>'required|max:255',
           'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
           'body'=>'required',
           'category'=>'required',
           'tags'=>'nullable'
        ]);
        
        $post=new Post();
        
        $post->savePost($data,$id);
        return "successfull";
    }
    public function edit($id)
    {
       $post=Post::find($id);
       $categories=Category::all();
       $tags=Tag::all();
       $qw=$post->tag()->pluck('tag_id');
       return view('user.edit',compact('post','categories','tags','qw'));
    }
    public function update($id,Request $request)
    {
        $post=Post::find($id);
        $post->slug="";
        $post->save();
        $data=$request->validate([
         'title'=>'required|max:255',
         'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
         'body'=>'required',
         'category'=>'required',
         'tags'=>'nullable'
        ]);
        $save=new Post();
        $save->updatePost($data,$id);
        return "updated";

    }
}
