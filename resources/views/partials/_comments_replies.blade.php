@foreach($comments as $comment)
<div class="display-comment">
	<h5>{{$comment->name}}</h5><small class="font-weight-lighter">{{$comment->updated_at->format('M d,Y')}}</small>
	<p>{!!$comment->body!!}&nbsp;&nbsp;&nbsp;<a href="#" style="text-decoration:none" data-toggle="collapse" data-target="#my{{$comment->id}}" value="{{$comment->id}}">
	<span class="fa fa-reply">&nbsp;</span>Reply
	</a></p>
	<form class="reply" method="post" action="{{route('reply.add')}}">
		@csrf
		<div class="collapse" id="my{{$comment->id}}">
		<div class="row">
			<div class="col-md">
				<div class="form-group">
					<label>Name:</label>
					<input type="text" name="name" class="form-control">
				</div>
			</div>
			<div class="col-md">
				<div class="form-group">
					<label>Email:</label>
					<input type="email" name="email" class="form-control">
				</div>
			</div>
		</div>	
		<div class="form-group">
			<label>Comment:</label>
			<textarea class="mytextarea" class="form-control" name="comment_body"></textarea>
			<input type="hidden" name="post_id" value="{{$post_id}}">
			<input type="hidden" name="comment_id" value="{{$comment->id}}">
			
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-warning" value="Reply">
		</div>
		</div>
	</form>
	@include('partials._comments_replies',['comments'=>$comment->replies])
</div>
@endforeach