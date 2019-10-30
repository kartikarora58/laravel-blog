<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['title','slug','body'];
    public function comments()
    {
        return $this->morphMany('App\Comment','commentable')->whereNull('parent_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    public function tag()
    {
      return $this->belongsToMany('App\Tag');
    }
    public function savePost($data,$id)
    {
        $this->user_id=$id;
    	$this->title=$data['title'];
    	$this->slug=$data['slug'];
    	$this->body=$data['body'];
        $this->category_id=$data['category'];
    	$this->save();
        $this->tag()->sync($data['tags'],false);
    }
    public function updatePost($data,$id)
    {
        $post=$this->find($id);
        $post->title=$data['title'];
        $post->slug=$data['slug'];
        $post->body=$data['body'];
        $post->category_id=$data['category'];
        $post->updated_at=time();
        $post->save();
        $post->tag()->sync($data['tags'],true);
    }
}
