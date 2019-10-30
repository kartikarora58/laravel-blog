@extends('layouts.app')
@section('content')
<div class="container-fluid">
	<div class="jumbotron">
		<h1 align="center">Laravel Blog</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
	<div class="col-md-9">
		@foreach($posts as $post)
		<div class="jumbotron">
			<h4 style="margin-top: -5%;">{{$post->title}}</h4>
			<p class="text-muted">Posted By:{{$post->user->name}} &nbsp;&nbsp;&nbsp; Last Updated:{{date('M j, Y h:ia',strtotime($post->updated_at))}}&nbsp;&nbsp;&nbsp;<span class="fa fa-comments">&nbsp;&nbsp;{{$post->comments()->count()}}</span></p>
			<p>{{substr(strip_tags($post->body),0,100)}}{{strlen($post->body)>100?'....':''}}</p>
			<a style="margin-bottom: -4%" class="btn btn-primary" href="{{url('/'.$post->slug)}}">Read More</a>
		</div>
		@endforeach
	</div>
	<div class="col-md-3">
		<div class="jumbotron">
		<h4 align="center" style="margin-top: -5%">Categories</h4>
		<ul style="list-style-type: none">
			@foreach($categories as $c)
			<a href="{{url('/home/'.$c->id)}}"><li>{{$c->name}}-<span class="">{{$c->post->count()}}</span></li></a>
			@endforeach
		</ul>
	    </div>
	</div>
    </div>
</div>

@endsection