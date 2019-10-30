@extends('layouts.app')
<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>
@section('content')
<div class="container-fluid">
	<div class="jumbotron">
		<h1 align="center">Laravel Blog</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div style="box-shadow: 5px 5px 5px grey" class="card jumbotron">
				<div class="card-body">
				<div class="card-title"><h1>{{$post->title}}</h1></div>	
				<p class="text-muted font-weight-bold">Posted By:{{$post->user->name}} &nbsp;&nbsp;&nbsp; Last Updated:{{date('M j, Y h:ia',strtotime($post->updated_at))}} &nbsp;&nbsp;&nbsp;Category:{{$post->category->name}}</p>
				<div class="row">
					@foreach($tags as $tag)
					
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-pill badge-secondary">{{$tag->name}}</span>
					
					@endforeach
				</div>
				<div  class="card-text">
				   {!! $post->body !!}
				</div>
				<hr />
				<h4>Comments</h4>
				@include('partials._comments_replies',['comments'=>$post->comments,'post_id'=>$post->id])
				<hr />
				<a href="#" class="btn btn-outline-warning" id="my" data-toggle="collapse" data-target="#comment">Add Comment</a>
				<form method="post" action="{{route('comment.add')}}">
					@csrf
					<div class="collapse" id="comment">
					<div class="row">
						<div class="col-md">
							<div class="form-group">
								<label>Name:</label>
								<input type="text" name="name" class="form-control">
							</div>
						</div>
						<div class="col-md">
							     <label>Email:</label>
							     <input type="email" name="email" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label>Comment:</label>
						<textarea class="mytextarea" name="comment_body" class="form-control" style="height: 100px"></textarea>
						<input type="hidden" name="post_id" value="{{$post->id}}">
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Add Comment" class="btn btn-warning">
					</div>
					</div>
				</form>
				</div> 
			</div>
		</div>
	</div>	
</div>
<script type="text/javascript">
	$(document).ready(function(){

    $('#my').click(function(){
    var $this = $(this);
    $this.toggleClass('open');
    if($this.hasClass('open')){
        $this.text('Cancel');         
    } else {
        $this.text('Add Comment');
    }
});
	});
</script>
@endsection